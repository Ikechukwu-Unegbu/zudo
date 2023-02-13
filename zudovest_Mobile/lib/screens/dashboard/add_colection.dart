import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:zudovest/constants/colors.dart';
import 'package:zudovest/constants/dimensions.dart';
import 'package:zudovest/widget/dashboard_template.dart';

import '../../widget/button1.dart';
import '../../widget/input_field2.dart';
import '../../widget/textinputfield.dart';

class AddCollection extends StatefulWidget {
  const AddCollection({Key? key}) : super(key: key);

  @override
  State<AddCollection> createState() => _AddCollectionState();
}

class _AddCollectionState extends State<AddCollection> {
  @override
  Widget build(BuildContext context) {
    return DashboardTemplate(
        title: "Collection",
        body: Container(
          padding: EdgeInsets.only(top: 30),
          child: Form(
              child: Column(
            children: [
              TextInputField2(
                textInputType: TextInputType.number,
                labelText: "Customer number",
                controller: new TextEditingController(),
                validator: (text) {},
              ),
              SizedBox(
                height: 10,
              ),
              TextInputField2(
                readOnly: true,
                labelText: "Name",
                controller: new TextEditingController(),
                validator: (text) {},
              ),
              SizedBox(
                height: 10,
              ),
              TextInputField2(
                readOnly: true,
                labelText: "Balance",
                controller: new TextEditingController(),
                validator: (text) {},
              ),
              SizedBox(
                height: 10,
              ),
              TextInputField2(
                textInputType: TextInputType.number,
                labelText: "Input amount",
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
        ));
  }
}
