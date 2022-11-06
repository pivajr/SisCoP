import 'package:flutter/material.dart';

class LoadingDialog extends StatelessWidget {
  final String text;

  const LoadingDialog({Key? key, this.text = 'Loading'}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Dialog(
      // The background color
      backgroundColor: Colors.white,
      child: Padding(
        padding: const EdgeInsets.all(20),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            // The loading indicator
            const CircularProgressIndicator(),
            const SizedBox(
              height: 15,
            ),
            // Some text
            Text(
              '$text...',
              textAlign: TextAlign.center,
            )
          ],
        ),
      ),
    );
  }

}