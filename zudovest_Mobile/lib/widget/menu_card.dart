import 'package:flutter/material.dart';
import 'package:zudovest/constants/colors.dart';

class MenuCard extends StatelessWidget {
  void Function()? onTap;
  String text;
  IconData icon;
  MenuCard(
      {Key? key, required this.onTap, required this.text, required this.icon})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: onTap,
      child: Card(
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: whiteColor,
        child: Container(
          padding: EdgeInsets.all(12),
          child: Column(mainAxisAlignment: MainAxisAlignment.center, children: [
            CircleAvatar(
                radius: 20,
                child: Icon(
                  this.icon,
                  size: 20,
                )),
            SizedBox(
              height: 5,
            ),
            Text(
              text,
              style: TextStyle(
                //fontWeight: FontWeight.bold,
                fontSize: 15,
              ),
              textAlign: TextAlign.center,
            )
          ]),
        ),
      ),
    );
  }
}
