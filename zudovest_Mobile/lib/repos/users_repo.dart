import 'dart:convert';
import 'dart:ffi';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:http/http.dart';
import 'package:zudovest/constants/currentuser.dart';
import 'package:zudovest/repos/api_uri.dart';

class UsersRepo extends ChangeNotifier {
  GlobalKey<FormState> formKey = GlobalKey<FormState>();

  String _responseMsg = "";
  bool _isLoading = false;
  String get responseMsg => _responseMsg;
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

  Future<bool> creditUser(
      {required String amount,
      required String userId,
      required String desc}) async {
    print(desc);
    _responseMsg = "";

    _isLoading = true;
    notifyListeners();

    try {
      Response response = await http.post(
          Uri.parse(creditUrl + currentUser!.id!.toString()),
          body: {"amount": amount, "customer": userId, "purpose": desc});

      var data = jsonDecode(response.body);
      _isLoading = false;

      if (data["customer_id"] > 0) {
        _responseMsg = "";
        return true;
      } else {
        _responseMsg = data["message"];
      }

      notifyListeners();
      return false;
    } catch (e) {
      print(e.toString());
    }

    return false;
  }
}
