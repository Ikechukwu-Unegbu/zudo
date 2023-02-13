import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:zudovest/constants/colors.dart';
import 'package:zudovest/constants/dimensions.dart';
import 'package:zudovest/widget/opacity_bg.dart';

import '../../widget/menu_card.dart';
import '../screens/dashboard/mainscreen.dart';

class AgentDahboard extends StatefulWidget {
  const AgentDahboard({Key? key}) : super(key: key);

  @override
  State<AgentDahboard> createState() => _AgentDahboardState();
}

class _AgentDahboardState extends State<AgentDahboard> {
  //List<Widget> screens = [MainScreen()];
  int pageIndex = 0;
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
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      IconButton(
                          onPressed: () {},
                          icon: CircleAvatar(
                              child: Icon(
                            Icons.person,
                            size: 30,
                          ))),
                    ]),
                Text(
                  "Agent x",
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
              child: MainScreen())
        ],
      ),
    );
  }
}
