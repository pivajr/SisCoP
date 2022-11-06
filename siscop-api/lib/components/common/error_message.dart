import 'package:flutter/material.dart';

class ErrorMessage extends StatelessWidget {
  final String message;

  const ErrorMessage({Key? key, required this.message}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: const BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.all(Radius.circular(5))
      ),
      padding: const EdgeInsets.all(10),
      child: Text(
      message,
      style: const TextStyle(
          color: Colors.redAccent,
          fontWeight: FontWeight.bold
      ),
    ),);
  }

}