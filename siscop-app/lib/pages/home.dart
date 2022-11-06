import 'package:camera/camera.dart';
import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:geolocator/geolocator.dart';
import 'package:provider/provider.dart';
import 'package:SisCop/components/camera/face_camera.dart';
import 'package:SisCop/components/common/aligned_page.dart';
import 'package:SisCop/components/common/base_page.dart';
import 'package:SisCop/components/common/button.dart';
import 'package:SisCop/components/common/button_outline.dart';
import 'package:SisCop/components/common/gradient_page.dart';
import 'package:SisCop/components/common/header_user.dart';
import 'package:SisCop/components/common/loading_dialog.dart';
import 'package:SisCop/components/forms/input.dart';
import 'package:SisCop/components/forms/input_password.dart';
import 'package:SisCop/models/presenca.model.dart';
import 'package:SisCop/models/user.model.dart';
import 'package:SisCop/notifiers/auth.dart';
import 'package:SisCop/services/auth.service.dart';
import 'package:SisCop/services/facenet.service.dart';
import 'package:SisCop/services/presenca.service.dart';
import 'package:SisCop/services/tokenizer.service.dart';

class HomePage extends StatefulWidget {
  const HomePage({Key? key}) : super(key: key);

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  final PresencaService presencaService = PresencaService();
  final FaceNetService faceNetService = FaceNetService();
  final AuthService authService = AuthService();
  final TokenizerService tokenizerService = TokenizerService();

  Future<Position> _recuperaLocalizacaoAtual() async {
    return await Geolocator.getCurrentPosition(desiredAccuracy: LocationAccuracy.high);
  }

  @override
  Widget build(BuildContext context) {
    return AlignedPage(
      alignment: MainAxisAlignment.start,
      child: Expanded(
        child: Flex(
          direction: Axis.vertical,
          children: [
            const SizedBox(
              height: 40,
            ),
            const HeaderUser(
              textColor: Colors.black54,
            ),
            Expanded(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Text(
                    'Confirme a sua presença 😉',
                    style: TextStyle(
                      fontSize: 20
                    ),
                  ),
                  const SizedBox(
                    height: 20,
                  ),
                  SizedBox(
                    width: 200,
                    height: 200,
                    child: ButtonOutline(
                      text: '',
                      onPressed: () async {
                        showDialog(
                            barrierDismissible: false,
                            context: context,
                            builder: (_) {
                              return const LoadingDialog(text: 'Estamos confirmando a sua presença 😎',);
                            }
                        );

                        XFile file = await Navigator.push(context,
                            MaterialPageRoute(builder: (BuildContext context) => const FaceCamera())
                        );

                        String token = tokenizerService.getPredictedToken(faceNetService.predictedData!);

                        User? predicted = await authService.predict(token);


                        if (predicted != null) {
                          Position local = await _recuperaLocalizacaoAtual();

                          if (!mounted) return;
                          User user = Provider
                              .of<AuthNotifier>(context, listen: false)
                              .user;

                          await presencaService.registrarPresenca(Presenca(
                              latitude: local.latitude,
                              longitude: local.longitude,
                              user_id: user.id
                          ), file.path);

                          if (!mounted) return;
                          Navigator.pop(context);

                          showDialog(context: context, builder: (context) {
                            return AlertDialog(
                              title: const Text('Sucesso...🥳'),
                              actions: [TextButton(onPressed: () => Navigator.pop(context), child: const Text('OK'))],
                              content: const Text(
                                  'A sua presença foi confirmada 🤩'),
                            );
                          });
                        } else {
                          if (!mounted) return;

                          Navigator.pop(context);

                          showDialog(context: context, builder: (context) {
                            return AlertDialog(
                              title: const Text('Oops...😱'),
                              actions: [TextButton(onPressed: () => Navigator.pop(context), child: const Text('OK'))],
                              content: const Text(
                                  'Não consegui te reconhecer 🤨, você é realmente você? 🕵️'),
                            );
                          });
                        }
                      },
                      icon: FontAwesomeIcons.userCheck,
                      iconSize: 50,
                      radius: 100,
                      color: Colors.blue,
                    ),
                  )
                ],
              )
            )
          ],
        ),
      )
    );
  }
}
