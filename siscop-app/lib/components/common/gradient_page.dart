import 'package:flutter/material.dart';
import 'package:SisCop/components/bars/siscop_app_bar.dart';

class GradientPage extends StatelessWidget {
  final Widget child;
  final MainAxisAlignment alignment;
  const GradientPage({Key? key, required this.child, this.alignment = MainAxisAlignment.start}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        width: MediaQuery.of(context).size.width,
        decoration: const BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
              colors: [
                Color.fromRGBO(132, 51, 218, 1),
                Color.fromRGBO(0, 172, 255, 1),
              ],
            )
        ),
        padding: const EdgeInsets.all(10),
        child: Column(
          children: [
            const SizedBox(
              width: 200,
              child: Image(
                image: AssetImage('assets/logo2_white.png'),
              ),
            ),
            Expanded(
              child: Column(
                mainAxisAlignment: alignment,
                children: [
                  child
                ],
              ),
            )
          ],
        ),
      ),
    );
  }

}