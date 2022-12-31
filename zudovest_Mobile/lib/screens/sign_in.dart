import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:provider/provider.dart';
import 'package:zudovest/constants/colors.dart';
import 'package:zudovest/constants/dimensions.dart';
import 'package:zudovest/constants/strings.dart';
import 'package:zudovest/repos/account_manager.dart';
import 'package:zudovest/repos/general.dart';
import 'package:zudovest/screens/dashboard/dashboard.dart';
import 'package:zudovest/screens/dashboard/homescreen.dart';
import 'package:zudovest/screens/sign_up.dart';
import 'package:zudovest/widget/button1.dart';
import 'package:zudovest/widget/opacity_bg.dart';

import '../widget/app_title.dart';
import '../widget/textinputfield.dart';

class SignIn extends StatefulWidget {
  const SignIn({Key? key}) : super(key: key);

  @override
  State<SignIn> createState() => _SignInState();
}

class _SignInState extends State<SignIn> {
  var _formKey = GlobalKey<FormState>();
  AccountManager accountManager = AccountManager();
  var emailCRT = new TextEditingController();
  var passwordCRT = new TextEditingController();
  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    AccountManager accountManager = context.watch<AccountManager>();
    return WillPopScope(
      onWillPop: () async {
        return await false;
      },
      child: Scaffold(
        body: OpacityBg(
          context,
          SingleChildScrollView(
            child: Form(
              key: _formKey,
              child: Container(
                alignment: Alignment.center,
                child: Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      SizedBox(
                        height: size.height * 0.1,
                      ),
                      Container(child: AppTitle()),
                      SizedBox(
                        height: size.height * 0.001,
                      ),
                      Image.asset(
                        "assets/images/sign_in.png",
                        height: 280,
                      ),
                      SizedBox(
                        height: size.height * 0.001,
                      ),
                      TextInput(
                        labelText: "Email",
                        controller: emailCRT,
                        icon: Icons.person,
                        validator: (text) {
                          /// accountManager.inputValidator(text!, "username");
                          if (!accountManager.emailValidator(text!)) {
                            return accountManager.emailValidatorMsg;
                          }
                        },
                      ),
                      SizedBox(
                        height: 10,
                      ),
                      TextInput(
                        labelText: "Password",
                        controller: passwordCRT,
                        icon: Icons.lock,
                        validator: (text) {
                          if (!accountManager.passwordValidator(text!)) {
                            return accountManager.passwordValidatorMsg;
                          }
                        },
                        isPassword: true,
                      ),
                      SizedBox(
                        height: 20,
                      ),
                      Container(
                        margin: EdgeInsets.only(bottom: 10),
                        child: Visibility(
                          visible: accountManager.loginMsg.length > 2,
                          child: Text(accountManager.loginMsg),
                        ),
                      ),
                      Container(
                          margin: EdgeInsets.only(bottom: 10),
                          child: Visibility(
                              visible: accountManager.isLoding,
                              child: CupertinoActivityIndicator())),
                      Button1(
                        onPressed: () async {
                          if (_formKey.currentState!.validate()) {
                            accountManager.login(
                                emailCRT.text, passwordCRT.text);
                          }
                          //GeneralRepo().navigateToScreen(context, HomeScreen());
                        },
                        text: "Sign In",
                        color: primaryColor,
                        textColor: whiteColor,
                        width: getSize(context).width / 1.3,
                      ),
                      SizedBox(
                        height: 20,
                      ),
                      Container(
                        margin: EdgeInsets.symmetric(horizontal: 40),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            InkWell(
                                onTap: () {},
                                child: Text(
                                  "Forget password",
                                  style: TextStyle(color: primaryColor),
                                )),
                            InkWell(
                                onTap: () {
                                  GeneralRepo()
                                      .navigateToScreen(context, SignUp());
                                },
                                child: Text(
                                  "Register",
                                  style: TextStyle(color: primaryColor),
                                )),
                          ],
                        ),
                      )
                    ]),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
