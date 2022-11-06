import 'dart:convert';

import 'package:camera/camera.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:geolocator/geolocator.dart';
import 'package:provider/provider.dart';
import 'package:SisCop/components/camera/face_camera.dart';
import 'package:SisCop/components/common/aligned_page.dart';
import 'package:SisCop/components/common/button.dart';
import 'package:SisCop/components/common/loading_dialog.dart';
import 'package:SisCop/models/user.model.dart';
import 'package:SisCop/notifiers/auth.dart';
import 'package:SisCop/pages/home.dart';
import 'package:SisCop/services/auth.service.dart';
import 'package:SisCop/services/facenet.service.dart';
import 'package:SisCop/services/tokenizer.service.dart';

class CadastroFacePage extends StatefulWidget {
  const CadastroFacePage({Key? key}) : super(key: key);

  @override
  State<CadastroFacePage> createState() => _CadastroFacePageState();
}

class _CadastroFacePageState extends State<CadastroFacePage> {
  final FaceNetService faceNetService = FaceNetService();
  final AuthService authService = AuthService();
  final TokenizerService tokenizerService = TokenizerService();

  @override
  Widget build(BuildContext context) {
    return AlignedPage(
      alignment: MainAxisAlignment.center,
      child: Column(
        children: [
          Consumer<AuthNotifier>(builder: (context, value, child) => Text('Bem-vindo, ${value.user.name}')),
          const SizedBox(height: 10,),
          const Text('Para conseguir registrar sua presença vamos precisar que você cadastre seus rosto, vamos começar?'),
          const SizedBox(height: 10,),
          Button(
            text: 'Começar',
            icon: FontAwesomeIcons.camera,
            onPressed: () async {
              await Navigator.push(context,
                  MaterialPageRoute(builder:
                    (BuildContext context) => const FaceCamera()
                  )
              );

              if (!mounted) return;

              User user = Provider.of<AuthNotifier>(context, listen: false).user;

              user.predicted_token = tokenizerService.getPredictedToken(faceNetService.predictedData!);

              showDialog(
                  barrierDismissible: false,
                  context: context,
                  builder: (_) {
                    return const LoadingDialog(text: 'Foto daora ein 😎, estamos guardando ela em nossa base de dados 🤖',);
                  }
              );

              await authService.update(user);

              /// reseta a face armazenada no face net sevice
              faceNetService.setPredictedData(null);

              if (!mounted) return;

              Navigator.pushReplacement(context,
                  MaterialPageRoute(builder: (
                      BuildContext context) => const HomePage())
              );
            }
          )
        ],
      )
    );
  }
}