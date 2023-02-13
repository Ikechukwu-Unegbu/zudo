import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:zudovest/repos/account_manager.dart';
import 'package:zudovest/repos/navigator_service.dart';
import 'package:zudovest/repos/users_repo.dart';
import 'package:zudovest/screens/splashscreen.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    final GlobalKey<NavigatorState> navigatorKey = GlobalKey<NavigatorState>();

    return MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => AccountManager()),
        ChangeNotifierProvider(create: (_) => UsersRepo()),
      ],
      child: MaterialApp(
        debugShowCheckedModeBanner: false,
        title: 'Zudo Vest',
        navigatorKey: NavigationService().navigationKey,
        theme: ThemeData(
          primarySwatch: Colors.blue,
          fontFamily: "Raleway",
        ),
        home: SplashScreen(),
      ),
    );
  }
}
