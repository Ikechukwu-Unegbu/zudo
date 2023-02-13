import 'package:flutter/material.dart';
import 'package:rflutter_alert/rflutter_alert.dart';

showAlert(
    BuildContext context, AlertType alertType, String title, String body) {
  Alert(
    context: context,
    type: alertType,
    title: title,
    desc: body,
    buttons: [
      DialogButton(
        child: Text(
          "Ok",
          style: TextStyle(color: Colors.white, fontSize: 20),
        ),
        onPressed: () => Navigator.pop(context),
        color: Color.fromRGBO(0, 179, 134, 1.0),
      ),
    ],
  ).show();
}
