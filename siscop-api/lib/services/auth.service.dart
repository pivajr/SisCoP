import 'dart:convert';

import 'package:http/http.dart' as http;
import 'package:http/http.dart';
import 'package:SisCop/models/user.model.dart';
import 'package:SisCop/services/service.dart';

class AuthService extends Service {
  // singleton boilerplate
  static final AuthService _service = AuthService._internal();

  factory AuthService() {
    return _service;
  }

  // singleton boilerplate
  AuthService._internal();

  Future<User> registerUser(User user) async {
    Response res = await http.post(Uri.parse("$baseUrl/usuario"), headers: headers(), body: jsonEncode({
      'name': user.name,
      'email': user.user,
      'password': user.password,
      'predicted_token': user.predicted_token
    }));

    validateResponse(res);

    return User.fromJson(jsonDecode(res.body));
  }

  Future<User> update(User user) async {
    Response res = await http.put(Uri.parse("$baseUrl/usuario/${user.id}"), headers: headers(), body: jsonEncode({
      'name': user.name,
      'email': user.user,
      'password': user.password,
      'predicted_token': user.predicted_token
    }));

    validateResponse(res);

    return User.fromJson(jsonDecode(res.body));
  }

  Future<User?> findByEmail(String email) async {
    Response res = await http.get(Uri.parse("$baseUrl/usuario/email/$email"), headers: headers());

    if (res.statusCode < 200 || res.statusCode >=300) {
      return null;
    }

    return User.fromJson(jsonDecode(res.body));
  }

  Future<User?> predict(String token) async {
    Response res = await http.get(Uri.parse("$baseUrl/usuario/predict?predict_token=$token"), headers: headers());

    if (res.statusCode != 404) {
      validateResponse(res);
    } else {
      return null;
    }

    print(res.body);

    return User.fromJson(jsonDecode(res.body));
  }
}