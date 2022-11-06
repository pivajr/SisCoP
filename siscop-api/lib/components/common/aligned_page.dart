import 'package:flutter/material.dart';
import 'package:SisCop/components/common/base_page.dart';

class AlignedPage extends StatelessWidget {
  final Widget child;
  final MainAxisAlignment alignment;

  const AlignedPage({Key? key, required this.alignment, required this.child}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return BasePage(
      child:
      Flex(
        direction: Axis.vertical,
        children: [
        Expanded(
          child: Column(
            mainAxisAlignment: alignment,
            children: [
              child
            ],
          )
        )
        ],
      ),
    );
  }

}