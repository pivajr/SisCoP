//Versão 1.0 - Sistema de Controle de Presença
//

import 'package:flutter/material.dart';

class User {
  int? id;
  String? user;
  String? name;
  String? password;
  String? local;
  String? predicted_token;
  bool primeiro_acesso;
  String? letras_nome;

  User({this.id, required this.user, required this.name, required this.password, this.local, required this.predicted_token, this.letras_nome, this.primeiro_acesso = false});

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'user': user,
      'name': name,
      'password': password,
      'local': local,
      'predicted_token': predicted_token,
      'letras_nome': letras_nome
    };
  }

  User.fromJson(Map<String, dynamic> json)
      : id = json['data']['id'],
        user = json['data']['email'],
        name = json['data']['name'],
        password = json['data']['password'],
        local = json['data']['local'],
        predicted_token = json['data']['predicted_token'],
        primeiro_acesso = json['data']['primeiro_acesso'],
        letras_nome = json['data']['letras_nome'];

  User.fromJsonWithoutData(Map<String, dynamic> json)
    : id = json['id'],
        user = json['email'],
        name = json['name'],
        password = json['password'],
        local = json['local'],
        predicted_token = json['predicted_token'],
        primeiro_acesso = json['primeiro_acesso'],
        letras_nome = json['letras_nome'];
}
