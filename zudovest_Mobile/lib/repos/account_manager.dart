import 'dart:convert';

import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:http/http.dart';
import 'package:zudovest/models/usermodel.dart';
import 'package:zudovest/repos/navigator_service.dart';
import 'package:zudovest/screens/dashboard/homescreen.dart';

import '../constants/currentuser.dart';
import 'api_uri.dart';
import 'general.dart';

class AccountManager extends ChangeNotifier {
  String passwordValidatorMsg = "password must be greater than 5 characters";
  String emailValidatorMsg = "invalid email";
  String _loginMsg = "";
  bool _isLoding = false;
  String get loginMsg => _loginMsg;
  bool get isLoding => _isLoding;

  String fieldValidatorMsg(String key) {
    return '$key is empty';
  }

  bool passwordValidator(String password) {
    return password.trim().length > 5;
  }

  bool fieldValidator(String input) {
    return input.trim().isEmpty;
  }

  bool emailValidator(String email) {
    final bool emailValid = RegExp(
            r"^[a-zA-Z0-9.a-zA-Z0-9.!#$%&'*+-/=?^_`{|}~]+@[a-zA-Z0-9]+\.[a-zA-Z]+")
        .hasMatch(email);

    return emailValid;
  }

  void login(String email, String password) async {
    _isLoding = true;
    _loginMsg = "";
    //bool isSuccessful = false;
    notifyListeners();
    try {
      Response response = await http
          .post(channelLoginUri, body: {"email": email, "password": password});
      dynamic result = jsonDecode(response.body);
      if (response.statusCode == 200) {
        print(result);

        /// GeneralRepo().navigateToScreen2(HomeScreen());
        // isSuccessful = true;
        UserModel userModel = UserModel.fromJson(result);
        currentUser = userModel;

        NavigationService().navigateToScreen(HomeScreen(
          userModel: userModel,
        ));
        print(result);
        // var username = result["username"];
        // var access = result["access"];
        // var token = result["token"];

        _loginMsg = result["message"];
      } else {
        _loginMsg = result[
            "message"]; //response.statusCode.toString(); //"An Error occoured";
      }
    } catch (e) {
      _loginMsg = e.toString();

      /// notifyListeners();

    }
    _isLoding = false;
    notifyListeners();
    //return isSuccessful;
  }
}
