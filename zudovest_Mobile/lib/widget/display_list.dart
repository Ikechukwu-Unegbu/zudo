import 'package:flutter/material.dart';
import 'package:zudovest/widget/transaction_layout.dart';
import 'package:zudovest/widget/user_layout.dart';

Widget DisplayList(List list, String type) {
  return ListView.builder(
      itemCount: list.length,
      itemBuilder: (context, index) {
        if (type == "users")
          return UserLayout(user: list[index]);
        else if (type == "credit")
          return TransactionLayout(
            transaction: list[index],
          );
        return Container();
      });
}
