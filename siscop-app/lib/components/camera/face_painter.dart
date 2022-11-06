import 'dart:ui';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:google_mlkit_face_detection/google_mlkit_face_detection.dart';

class FacePainter extends CustomPainter {
  final Size imageSize;
  final Face face;

  const FacePainter({required this.imageSize, required this.face});

  @override
  void paint(Canvas canvas, Size size) {
    Paint paint;

    if (face.headEulerAngleY! > 10 || face.headEulerAngleY! < -10) {
      paint = Paint()
        ..style = PaintingStyle.stroke
        ..strokeWidth = 3.0
        ..color = Colors.red;
    } else {
      paint = Paint()
        ..style = PaintingStyle.stroke
        ..strokeWidth = 3.0
        ..color = Colors.green;
    }

    double scaleX = size.width / imageSize.width;
    double scaleY = size.height / imageSize.height;

    canvas.drawRRect(
        _scaleRect(
            rect: face.boundingBox,
            imageSize: imageSize,
            widgetSize: size,
            scaleX: scaleX,
            scaleY: scaleY),
        paint);
  }

  @override
  bool shouldRepaint(FacePainter oldDelegate) {
    return oldDelegate.imageSize != imageSize || oldDelegate.face != face;
  }
}

RRect _scaleRect({
  required Rect rect,
  required Size imageSize,
  required Size widgetSize,
  required double scaleX,
  required double scaleY
}) {
  double left = (widgetSize.width - rect.left.toDouble() * scaleX);
  double top = rect.top.toDouble() * scaleY;
  double right = widgetSize.width - rect.right.toDouble() * scaleX;
  double bottom = rect.bottom.toDouble() * scaleY;
  Radius radius = const Radius.circular(10);

  print('>>> imageSize.width: ' + imageSize.width.toString());
  print('>>> imageSize.height: ' + imageSize.height.toString());
  print('>>> widgetSize.width: ' + widgetSize.width.toString());
  print('>>> widgetSize.height: ' + widgetSize.height.toString());
  print('>>> rect.left: ' + rect.left.toString());
  print('>>> scaleY: ' + scaleY.toString());
  print('>>> rect.right: ' + rect.right.toString());
  print('>>> scaleX: ' + scaleX.toString());
  print('>>> rect.bottom: ' + rect.bottom.toString());
  print('>>> left: ' + left.toString());
  print('>>> top: ' + top.toString());
  print('>>> right: ' + right.toString());
  print('>>> bottom: ' + bottom.toString());

  return RRect.fromLTRBR(
    left,
    top,
    right,
    bottom,
    radius
  );
}
