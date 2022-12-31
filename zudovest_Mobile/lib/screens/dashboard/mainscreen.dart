import 'package:flutter/material.dart';
import 'package:flutter/src/foundation/key.dart';
import 'package:flutter/src/widgets/framework.dart';

import '../../widget/menu_card.dart';

class MainScreen extends StatelessWidget {
  const MainScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: EdgeInsets.all(30),
      child: GridView.count(
          crossAxisCount: 2,
          crossAxisSpacing: 8.0,
          mainAxisSpacing: 8.0,
          children: [
            MenuCard(
              icon: Icons.add,
              text: "Add",
              onTap: () {},
            ),
            MenuCard(
              icon: Icons.payments,
              text: "Payout",
              onTap: () {},
            ),
            MenuCard(
              icon: Icons.person,
              text: "Customer setup",
              onTap: () {},
            ),
            MenuCard(
              icon: Icons.search,
              text: "Search",
              onTap: () {},
            ),
          ]),
    );
  }
}
