import 'package:flutter/material.dart';


class GeneralRepo {
  final GlobalKey<NavigatorState> navigatorKey = GlobalKey<NavigatorState>();

  navigateToScreen(BuildContext context, Widget child) {
    var route = MaterialPageRoute(builder: (BuildContext) => child);
    Navigator.push(context, route);
  }
  navigateToScreen2(Widget child){
    var route = MaterialPageRoute(builder: (BuildContext) => child);
    navigatorKey.currentState!.push(route);

  }
}
