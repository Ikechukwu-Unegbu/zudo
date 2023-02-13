import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:zudovest/constants/colors.dart';
import 'package:zudovest/constants/currentuser.dart';
import 'package:zudovest/constants/dimensions.dart';
import 'package:zudovest/widget/opacity_bg.dart';

import '../../widget/menu_card.dart';

class DashboardTemplate extends StatefulWidget {
  Widget body;
  String title;
  DashboardTemplate({Key? key, required this.body, required this.title})
      : super(key: key);

  @override
  State<DashboardTemplate> createState() => _DashboardTemplateState();
}

class _DashboardTemplateState extends State<DashboardTemplate> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      //backgroundColor: primaryColor,
      body: Stack(
        children: [
          Container(
            color: primaryColor,
            padding: EdgeInsets.only(top: 50, right: 20),
            height: getSize(context).height / 3.5,
            child: Column(
              children: [
                Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Container(
                        margin: EdgeInsets.only(left: 20),
                        child: Text(
                          widget.title,
                          style: TextStyle(
                            color: whiteColor,
                          ),
                        ),
                      ),
                      IconButton(
                          onPressed: () {},
                          icon: CircleAvatar(
                              child: Icon(
                            Icons.person,
                            size: 30,
                          ))),
                    ]),
                Text(
                  currentUser!.fullname!,
                  style: TextStyle(
                      color: Colors.white70,
                      fontSize: 20,
                      fontWeight: FontWeight.w100),
                )
              ],
            ),
          ),
          Container(
              margin: EdgeInsets.only(
                top: getSize(context).height / 4.5,
              ),
              decoration: BoxDecoration(
                  color: whiteHash,
                  borderRadius: BorderRadius.only(
                      topLeft: Radius.circular(50),
                      topRight: Radius.circular(50))),
              child: Container(
                  width: getSize(context).width,
                  padding: EdgeInsets.all(30),
                  child: widget.body))
        ],
      ),
    );
  }
}
