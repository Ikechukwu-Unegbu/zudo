import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/container.dart';
import 'package:flutter/src/widgets/framework.dart';

import '../../constants/colors.dart';
import '../../constants/dimensions.dart';
import '../../widget/button1.dart';
import '../../widget/input_field2.dart';

class AddUserForm extends StatefulWidget {
  const AddUserForm({super.key});

  @override
  State<AddUserForm> createState() => _AddUserFormState();
}

class _AddUserFormState extends State<AddUserForm> {
  @override
  Widget build(BuildContext context) {
    return Container(
      padding: EdgeInsets.only(top: 30),
      child: Form(
          child: Column(
        children: [
          Container(
            margin: EdgeInsets.symmetric(horizontal: 30, vertical: 15),
            alignment: Alignment.topRight,
            child: InkWell(
                onTap: () {
                  Navigator.pop(context);
                },
                child: Icon(Icons.cancel)),
          ),
          TextInputField2(
            labelText: "username",
            controller: new TextEditingController(),
            validator: (text) {},
          ),
          SizedBox(
            height: 10,
          ),
          TextInputField2(
            readOnly: true,
            labelText: "Full name",
            controller: new TextEditingController(),
            validator: (text) {},
          ),
          SizedBox(
            height: 10,
          ),
          TextInputField2(
            readOnly: true,
            labelText: "email",
            controller: new TextEditingController(),
            validator: (text) {},
          ),
          SizedBox(
            height: 10,
          ),
          TextInputField2(
            textInputType: TextInputType.number,
            labelText: "Phone number",
            controller: new TextEditingController(),
            validator: (text) {},
          ),
          SizedBox(
            height: 20,
          ),
          TextInputField2(
            textInputType: TextInputType.number,
            labelText: "Password",
            controller: new TextEditingController(),
            validator: (text) {},
          ),
          SizedBox(
            height: 20,
          ),
          TextInputField2(
            textInputType: TextInputType.number,
            labelText: "Confirm password",
            controller: new TextEditingController(),
            validator: (text) {},
          ),
          SizedBox(
            height: 20,
          ),
          Button1(
            color: primaryColor,
            text: "Submit",
            textColor: Colors.white,
            width: getSize(context).width / 1.3,
            onPressed: () {},
          )
        ],
      )),
    );
  }
}
