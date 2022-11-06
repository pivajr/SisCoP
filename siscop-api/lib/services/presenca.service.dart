import 'dart:convert';

import 'package:SisCop/models/presenca.model.dart';
import 'package:SisCop/services/service.dart';
import 'package:http/http.dart';

import 'package:http_parser/http_parser.dart';

class PresencaService extends Service {
  // singleton boilerplate
  static final PresencaService _service = PresencaService._internal();

  factory PresencaService() {
    return _service;
  }

  // singleton boilerplate
  PresencaService._internal();

  Future<Presenca> registrarPresenca(Presenca presenca, String imagem) async {
    MultipartRequest request = MultipartRequest(
      'POST', Uri.parse("$baseUrl/presenca")
    );

    request.headers.addAll(headers());

    request.files.add(MultipartFile.fromString('imagem', imagem, filename: 'user.jpg', contentType: MediaType('image', 'jpg')));

    request.fields['latitude'] = presenca.latitude.toString();
    request.fields['longitude'] = presenca.longitude.toString();
    request.fields['user_id'] = presenca.user_id.toString();

    if (presenca.turma_id != null) {
      request.fields['turma_id'] = presenca.turma_id.toString();
    }

    StreamedResponse res = await request.send();

    validateResponse(res);

    return Presenca.fromJson(jsonDecode(await res.stream.bytesToString()));
  }
}