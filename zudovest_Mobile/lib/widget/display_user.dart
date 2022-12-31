import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/container.dart';
import 'package:flutter/src/widgets/framework.dart';

import '../models/usermodel.dart';

class DisplayCard extends StatelessWidget {
  UserModel userModel;
  DisplayCard({super.key, required this.userModel});

  @override
  Widget build(BuildContext context) {
    return Container(
      child: ListTile(
        leading: Text(
          userModel.id.toString(),
        ),
        title: Text(userModel.name!),
      ),
    );
  }
}
