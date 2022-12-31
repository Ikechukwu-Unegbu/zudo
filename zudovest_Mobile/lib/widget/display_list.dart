import 'package:flutter/material.dart';

Widget DisplayList(List users, String type) {
  return ListView.builder(
      itemCount: users.length,
      itemBuilder: (context, index) {
        if (type == "users") return Text("user");
        return Container();
      });
}
