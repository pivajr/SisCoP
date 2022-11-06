import 'package:flutter/material.dart';
import 'package:font_awesome_flutter/font_awesome_flutter.dart';
import 'package:SisCop/components/common/button.dart';

class ButtonOutline extends StatelessWidget {
  final String text;
  final void Function() onPressed;
  final Color color;
  final Color backgroundColor;
  final IconData? icon;
  final double iconSize;
  final bool iconRight;
  final double radius;

  const ButtonOutline({
    Key? key,
    required this.text,
    required this.onPressed,
    this.color = Colors.white,
    this.backgroundColor = Colors.blue,
    this.icon,
    this.iconSize = 15,
    this.iconRight = false,
    this.radius = 5
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return icon != null ?
    OutlinedButton.icon(
      onPressed: onPressed,
      icon: iconRight ? getLabel() : getIcon(),
      label: iconRight ? getIcon() : getLabel(),
      style: getStyle(),
    )
        :
    OutlinedButton(
        onPressed: onPressed,
        style: getStyle(),
        child: getLabel()
    );
  }

  Widget getIcon() {
    return FaIcon(
      icon!,
      size: iconSize,
      color: color,
    );
  }

  ButtonStyle getStyle() {
    return ButtonStyle(
      elevation: MaterialStateProperty.all(0),
      side: MaterialStateProperty.all<BorderSide>(BorderSide(width: 1, style: BorderStyle.solid, color: color)),
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
          fontWeight: FontWeight.w400
      ),
    );
  }
}