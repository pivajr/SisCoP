import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:provider/provider.dart';
import 'package:SisCop/components/common/button_outline.dart';
import 'package:SisCop/components/common/error_message.dart';
import 'package:SisCop/components/common/gradient_page.dart';
import 'package:SisCop/components/common/loading_dialog.dart';
import 'package:SisCop/components/forms/input.dart';
import 'package:SisCop/components/forms/input_password.dart';
import 'package:SisCop/notifiers/auth.dart';
import 'package:SisCop/pages/home.dart';
import 'package:SisCop/pages/login_primeiro_acesso.dart';
import 'package:SisCop/services/auth.service.dart';

import '../models/user.model.dart';

class LoginPasswordPage extends StatefulWidget {
  final TextEditingController email;
  const LoginPasswordPage({Key? key, required this.email}) : super(key: key);

  @override
  State<LoginPasswordPage> createState() => _LoginPasswordPageState();
}

class _LoginPasswordPageState extends State<LoginPasswordPage> {
  TextEditingController password = TextEditingController();
  AuthService service = AuthService();
  late String? errorMessage;

  @override
  void initState() {
    super.initState();

    errorMessage = null;
  }

  @override
  Widget build(BuildContext context) {
    return GradientPage(
        alignment: MainAxisAlignment.center,
        child: Column(
            children: [
              const Text(
                'Para continuar preciso que você informe a sua senha',
                style: TextStyle(
                    color: Colors.white
                ),
              ),
              const SizedBox(
                height: 25,
              ),
              InputPassword(
                controller: password,
                textColor: Colors.white,
                borderColor: Colors.white,
              ),
              const SizedBox(
                height: 10,
              ),
              errorMessage != null ? ErrorMessage(message: errorMessage!) : const Text(''),
              const SizedBox(
                height: 5,
              ),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  ButtonOutline(
                      text: 'Voltar',
                      icon: FontAwesomeIcons.chevronLeft,
                      onPressed: () {
                        Navigator.pop(context);
                      }
                  ),
                  const SizedBox(width: 10,),
                  ButtonOutline(
                      icon: FontAwesomeIcons.chevronRight,
                      iconRight: true,
                      text: 'Continuar',
                      onPressed: () async {
                        showDialog(
                            barrierDismissible: false,
                            context: context,
                            builder: (_) {
                              return LoadingDialog(text: 'Procurando o usuário com o email ${ widget.email.value.text }',);
                            }
                        );

                        User? user = await service.login(widget.email.value.text, password.value.text);

                        if (!mounted) return;

                        Navigator.of(context).pop();

                        if (user != null) {
                          Provider.of<AuthNotifier>(context, listen: false).setUser(user);

                          if (user.primeiro_acesso) {
                            Navigator.pushReplacement(context,
                                MaterialPageRoute(builder: (
                                    BuildContext context) => const LoginPrimeiroAcessoPage())
                            );
                          } else {
                            Navigator.pushReplacement(context,
                                MaterialPageRoute(builder: (
                                    BuildContext context) => const HomePage())
                            );
                          }
                        } else {
                          password.clear();
                          setState(() {
                            errorMessage = 'O e-mail ou a senha que você informou está incorreta';
                          });
                        }
                      }
                  )
                ],
              )
            ])
    );
  }
}