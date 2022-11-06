import 'dart:convert';

class TokenizerService {
  // singleton boilerplate
  static final TokenizerService _faceNetService = TokenizerService._internal();

  factory TokenizerService() {
    return _faceNetService;
  }
  // singleton boilerplate
  TokenizerService._internal();

  String getPredictedToken(List predictedData) {
    Codec<String, String> stringToBase64 = utf8.fuse(base64);
    return stringToBase64.encode(predictedData.join(';'));
  }
}