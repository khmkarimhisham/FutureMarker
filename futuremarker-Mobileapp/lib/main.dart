import 'package:flutter/material.dart';

import 'package:futuremarkerapp/Views/Auth/Signup.dart';
import 'package:futuremarkerapp/Views/Instructor/CreateCourse.dart';
import 'package:futuremarkerapp/x.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'Views/Auth/Login.dart';
import 'Views/Instructor/Chat.dart';
import 'Views/Instructor/ChatContent.dart';
import 'Views/Instructor/Course.dart';
import 'Views/Instructor/Courses.dart';
import 'Views/Instructor/EditProfile.dart';
import 'Views/Instructor/Home.dart';
import 'Views/Instructor/Profile.dart';
import 'package:futuremarkerapp/Controllers/Auth/AuthController.dart';




void main()async {

  runApp(MyApp());


}
class MyApp extends StatelessWidget {

  @override
  Widget build(BuildContext context) {


    Future checkEmail() async{
      final prefs = await SharedPreferences.getInstance();
      final Ekey = 'email';
      final Evalue = prefs.get(Ekey) ?? 0;
      return Evalue;
    }

    return MaterialApp(
      title: 'Future Marker',
      debugShowCheckedModeBanner: false,
      home:FutureBuilder(
        future: checkEmail(),
       builder: (context,ss){
         if(ss.data == 0){
           return LoginPage();
         }else if(ss.data != 0){
           return InstructorHome();
         }else{
           return Container();
         }
       },
      ) ,
    );
  }
}

