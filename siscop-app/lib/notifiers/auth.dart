import 'package:flutter/material.dart';
import 'package:path/path.dart';
import 'package:SisCop/models/user.model.dart';

class AuthNotifier extends ChangeNotifier {
  late String token;
  String baseUri;
  late User user;

  AuthNotifier(this.baseUri);

  void setUser(User user) {
    this.user = user;

    notifyListeners();
  }

  void setToken(String token) {
    this.token = token;

    notifyListeners();
  }
}
