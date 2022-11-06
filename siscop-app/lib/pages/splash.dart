import 'package:animated_splash_screen/animated_splash_screen.dart';
import 'package:flutter/material.dart';
import 'package:page_transition/page_transition.dart';
import 'package:SisCop/pages/login_email.dart';

class SplashPage extends StatelessWidget {
  const SplashPage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return AnimatedSplashScreen(
      splash: 'assets/splash_white.png',
      nextScreen: const LoginEmailPage(),
      splashTransition: SplashTransition.fadeTransition,
      backgroundColor: const Color.fromRGBO(0, 172, 255, 1),
      splashIconSize: 200,
      pageTransitionType: PageTransitionType.fade,
      animationDuration: const Duration(
        seconds: 1,
        milliseconds: 500
      ),
      curve: Curves.easeInExpo,
    );
  }

}