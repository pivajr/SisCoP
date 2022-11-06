import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:SisCop/components/forms/input.dart';

class InputPassword extends StatefulWidget {
  final TextEditingController controller;
  final Color borderColor;
  final Color textColor;

  const InputPassword({Key? key, required this.controller, this.textColor = Colors.blue, this.borderColor = Colors.blue}) : super(key: key);

  @override
  State<InputPassword> createState() => _InputPasswordState();
}

class _InputPasswordState extends State<InputPassword> {
  late bool hidePassword;

  @override
  void initState() {
    super.initState();

    setState(() {
      hidePassword = true;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Input(
      controller: widget.controller,
      isPassword: hidePassword,
      textColor: widget.textColor,
      borderColor: widget.borderColor,
      end: InkWell(
        onTap: () {
          setState(() {
            hidePassword = !hidePassword;
          });
        },
        child: FaIcon(
          hidePassword ? FontAwesomeIcons.eye : FontAwesomeIcons.eyeSlash,
          color: widget.textColor,
          size: 17,
        )
      ),
    );
  }
}