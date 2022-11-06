import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:SisCop/notifiers/auth.dart';

class HeaderUser extends StatelessWidget {
  final Color textColor;
  final Color avatarColor;

  const HeaderUser({Key? key, this.textColor = Colors.blue, this.avatarColor = Colors.blue}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Row(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          CircleAvatar(
            backgroundColor: avatarColor,
            radius: 20,
            child: Consumer<AuthNotifier>(
              builder: (context, value, child) => Text(
                value.user.letras_nome!,
                style: const TextStyle(
                    fontSize: 17
                ),
              ),
            ),
          ),
          const SizedBox(
            width: 13,
          ),
          Consumer<AuthNotifier>(
              builder: (context, value, child) => Column(
                children: [
                  getText(value.user.name!, fontSize: 17),
                  getText(value.user.user!)
                ],
              ),
          )
        ],
      );
  }

  Text getText(String text, {double fontSize = 12}) {
    return Text(
      text,
      style: TextStyle(
          color: textColor,
          fontSize: fontSize
      ),
    );
  }

}