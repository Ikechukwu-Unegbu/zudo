import 'dart:convert';
import 'dart:io';
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
  UsersRepo() {
    notifyListeners();
  }

  getallUsers() async {
    List<Map> users = [];
    try {
      // print(fetUsersUrl);
      //print(currentUser!.token!.toString());
      Response response = await http.get(Uri.parse(fetUsersUrl), headers: {
        HttpHeaders.authorizationHeader: currentUser!.token!.toString(),
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + currentUser!.token!.toString(),
      });

      if (response.statusCode == 200) {
        //print(fetUsersUrl + currentUser!.token!.toString());
        //print(response.body);
        var result = jsonDecode(response.body);

        return result['data'];
      }
    } catch (e) {
      print(e.toString());
    }

    return users;
  }

  Future<bool> transact(
      {required String amount,
      required String userId,
      required String desc,
      required int transactionType}) async {
    print(desc);
    _responseMsg = "";

    _isLoading = true;
    notifyListeners();

    try {
      print(creditUrl);
      Response response = await http.post(
          Uri.parse(transactionType == 1 ? creditUrl : debitUrl),
          body: jsonEncode(
              {"amount": amount, "customer": userId, "purpose": desc}),
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + currentUser!.token!.toString(),
          });

      var data = jsonDecode(response.body);
      print(data);
      _isLoading = false;

      if (data["status"] == true) {
        _responseMsg = data["message"];
        notifyListeners();
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
