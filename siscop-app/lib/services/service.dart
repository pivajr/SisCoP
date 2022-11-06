import 'dart:convert';

import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:http/http.dart' as http;
import 'package:SisCop/models/login_response.dart';
import 'package:SisCop/models/user.model.dart';

class LoadTokenModel {
  String email;
  String senha;
  String deviceName;

  LoadTokenModel({required this.email, required this.senha, required this.deviceName});

  Map<String, dynamic> toJson() {
    return {
      'email': email,
      'password': senha,
      'device_name': deviceName
    };
  }
}



abstract class Service {
  static String? token;
  late String baseUrl;

  Service() {
    baseUrl = dotenv.env['ENDPOINT_URL']!;
  }

  Future<User?> login(String email, String senha) async {
    String deviceName = 'app';
    http.Response res = await http.post(Uri.parse("$baseUrl/sanctum/token"), body: jsonEncode(LoadTokenModel(email: email, senha: senha, deviceName: deviceName)), headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json; charset=UTF-8'
    });

    if (res.statusCode == 200) {
      LoginResponse response = LoginResponse.fromJson(jsonDecode(res.body));
      token = response.token;

      return response.user;
    }

    return null;
  }

  Map<String, String> headers() {
    var header = {
      'Accept': 'application/json',
      'Content-Type': 'application/json; charset=UTF-8'
    };

    if (token != null) {
      header['Authorization'] = 'Bearer $token';
    }

    return header;
  }

  void validateResponse(http.BaseResponse response) {
    if (response.statusCode < 200 || response.statusCode >=300) {
      throw Exception('Falha ao processar response');
    }
  }
}