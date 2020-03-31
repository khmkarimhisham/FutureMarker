import 'dart:async';
import 'package:flutter/material.dart';
import 'package:futuremarker/Authentication/Login.dart';

import '../Authentication/Signup.dart';


class SplashScreen extends StatefulWidget {
  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    Timer(Duration(seconds: 2), () {
      Navigator.of(context)
          .pushReplacement(MaterialPageRoute(builder: (context) => Login()));
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.lightBlue,
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: <Widget>[
            Image(
              image: AssetImage('images/logo.png'),
              height: 170.0,
            ),
            Text(
              "Make Your Code Easy",
              style: TextStyle(
                fontSize: 35.0,
                color: Colors.white,
                fontFamily: "Satisfy",
              ),
            )
          ],
        ),
      ),
    );
  }
}
