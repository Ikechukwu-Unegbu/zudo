import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:zudovest/repos/general.dart';
import 'package:zudovest/screens/dashboard/add_colection.dart';
import 'package:zudovest/screens/dashboard/credits.dart';
import 'package:zudovest/screens/dashboard/users.dart';
import 'package:zudovest/screens/dashboard/mainscreen.dart';
import 'package:zudovest/screens/dashboard/debits.dart';
import 'package:zudovest/widget/dashboard_template.dart';

import '../../widget/menu_card.dart';

class Dahboard extends StatefulWidget {
  const Dahboard({Key? key}) : super(key: key);

  @override
  State<Dahboard> createState() => _DahboardState();
}

class _DahboardState extends State<Dahboard> {
  @override
  Widget build(BuildContext context) {
    return DashboardTemplate(
        title: "Dashboard",
        body: Container(
          child: GridView.count(
              crossAxisCount: 2,
              crossAxisSpacing: 8.0,
              mainAxisSpacing: 8.0,
              children: [
                MenuCard(
                  icon: Icons.add,
                  text: "Colections",
                  onTap: () {
                    GeneralRepo().navigateToScreen(context, Credit());
                  },
                ),
                MenuCard(
                  icon: Icons.payments,
                  text: "Payout",
                  onTap: () {
                    GeneralRepo().navigateToScreen(context, Debit());
                  },
                ),
                MenuCard(
                  icon: Icons.person,
                  text: "Customer setup",
                  onTap: () {
                    GeneralRepo().navigateToScreen(context, AddUser());
                  },
                ),
                MenuCard(
                  icon: Icons.search,
                  text: "Search",
                  onTap: () {},
                ),
              ]),
        ));
  }
}
