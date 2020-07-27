import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Views/Student/SHome.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'Views/Auth/Login.dart';
import 'Views/Instructor/Home.dart';

class LoadData extends StatefulWidget {
  @override
  _LoadDataState createState() => _LoadDataState();
}

class _LoadDataState extends State<LoadData> {
  @override
  Future checkEmail() async{
    final prefs = await SharedPreferences.getInstance();
    final Ekey = 'email';
    final Evalue = prefs.get(Ekey) ?? 0;
    final Pkey = 'password';
    final Pvalue = prefs.get(Pkey) ?? 0;
    final Rkey = 'role';
    final Rvalue = prefs.get(Rkey) ?? 0;

    Map map={Ekey:Evalue,Pkey:Pvalue,Rkey:Rvalue};
    print('--------------------$map------------------');
    return map;
  }
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.black,
      body: FutureBuilder(
        future: checkEmail(),
        builder: (context,ss){
          if(ss.hasError){
            print('error');
          }
          if(ss.hasData){
            Map mymap=ss.data;
            if(ss.data==0 ){
              return LoginPage();
            }
            else {
              if(mymap['role']==1){
                return InstructorHome();

              }else if(mymap['role']==2){
                return StudentHome();

              } else{
                return LoginPage();
              }
            }
          }
          else{
           return  CircularProgressIndicator();
          }
        },
      ) ,
    );
  }
}
