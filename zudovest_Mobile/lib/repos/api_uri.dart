import 'package:zudovest/constants/currentuser.dart';

Uri channelLoginUri = Uri.parse("https://zudovest.com/api/channel/login");
Uri allUsersUri = Uri.parse("https://zudovest.com/users/");
String baseDomain = "https://zudovest.com/";
String fetUsersUrl = baseDomain + "api/users/1";
//String creditUrl = baseDomain + "api/credit/post/";
String getCreditUrl = baseDomain + "api/transactions/channel/credits/2";
String getdebitUrl = baseDomain + "api/transactions/channel/debits/2";
String creditUrl =
    baseDomain + "api/credit/post/" + currentUser!.id!.toString();
String debitUrl = baseDomain + "api/debit/post/" + currentUser!.id!.toString();
