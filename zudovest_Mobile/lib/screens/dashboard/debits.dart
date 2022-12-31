import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:modal_bottom_sheet/modal_bottom_sheet.dart';
import 'package:zudovest/constants/colors.dart';
import 'package:zudovest/constants/dimensions.dart';
import 'package:zudovest/screens/forms/credit_form.dart';
import 'package:zudovest/widget/dashboard_template.dart';

import '../../widget/button1.dart';
import '../../widget/display_list.dart';
import '../../widget/input_field2.dart';
import '../../widget/textinputfield.dart';

class Debit extends StatefulWidget {
  const Debit({Key? key}) : super(key: key);

  @override
  State<Debit> createState() => _DebitState();
}

class _DebitState extends State<Debit> {
  getUsers() async {
    List<Map> users = [{}, {}, {}];
    return users;
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: EdgeInsets.only(top: 30),
      child: Stack(
        children: [
          Container(
            alignment: Alignment.topLeft,
            width: getSize(context).width,
            child: Column(children: [
              Button1(
                onPressed: () {
                  showMaterialModalBottomSheet(
                    context: context,
                    builder: (context) => CreditForm(),
                  );
                },
                text: "Payout User",
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
                return DisplayList(snapshot.data as List, "users");
              },
            ),
          )
        ],
      ),
    );
  }
}
