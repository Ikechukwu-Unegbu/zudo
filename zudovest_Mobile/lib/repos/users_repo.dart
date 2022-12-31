import 'dart:ffi';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:http/http.dart';
import 'package:zudovest/constants/currentuser.dart';
import 'package:zudovest/repos/api_uri.dart';

class UsersRepo extends ChangeNotifier {
  String _loginMsg = "";
  bool _isLoading = false;
  String get loginMsg => _loginMsg;
  bool get isLoading => _isLoading;

  getallUsers() async {
    List<Map> users = [{}, {}, {}];
    try {
      Response response = await http
          .get(Uri.parse(fetUsersUrl + currentUser!.token!.toString()));

      if (response.statusCode == 200) {
        // print(fetUsersUrl + currentUser!.token!.toString());
        //print(response.body);
        return users;
      }
    } catch (e) {
      print(e.toString());
    }

    return users;
  }

  void creditUser(
      {required String amount, required String userId, required String desc}) {
    print(amount);
    _isLoading = true;
    notifyListeners();

    http.post(url)

    try {} catch (e) {
      print(e.toString());
    }
  }
}
