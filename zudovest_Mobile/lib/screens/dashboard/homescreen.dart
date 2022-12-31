import 'package:flashy_tab_bar2/flashy_tab_bar2.dart';
import 'package:flutter/material.dart';
import 'package:zudovest/models/usermodel.dart';
import 'package:zudovest/screens/dashboard/credits.dart';
import 'package:zudovest/screens/dashboard/debits.dart';
import 'package:zudovest/screens/dashboard/users.dart';
import 'package:zudovest/widget/dashboard_template.dart';

class HomeScreen extends StatefulWidget {
  const HomeScreen({super.key});

  @override
  State<HomeScreen> createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  List<Widget> screens = [
    AddUser(),
    Credit(),
    Debit(),
    Container(),
    Container()
  ];
  int initialIndex = 0;
  final _pageController = PageController(initialPage: 0);
  @override
  void dispose() {
    _pageController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: DashboardTemplate(title: "Users", body: screens[initialIndex]),
      bottomNavigationBar: FlashyTabBar(
        animationCurve: Curves.easeInCubic,
        selectedIndex: initialIndex,
        showElevation: false,
        onItemSelected: (index) => setState(() {
          initialIndex = index;
        }),
        items: [
          FlashyTabBarItem(
            icon: Icon(Icons.person),
            title: Text('Users'),
          ),
          FlashyTabBarItem(
            icon: Icon(Icons.payment),
            title: Text('Collections'),
          ),
          FlashyTabBarItem(
            icon: Icon(Icons.money),
            title: Text('Payouts'),
          ),
        ],
      ),
    );
  }
}
