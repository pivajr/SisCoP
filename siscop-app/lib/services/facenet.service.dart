//Versão 1.0 - Sistema de Controle de Presença
//

import 'dart:convert';
import 'dart:typed_data';
import 'package:camera/camera.dart';
import 'package:google_mlkit_face_detection/google_mlkit_face_detection.dart';
import 'package:tflite_flutter/tflite_flutter.dart' as tflite;
import 'package:image/image.dart' as imglib;

import 'dart:io';
import 'package:path_provider/path_provider.dart';

class FaceNetService {
  // singleton boilerplate
  static final FaceNetService _faceNetService = FaceNetService._internal();

  factory FaceNetService() {
    return _faceNetService;
  }
  // singleton boilerplate
  FaceNetService._internal();

  tflite.Interpreter? _interpreter;

  late imglib.Image? _img;

  double threshold = 1.0;

  late List? predictedData;

  //  saved users data
  dynamic data = {};

  // Funcoes para gravar a imagem...
  // Recupero o caminho para gravação local
  Future<File> writeImg(imglib.Image imagem) async {
    final diretorio = await getApplicationDocumentsDirectory();
    final caminho = diretorio.path;
    // converte para grayscale
    final p = imagem.getBytes();
    for(var i=0, len=p.length; i<len; i+=4 ){
      final l = imglib.getLuminanceRgb(p[i], p[i+1], p[i+2]);
      p[i]=l;
      p[i+1]=l;
      p[i+2]=l;
    }
    //salva a imagem localmente
    return File('$caminho/face.jpg').writeAsBytes(imglib.encodeJpg(imagem));
  }

  Future loadModel() async {
    if (_interpreter == null) {
      try {
        final gpuDelegateV2 = tflite.GpuDelegateV2(
            options: tflite.GpuDelegateOptionsV2(
                isPrecisionLossAllowed: false,
                inferencePreference: tflite.TfLiteGpuInferenceUsage.fastSingleAnswer,
                inferencePriority1: tflite.TfLiteGpuInferencePriority.minLatency,
                inferencePriority2: tflite.TfLiteGpuInferencePriority.auto,
                inferencePriority3: tflite.TfLiteGpuInferencePriority.auto));

        tflite.InterpreterOptions interpreterOptions = tflite
            .InterpreterOptions()
          ..addDelegate(gpuDelegateV2);
        _interpreter = await tflite.Interpreter.fromAsset(
            'mobilefacenet.tflite',
            options: interpreterOptions);
        print('modelo carregado com sucesso!');
      } catch (e) {
        print('Falha ao carregar o modelo.');
        print(e);
      }
    }
  }

  setCurrentPrediction(CameraImage cameraImage, Face face) {
    /// recorta a face da imagem original e a transforma em um array de dados
    List input = _preProcess(cameraImage, face);

    /// então faz o "reshape" do formato do modelo de entrada e saída 🧑‍🔧
    input = input.reshape([1, 112, 112, 3]);
    List output = List.generate(1, (index) => List.filled(192, 0));

    /// roda e transforma os dados 🤖
    _interpreter!.run(input, output);
    output = output.reshape([192]);

    predictedData = List.from(output);
  }

  /// pega os dados previstos previamente salvos e faz a inferencia
  // Future<User> predict() async {
  //   /// busca o usuário previsto mais próximo, se existir (visinho mais próximo)
  //   return await _searchResult(this._predictedData);
  // }

  /// _preProess: recorta a imagem para ser mais fácil
  /// para detectar e transformá-lo para o modelo de entrada.
  /// [cameraImage]: Imagem corrente
  /// [face]: face detectada
  List _preProcess(CameraImage image, Face faceDetected) {
    // recorta a face 💇
    imglib.Image croppedImage = _cropFace(image, faceDetected);
    imglib.Image img = imglib.copyResizeCropSquare(croppedImage, 112);

    // Aqui salva a imagem ...
    _img = img;
    writeImg(_img!);   // verificar como fazer isso
    // https://flutter.dev/docs/cookbook/persistence/reading-writing-files

    // transforma a face recortada em um array de dados
    Float32List imageAsList = imageToByteListFloat32(img);
    return imageAsList;
  }

  /// Recorta a face da imagem original 💇
  /// [cameraImage]: imagem corrente
  /// [face]: face detectada
  _cropFace(CameraImage image, Face faceDetected) {
    imglib.Image convertedImage = _convertCameraImage(image);
    double x = faceDetected.boundingBox.left - 10.0;
    double y = faceDetected.boundingBox.top - 10.0;
    double w = faceDetected.boundingBox.width + 10.0;
    double h = faceDetected.boundingBox.height + 10.0;
    return imglib.copyCrop(
        convertedImage, x.round(), y.round(), w.round(), h.round());
  }

  /// converte ___CameraImage___ para o tipo ___Image___
  /// [image]: imagem para ser convertida
  imglib.Image _convertCameraImage(CameraImage image) {
    int width = image.width;
    int height = image.height;
    var img = imglib.Image(width, height);
    const int hexFF = 0xFF000000;
    final int uvyButtonStride = image.planes[1].bytesPerRow;
    final int uvPixelStride = image.planes[1].bytesPerPixel!;
    for (int x = 0; x < width; x++) {
      for (int y = 0; y < height; y++) {
        final int uvIndex =
            uvPixelStride * (x / 2).floor() + uvyButtonStride * (y / 2).floor();
        final int index = y * width + x;
        final yp = image.planes[0].bytes[index];
        final up = image.planes[1].bytes[uvIndex];
        final vp = image.planes[2].bytes[uvIndex];
        int r = (yp + vp * 1436 / 1024 - 179).round().clamp(0, 255);
        int g = (yp - up * 46549 / 131072 + 44 - vp * 93604 / 131072 + 91)
            .round()
            .clamp(0, 255);
        int b = (yp + up * 1814 / 1024 - 227).round().clamp(0, 255);
        img.data[index] = hexFF | (b << 16) | (g << 8) | r;
      }
    }
    var img1 = imglib.copyRotate(img, -90);
    return img1;
  }

  Float32List imageToByteListFloat32(imglib.Image image) {
    /// tamanho de entrada = 112
    var convertedBytes = Float32List(1 * 112 * 112 * 3);
    var buffer = Float32List.view(convertedBytes.buffer);
    int pixelIndex = 0;

    for (var i = 0; i < 112; i++) {
      for (var j = 0; j < 112; j++) {
        var pixel = image.getPixel(j, i);

        /// mean: 128
        /// std: 128
        buffer[pixelIndex++] = (imglib.getRed(pixel) - 128) / 128;
        buffer[pixelIndex++] = (imglib.getGreen(pixel) - 128) / 128;
        buffer[pixelIndex++] = (imglib.getBlue(pixel) - 128) / 128;
      }
    }
    return convertedBytes.buffer.asFloat32List();
  }

  /// busca o resultado no DDBB (esta função deve ser executada em Backend)
  /// [predictedData]: Array que representa a face pelo modelo MobileFaceNet
  // Future<User> _searchResult(List predictedData) async {
  //   Codec<String, String> stringToBase64 = utf8.fuse(base64);
  //   String tokenPredictedData = stringToBase64.encode(predictedData.join(';'));
  //
  //   return await _userService.predict(tokenPredictedData);
  // }
  //
  void setPredictedData(value) {
    predictedData = value;
  }
}
