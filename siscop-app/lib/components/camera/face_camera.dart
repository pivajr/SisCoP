import 'dart:io';

import 'package:SisCop/components/common/loading_dialog.dart';
import 'package:camera/camera.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:google_mlkit_face_detection/google_mlkit_face_detection.dart';
import 'package:SisCop/components/camera/face_painter.dart';
import 'package:SisCop/components/common/base_page.dart';
import 'package:SisCop/components/common/button.dart';
import 'package:SisCop/services/facenet.service.dart';

import 'dart:math' as math;

import 'package:path_provider/path_provider.dart';

class FaceCamera extends StatefulWidget {
  const FaceCamera({Key? key}) : super(key: key);

  @override
  State<FaceCamera> createState() => _FaceCameraState();
}

class _FaceCameraState extends State<FaceCamera> {
  final FaceNetService faceNetService = FaceNetService();

  late CameraController controller;
  late CameraDescription cameraDescription;

  late FaceDetector faceDetector;

  late Size imageSize;

  late Face? faceDetected;

  late bool cameraInitializated = false;
  late bool detectingFaces = false;
  late bool pictureTaked = false;
  late bool saving = false;

  late XFile file;
  Image? image;

  Future? initializeControllerFuture;

  @override
  void initState() {
    super.initState();

    faceDetector = FaceDetector(
      options: FaceDetectorOptions(
        performanceMode: FaceDetectorMode.accurate,
        enableLandmarks: false,
        minFaceSize: 0.5
      ),
    );

    faceDetected = null;

    _start();
  }

  _start() async {
    await faceNetService.loadModel();

    List<CameraDescription> cameras = await availableCameras();

    cameraDescription = cameras.firstWhere(
          (CameraDescription camera) =>
      camera.lensDirection == CameraLensDirection.front,
    );

    controller = CameraController(
      cameraDescription,
      ResolutionPreset.high,
      enableAudio: false
    );

    setState(() {
      initializeControllerFuture = controller.initialize();
    });

    await initializeControllerFuture;

    setState(() {
      cameraInitializated = true;
    });

    _frameFaces();
  }

  _frameFaces() {
    imageSize = Size(controller.value.previewSize!.height, controller.value.previewSize!.width);

    controller.startImageStream((image) async {
        print('>>>> startImageStream');

        // se est?? ocupado, elimina o "overprocessing"
        if (detectingFaces) return;

        detectingFaces = true;

        try {
          List<Face> faces = await getFacesFromImage(image);

          print('>>> faces ${faces.length}');

          if (faces.isNotEmpty) {
            // processa a imagem
            setState(() {
              faceDetected = faces[0];
            });

            if (saving) {
              saving = false;
              faceNetService.setCurrentPrediction(image, faceDetected!);
            }
          }

          detectingFaces = false;
        } catch (e) {
          if (kDebugMode) {
            print(e);
          }
          detectingFaces = false;
        }
    });
  }

  void takePicture() async {
    saving = true;

    await Future.delayed(const Duration(milliseconds: 500));
    await controller.stopImageStream();
    await Future.delayed(const Duration(milliseconds: 200));
    XFile file = await controller.takePicture();

    setState(() {
      pictureTaked = true;
      this.file = file;
      image = Image.file(File(file.path));
    });
  }

  Future<List<Face>> getFacesFromImage(CameraImage image) async {
    final WriteBuffer allBytes = WriteBuffer();
    for (final Plane plane in image.planes) {
      allBytes.putUint8List(plane.bytes);
    }

    final bytes = allBytes.done().buffer.asUint8List();

    final Size imageSize = Size(image.width.toDouble(), image.height.toDouble());

    InputImageRotation imageRotation =
        InputImageRotationValue.fromRawValue(cameraDescription.sensorOrientation) ??
            InputImageRotation.rotation0deg;

    final InputImageFormat inputImageFormat =
        InputImageFormatValue.fromRawValue(image.format.raw) ??
            InputImageFormat.nv21;

    print('>>> imageFormat $inputImageFormat');

    final planeData = image.planes.map(
          (Plane plane) {
        return InputImagePlaneMetadata(
          bytesPerRow: plane.bytesPerRow,
          height: plane.height,
          width: plane.width,
        );
      },
    ).toList();

    final inputImageData = InputImageData(
      size: imageSize,
      imageRotation: imageRotation,
      inputImageFormat: inputImageFormat,
      planeData: planeData,
    );

    final inputImage = InputImage.fromBytes(bytes: bytes, inputImageData: inputImageData);

    return await faceDetector.processImage(inputImage);
  }

  @override
  Widget build(BuildContext context) {
    const double mirror = math.pi;
    final width = MediaQuery.of(context).size.width;
    final height = MediaQuery.of(context).size.height;

    return BasePage(
      floatingActionButton: !pictureTaked ? SizedBox(
        width: 70,
        height: 70,
        child: FloatingActionButton(
          onPressed: takePicture,
          backgroundColor: Colors.blue,
          child: const FaIcon(FontAwesomeIcons.camera),
        ),
      ) : null,
      child:
        pictureTaked && image != null ?
       SizedBox(
        width: width,
        height: height,
        child: Stack(
          alignment: AlignmentDirectional.bottomStart,
          children: [
            image!,
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Expanded(
                  child: Button(
                    icon: FontAwesomeIcons.arrowRotateRight,
                    text: '',
                    onPressed: () {
                      setState(() {
                        cameraInitializated = false;
                        pictureTaked = false;
                      });

                      _start();
                    }
                  ),
                ),
                Expanded(
                  child: Button(
                    icon: FontAwesomeIcons.check,
                  text: '',
                  onPressed: () {
                    Navigator.of(context).pop(file);
                  }
                )
                )
              ],
            )
          ],
        )
      )
    :
            initializeControllerFuture != null ?
          FutureBuilder<void>(
            future: initializeControllerFuture,
            builder: (context, snapshot) {
              if (snapshot.connectionState == ConnectionState.done) {
                return SizedBox(
                  width: MediaQuery.of(context).size.width,
                  height: MediaQuery.of(context).size.height,
                  child: Stack(
                    fit: StackFit.expand,
                    children: <Widget>[
                      CameraPreview(controller),
                      faceDetected != null ? CustomPaint(
                        painter: FacePainter(
                            face: faceDetected!,
                            imageSize: imageSize
                        ),
                      ) : const Text('')
                    ],
                  ),
                );
              }

              return const Center(child: CircularProgressIndicator());
         }
        )
                :
        const Center(child: CircularProgressIndicator())
    );
  }

  @override
  void dispose() async {
    super.dispose();

    await controller.dispose();
    await faceDetector.close();
  }
}