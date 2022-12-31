import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';

import '../constants/colors.dart';
import '../constants/dimensions.dart';

class TextInputField2 extends StatefulWidget {
  String labelText;
  TextInputType? textInputType;
  TextEditingController controller;
  bool readOnly = false;

  String? Function(String?)? validator;
  //Function validator;

  TextInputField2(
      {Key? key,
      required this.labelText,
      this.textInputType = TextInputType.text,
      required this.controller,
      required this.validator,
      this.readOnly =false
      })
      : super(key: key);

  @override
  State<TextInputField2> createState() => _TextInputField2State();
}

class _TextInputField2State extends State<TextInputField2> {
  @override
  Widget build(BuildContext context) {
    final inputBorder =
        OutlineInputBorder(borderSide: Divider.createBorderSide(context));
    return Container(
      width: getSize(context).width / 1.3,
      child: TextFormField(
        readOnly: widget.readOnly,
        keyboardType: widget.textInputType,
        controller: widget.controller,
        cursorColor: primaryColor,
        style: TextStyle(color: primaryColor),
        decoration: InputDecoration(
          labelText: widget.labelText,
          labelStyle: TextStyle(fontFamily: "DidactGothic"),
          border: inputBorder,
          focusedBorder: inputBorder,
          enabledBorder: inputBorder,
          filled: true,
          fillColor: Colors.white38,
          contentPadding: const EdgeInsets.all(8.0),

          // focusedBorder: UnderlineInputBorder(
          //     borderSide: new BorderSide(color: primaryColor))
        ),
        validator: widget.validator,
      ),
    );
  }
}
