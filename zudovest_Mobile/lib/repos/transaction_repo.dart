import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart';
import 'package:zudovest/models/transaction_model.dart';
import 'package:http/http.dart' as http;
import 'package:zudovest/repos/api_uri.dart';

import '../constants/currentuser.dart';

class TransactionRepo extends ChangeNotifier {
  bool isPostinCredit = false;
  bool get _isPostinCredit => isPostinCredit;
  getCredits(int type) async {
    List<Map> users = [];
    try {
      // print(fetUsersUrl);
      //print(currentUser!.token!.toString());
      Response response = await http
          .get(Uri.parse(type == 1 ? getCreditUrl : getdebitUrl), headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + currentUser!.token!.toString(),
      });

      if (response.statusCode == 200) {
        print(getCreditUrl);
        print(response.body);
        var result = jsonDecode(response.body);
        print(result['data']);

        return result['data'];
      }
    } catch (e) {
      print(e.toString());
    }

    //return users;
  }

  addTransaction(int type, Map data) async {
    isPostinCredit = true;
    notifyListeners();

    try {
      // print(fetUsersUrl);
      //print(currentUser!.token!.toString());
      Response response = await http.post(
          Uri.parse(type == 1 ? creditUrl : debitUrl),
          body: data,
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + currentUser!.token!.toString(),
          });

      if (response.statusCode == 200) {
        print(getCreditUrl);
        print(response.body);
        var result = jsonDecode(response.body);
        //print(result['data']);

        //return result['data'];
      }
    } catch (e) {
      print(e.toString());
    }
     isPostinCredit = false;
    notifyListeners();
  }
}
