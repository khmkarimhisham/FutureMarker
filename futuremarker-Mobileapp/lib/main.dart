import 'package:flutter/material.dart';

import 'package:futuremarkerapp/Views/Auth/Signup.dart';
import 'package:futuremarkerapp/Views/Instructor/CreateCourse.dart';

import 'Views/Instructor/Course.dart';
import 'Views/Instructor/Courses.dart';
import 'Views/Instructor/EditProfile.dart';
import 'Views/Instructor/Home.dart';
import 'Views/Instructor/Profile.dart';



void main() => runApp(MyApp());
class MyApp extends StatelessWidget {

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Future Marker',
      debugShowCheckedModeBanner: false,
      home:InstructorHome() ,
    );
  }
}

