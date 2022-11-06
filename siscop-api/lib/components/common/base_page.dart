import 'package:flutter/material.dart';
import 'package:SisCop/components/bars/siscop_app_bar.dart';

class BasePage extends StatelessWidget {
  final Widget child;
  final Widget? floatingActionButton;

  const BasePage({Key? key, required this.child, this.floatingActionButton}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size screen = MediaQuery.of(context).size;
    return Scaffold(
      appBar: const SiscopAppBar(),
      body: Container(
        width: screen.width,
        height: screen.height,
        padding: const EdgeInsets.all(10),
        child: child,
      ),
      floatingActionButton: floatingActionButton,
    );
  }
  
}