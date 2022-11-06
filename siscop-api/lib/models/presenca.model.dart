import 'package:SisCop/models/user.model.dart';

class Presenca {
  int? id;
  double? latitude;
  double? longitude;
  User? user;
  int? user_id;
  int? turma_id;
  int? instituicao_id;
  DateTime? data_presenca;

  Presenca({this.id, this.latitude, this.longitude, this.user, this.user_id, this.turma_id, this.instituicao_id, this.data_presenca});

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'latitude': latitude,
      'longitude': longitude,
      'user_id': user_id,
      'turma_id': turma_id,
      'instituicao_id': instituicao_id,
      'data_presenca': data_presenca
    };
  }

  Presenca.fromJson(Map<String, dynamic> json)
      : id = json['data']['id'],
        latitude = json['data']['latitude'],
        longitude = json['data']['longitude'],
        user = User.fromJsonWithoutData(json['data']['user']),
        user_id = json['data']['user_id'],
        turma_id = json['data']['turma_id'],
        instituicao_id = json['data']['instituicao_id'],
        data_presenca = DateTime.parse(json['data']['data_presenca']);
}