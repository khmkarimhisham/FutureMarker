import 'package:flutter/material.dart';
import 'dart:async';
import 'package:splashscreen/splashscreen.dart';

import 'package:futuremarkerapp/Views/Auth/Login.dart';

import 'LoadingData.dart';
class WelcomeScreen extends StatefulWidget {
  @override
  _WelcomeScreenState createState() => _WelcomeScreenState();
}

class _WelcomeScreenState extends State<WelcomeScreen> {
  @override

  Widget build(BuildContext context) {
    return Center(
      child: new SplashScreen(
          seconds: 5,
          navigateAfterSeconds: new LoadData(),
          image: new Image(image: AssetImage('Images/FMLogo2.png')),
          backgroundColor: Colors.black,
          styleTextUnderTheLoader: new TextStyle(),
          photoSize: 100.0,

          loaderColor: Colors.red
      ),
    );
  }
}
