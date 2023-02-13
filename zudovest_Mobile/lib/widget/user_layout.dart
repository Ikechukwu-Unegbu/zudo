import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/container.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:zudovest/models/usermodel.dart';

class UserLayout extends StatefulWidget {
  Map<String, dynamic> user;
  UserLayout({super.key, required this.user});

  @override
  State<UserLayout> createState() => _UserLayoutState();
}

class _UserLayoutState extends State<UserLayout> {
  UserModel? userModel;
  @override
  void initState() {
    userModel = UserModel.fromJson2(widget.user);
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
        child: Card(
            child: ListTile(
      leading: CircleAvatar(child: Text(userModel!.name![0].toUpperCase())),
      title: Text(userModel!.name!),
      subtitle: Text(userModel!.email! + "\n" + userModel!.phone!),
    )));
  }
}
