import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/container.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:zudovest/models/transaction_model.dart';

class TransactionLayout extends StatefulWidget {
  Map<String, dynamic> transaction;
  TransactionLayout({super.key, required this.transaction});

  @override
  State<TransactionLayout> createState() => _TransactionLayoutState();
}

class _TransactionLayoutState extends State<TransactionLayout> {
  TransactionModel? tm;
  @override
  void initState() {
    tm = new TransactionModel.fromJson(widget.transaction);
    // TODO: implement initState
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Card(
          child: ListTile(
        leading: CircleAvatar(child: Text(tm!.id.toString())),
        title: Text("Name"),
        subtitle: Text(tm!.amount),
      )),
    );
  }
}
