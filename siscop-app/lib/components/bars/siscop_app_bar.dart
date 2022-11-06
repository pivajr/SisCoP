import 'package:flutter/material.dart';

class SiscopAppBar extends StatelessWidget implements PreferredSizeWidget{
  final double height;

  const SiscopAppBar({Key? key, this.height = kToolbarHeight}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      height: preferredSize.height,
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
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: const [
          SizedBox(
            width: 100,
            child: Image(
              image: AssetImage('assets/logo2_white.png'),
            ),
          )
        ],
      ),
    );
  }

  @override
  Size get preferredSize => Size.fromHeight(height);

}