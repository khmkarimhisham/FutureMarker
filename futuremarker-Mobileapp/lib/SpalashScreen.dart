import 'package:flutter/material.dart';
import 'dart:async';

import 'package:futuremarkerapp/Views/Auth/Login.dart';
class SplashScreen extends StatefulWidget {
  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    Timer(Duration(seconds: 5), () {
      Navigator.of(context)
          .pushReplacement(MaterialPageRoute(builder: (context) => LoginPage()));
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.black,
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: <Widget>[
            Image(
              image: AssetImage('Images/FMLogo.png'),
           //   height: 170.0,
            ),
//            Text(
//              "Make Your Code Easy",
//              style: TextStyle(
//                fontSize: 35.0,
//                color: Colors.white,
//                fontFamily: "Satisfy",
//              ),
//            )
          ],
        ),
      ),
    );
  }
}
