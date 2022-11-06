import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:SisCop/components/common/button_outline.dart';
import 'package:SisCop/components/common/gradient_page.dart';
import 'package:SisCop/components/forms/input.dart';
import 'package:SisCop/pages/login_password.dart';

class LoginEmailPage extends StatefulWidget {
  const LoginEmailPage({Key? key}) : super(key: key);

  @override
  State<LoginEmailPage> createState() => _LoginEmailPageState();
}

class _LoginEmailPageState extends State<LoginEmailPage> {
  TextEditingController email = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return GradientPage(
      alignment: MainAxisAlignment.center,
      child: Column(
      children: [
        const Text(
          'Olá, Qual é o seu e-mail?',
          style: TextStyle(
            color: Colors.white
          ),
        ),
        const SizedBox(
          height: 25,
        ),
        Input(
          type: TextInputType.emailAddress,
          controller: email,
          textColor: Colors.white,
          borderColor: Colors.white,
        ),
        const SizedBox(
          height: 25,
        ),
        ButtonOutline(
          icon: FontAwesomeIcons.chevronRight,
          iconRight: true,
          text: 'Continuar',
          onPressed: () {
            Navigator.push(context,
                MaterialPageRoute(builder: (BuildContext context) => LoginPasswordPage(email: email,))
            );
          }
        )
      ])
    );
  }
}