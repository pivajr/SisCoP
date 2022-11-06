import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:provider/provider.dart';
import 'package:SisCop/components/common/button_outline.dart';
import 'package:SisCop/components/common/gradient_page.dart';
import 'package:SisCop/components/common/header_user.dart';
import 'package:SisCop/components/common/loading_dialog.dart';
import 'package:SisCop/components/forms/input_password.dart';
import 'package:SisCop/models/user.model.dart';
import 'package:SisCop/notifiers/auth.dart';
import 'package:SisCop/pages/cadastro_face.dart';
import 'package:SisCop/services/auth.service.dart';

class LoginPrimeiroAcessoPage extends StatefulWidget {
  const LoginPrimeiroAcessoPage({Key? key}) : super(key: key);

  @override
  State<LoginPrimeiroAcessoPage> createState() => _LoginPrimeiroAcessoPageState();
}

class _LoginPrimeiroAcessoPageState extends State<LoginPrimeiroAcessoPage> {
  final AuthService authService = AuthService();
  final TextEditingController password = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return GradientPage(
        alignment: MainAxisAlignment.center,
        child: Column(
            children: [
              const HeaderUser(textColor: Colors.white,),
              const SizedBox(
                height: 20,
              ),
              const Text(
                'Identificamos que esse é o seu primeiro acesso, para sua segurança você precisa alterar a sua senha',
                textAlign: TextAlign.center,
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
                height: 25,
              ),
              ButtonOutline(
                  icon: FontAwesomeIcons.check,
                  text: 'Confirmar',
                  onPressed: () {
                    Widget buttonNao = TextButton(onPressed: () => Navigator.pop(context), child: const Text('Não'));
                    Widget buttonSim = TextButton(onPressed: () async {
                      User user = Provider.of<AuthNotifier>(context, listen: false).user;

                      user.password = password.value.text;

                      showDialog(
                          barrierDismissible: false,
                          context: context,
                          builder: (_) {
                            return const LoadingDialog(text: 'Estamos alterando a sua senha, logo terminamos 😴');
                          }
                      );

                      await authService.update(user);

                      if (!mounted) return;

                      Navigator.pushReplacement(context,
                          MaterialPageRoute(builder: (
                              BuildContext context) => const CadastroFacePage())
                      );
                    }, child: const Text('Sim'));
                    showDialog(context: context, builder: (context) {
                      return AlertDialog(
                        title: const Text('Atenção'),
                        actions: [buttonNao, buttonSim],
                        content: const Text('Você tem certeza que quer utilizar a senha informada?'),
                      );
                    });
                  }
              )
            ])
    );
  }

}