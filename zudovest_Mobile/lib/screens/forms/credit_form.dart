import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:zudovest/constants/dimensions.dart';
import 'package:zudovest/repos/users_repo.dart';
import 'package:zudovest/widget/button1.dart';
import 'package:zudovest/widget/input_field2.dart';

import '../../constants/colors.dart';

class CreditForm extends StatefulWidget {
  const CreditForm({super.key});

  @override
  State<CreditForm> createState() => _CreditFormState();
}

class _CreditFormState extends State<CreditForm> {
  GlobalKey<FormState> formKey = GlobalKey<FormState>();
  String? amount, useId, description;
  TextEditingController amountCrt = TextEditingController();
  TextEditingController useIdCrt = TextEditingController();
  TextEditingController descriptionCrt = TextEditingController();

  @override
  Widget build(BuildContext context) {
    UsersRepo usersRepo = context.watch<UsersRepo>();
    return Form(
        key: formKey,
        child: Column(
          children: [
            Container(
              margin: EdgeInsets.only(left: 30, right: 30, top: 50),
              alignment: Alignment.topRight,
              child: InkWell(
                  onTap: () {
                    Navigator.pop(context);
                  },
                  child: Icon(Icons.cancel)),
            ),
            Container(
              height: getSize(context).height / 6,
            ),
            TextInputField2(
              textInputType: TextInputType.number,
              labelText: "Amount",
              controller: amountCrt,
              validator: (text) {
                if (text!.isEmpty) {
                  return "Empty field";
                }
              },
            ),
            SizedBox(
              height: 10,
            ),
            TextInputField2(
              textInputType: TextInputType.number,
              labelText: "User Id",
              controller: useIdCrt,
              validator: (text) {
                if (text!.isEmpty) {
                  return "Empty field";
                }
              },
            ),
            SizedBox(
              height: 10,
            ),
            TextInputField2(
              labelText: "Description",
              controller: descriptionCrt,
              validator: (text) {
                if (text!.isEmpty) {
                  return "Empty field";
                }
              },
            ),
            Visibility(
                visible: usersRepo.isLoading,
                child: CupertinoActivityIndicator()),
            SizedBox(
              height: 20,
            ),
            Button1(
              color: primaryColor,
              text: "Submit",
              textColor: Colors.white,
              width: getSize(context).width / 1.3,
              onPressed: () {
                if (formKey.currentState!.validate()) {
                  formKey.currentState!.save();

                  usersRepo.creditUser(
                      amount: amountCrt.text,
                      userId: useIdCrt.text,
                      desc: descriptionCrt.text);
                }
              },
            )
          ],
        ));
  }
}
