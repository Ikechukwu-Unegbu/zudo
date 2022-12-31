import 'package:flutter/material.dart';
import 'package:zudovest/constants/dimensions.dart';
import 'package:zudovest/widget/button1.dart';
import 'package:zudovest/widget/input_field2.dart';

import '../../constants/colors.dart';

class CreditForm extends StatefulWidget {
  const CreditForm({super.key});

  @override
  State<CreditForm> createState() => _CreditFormState();
}

class _CreditFormState extends State<CreditForm> {
  @override
  Widget build(BuildContext context) {
    return Form(
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
            textInputType: TextInputType.number,
            labelText: "Amount",
            controller: new TextEditingController(),
            validator: (text) {},
          ),
          SizedBox(
            height: 10,
          ),
          TextInputField2(
            readOnly: true,
            labelText: "User Id",
            controller: new TextEditingController(),
            validator: (text) {},
          ),
          SizedBox(
            height: 10,
          ),
          TextInputField2(
            readOnly: true,
            labelText: "Description",
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
      ));
  }
}