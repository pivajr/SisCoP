import 'package:SisCop/models/user.model.dart';

class LoginResponse {
  String token;
  User user;

  LoginResponse(this.token, this.user);

  Map<String, dynamic> toJson() {
    return {
      'token': token,
      'user': user,
    };
  }

  LoginResponse.fromJson(Map<String, dynamic> json)
      : token = json['token'],
        user = User.fromJsonWithoutData(json['user']);
}
