import 'package:flutter/material.dart';

import 'package:futuremarker/Views/Auth/Signup.dart';

import 'Views/Instructor/Home.dart';
import 'Views/Instructor/Profile.dart';



void main() => runApp(MyApp());
class MyApp extends StatelessWidget {

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Future Marker',
      debugShowCheckedModeBanner: false,
      home:InstructorProfile() ,
    );
  }
}

