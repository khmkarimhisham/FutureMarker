import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';


import 'Authentication/Login.dart';
import 'Authentication/Signup.dart';
import 'UI/CourseContent.dart';
import 'UI/Courses_student.dart';
import 'UI/HomePage.dart';
import 'UI/SplashPage.dart';

import 'dart:io';

void main() => runApp(MyApp());

class MyApp extends StatelessWidget {
  String userID,userType;
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Future Marker',
      debugShowCheckedModeBanner: false,
      home: Login(),
    );
  }
}

