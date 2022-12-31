import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:modal_bottom_sheet/modal_bottom_sheet.dart';
import 'package:zudovest/screens/forms/add_user_form.dart';

import '../../constants/colors.dart';
import '../../constants/dimensions.dart';
import '../../widget/button1.dart';
import '../../widget/display_list.dart';
import '../../widget/input_field2.dart';

class AddUser extends StatefulWidget {
  const AddUser({Key? key}) : super(key: key);

  @override
  State<AddUser> createState() => _AddUserState();
}

class _AddUserState extends State<AddUser> {
  getUsers() async {
    List<Map> users = [{}, {}, {}];
    return users;
  }

  @override
  Widget build(BuildContext context) {
    return Stack(
      children: [
        Container(
          alignment: Alignment.topLeft,
          width: getSize(context).width,
          child: Column(children: [
            Button1(
              onPressed: () {
                showMaterialModalBottomSheet(
                  context: context,
                  builder: (context) => AddUserForm(),
                );
              },
              text: "Add User",
              color: primaryColor,
              textColor: whiteColor,
              width: 100,
            ),
          ]),
        ),
        Container(
          margin: EdgeInsets.only(top: 70),
          width: getSize(context).width,
          child: FutureBuilder(
            future: getUsers(),
            builder: (context, snapshot) {
              if (snapshot.connectionState == ConnectionState.waiting) {
                return CupertinoActivityIndicator();
              }
              if (snapshot.hasError) {
                return Center(child: Text("Error occoured"));
              }
              if (!snapshot.hasData) {
                return Center(child: Text("No data"));
              }
              return DisplayList(snapshot.data as List,"users");
            },
          ),
        )
      ],
    );
  }

 
}
