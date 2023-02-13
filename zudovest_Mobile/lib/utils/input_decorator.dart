import 'package:flutter/material.dart';
import 'package:zudovest/constants/colors.dart';

inputDecoration(BuildContext context, String labelText, IconData icon) {
  final inputBorder =
      OutlineInputBorder(borderSide: Divider.createBorderSide(context));
  return InputDecoration(
    labelText: labelText,
    labelStyle: TextStyle(fontFamily: "DidactGothic"),
    border: inputBorder,
    focusedBorder: inputBorder,
    enabledBorder: inputBorder,
    filled: true,
    fillColor: Colors.white38,
    contentPadding: const EdgeInsets.all(8.0),
    prefixIcon: Icon(
      icon,
      color: primaryColor,
    ),
    // focusedBorder: UnderlineInputBorder(
    //     borderSide: new BorderSide(color: primaryColor))
  );
}
