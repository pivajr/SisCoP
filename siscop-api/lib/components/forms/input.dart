import 'package:flutter/material.dart';

class Input extends StatelessWidget {
  final TextEditingController controller;
  final TextInputType type;
  final bool isPassword;
  final Widget start;
  final Widget end;
  final Color borderColor;
  final Color textColor;

  const Input({
    Key? key,
    required this.controller,
    this.type = TextInputType.text,
    this.isPassword = false,
    this.start = const Text(''),
    this.end = const Text(''),
    this.borderColor = Colors.blue,
    this.textColor = Colors.blue
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        border: Border.all(
          width: 1,
          style: BorderStyle.solid,
          color: borderColor
        ),
        borderRadius: const BorderRadius.all(Radius.circular(7))
      ),
      padding: const EdgeInsets.fromLTRB(10, 0, 10, 0),
      child: Row(
        children: [
          start,
          Expanded(
            child: TextField(
              obscureText: isPassword,
              controller: controller,
              keyboardType: type,
              cursorColor: textColor,
              style: TextStyle(
                color: textColor
              ),
              decoration: const InputDecoration(
                  labelStyle: TextStyle(
                      color: Colors.black26
                  ),
                  border: InputBorder.none,
                  enabledBorder: InputBorder.none,
                  focusedBorder: InputBorder.none
              ),
            ),
          ),
          end
        ],
      )
      );
  }
}