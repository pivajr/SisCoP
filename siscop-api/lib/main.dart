import 'package:flutter/material.dart';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:provider/provider.dart';
import 'package:SisCop/notifiers/auth.dart';
import 'package:SisCop/pages/splash.dart';
import 'package:sentry_flutter/sentry_flutter.dart';
import 'dart:io' show Platform;

void main() async {
  await dotenv.load(mergeWith: Platform.environment);
  await dotenv.load(fileName: ".env");

  await SentryFlutter.init(
        (options) {
      options.dsn = dotenv.env['SENTRY_DNS'];
      // Set tracesSampleRate to 1.0 to capture 100% of transactions for performance monitoring.
      // We recommend adjusting this value in production.
      options.tracesSampleRate = 1.0;
    },
    appRunner: () => runApp(const MyApp()),
  );
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (context) => AuthNotifier(dotenv.env['ENDPOINT_URL']!),
      child: MaterialApp(
        debugShowCheckedModeBanner: false,
        title: 'SisCop',
        theme: ThemeData(
          primarySwatch: Colors.blue,
        ),
        home: const SplashPage()
      ),
    );
  }
}