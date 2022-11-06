import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';

class Button extends StatelessWidget {
  final String text;
  final void Function() onPressed;
  final Color color;
  final Color backgroundColor;
  final IconData? icon;
  final double fontSize;
  final double radius;

  const Button({
    Key? key,
    required this.text,
    required this.onPressed,
    this.color = Colors.white,
    this.backgroundColor = Colors.blue,
    this.icon,
    this.fontSize = 15,
    this.radius = 5
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return icon != null ?
    ElevatedButton.icon(
      onPressed: onPressed,
      icon: FaIcon(
        icon!,
        size: fontSize,
        color: color,
      ),
      label: getLabel(),
      style: getStyle(),
    )
        :
    ElevatedButton(
      onPressed: onPressed,
      style: getStyle(),
      child: getLabel()
    );
  }

  ButtonStyle getStyle() {
    return ButtonStyle(
        backgroundColor: MaterialStateProperty.all(backgroundColor),
        elevation: MaterialStateProperty.all(0),
        side: MaterialStateProperty.all<BorderSide>(
            BorderSide(width: 1, style: BorderStyle.solid, color: color)),
        shape: MaterialStateProperty.all<RoundedRectangleBorder>(
          RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(radius)
          ),
        )
    );
  }

  Widget getLabel() {
    return Text(
      text,
      style: TextStyle(
          color: color,
          fontSize: fontSize,
          fontWeight: FontWeight.w400
      ),
    );
  }
}