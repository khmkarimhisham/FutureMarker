import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter_custom_clippers/flutter_custom_clippers.dart';
import 'package:futuremarker/API/userDataAPI.dart';
import 'package:futuremarker/Authentication/Login.dart';
import 'package:futuremarker/UI/Courses_student.dart';
import 'package:http/http.dart' as http;



class HomePage extends StatefulWidget {

  String userID,userType;

  HomePage(this.userID,this.userType);

  @override
  HomePageState createState() => HomePageState();
}
final Color primary = Colors.white;
final Color active = Colors.grey.shade800;
final Color divider = Colors.grey.shade600;

class HomePageState extends State<HomePage> {

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    print(widget.userType);
    print(widget.userID);
  }
  // ignore: missing_return


  @override

  Widget build(BuildContext context) {
    return new Scaffold(
      appBar: new AppBar(
          title: new Text("Recent Activity"),
           backgroundColor: Colors.lightBlue,
           actions: <Widget>[
             IconButton(icon: Icon(Icons.add), onPressed: () => { }),
           ],
      ),
      drawer: _buildDrawer(context),
      body: new Center(


      ),
    );
  }

  _buildDrawer(BuildContext context) {
    //final String image = ;
    return ClipPath(
      clipper: OvalRightBorderClipper(),
      child: Drawer(
        child: Container(
          padding: const EdgeInsets.only(left: 16.0, right: 40),
          decoration: BoxDecoration(
              color: primary, boxShadow: [BoxShadow(color: Colors.black45)]),
          width: 300,
          child: SafeArea(
            child: SingleChildScrollView(
              child:  Column(
                children: <Widget>[
                  SizedBox(height: 20.0,),
                  FutureBuilder(
                    future: MyClass().getData(widget.userType, widget.userID),
                    builder: (BuildContext context,AsyncSnapshot ss){
                      if(ss.hasError){
                        print('Error');
                      }
                      if(ss.hasData){
                        print(ss.data);
                        List myData = ss.data;

                        if(widget.userType=='instructor'){
                          return _drawerHeader(name:"${myData[0]['Instructor_firstname']} ${myData[0]['Instructor_lastname']}",
                          email:myData[0]['Instructor_email'],
                          image: myData[0]['Instructor_image']);
                        }else{
                         return _drawerHeader(name:"${myData[0]['Student_firstname']} ${myData[0]['Student_lastname']}",
                             email:myData[0]['Student_Email'],
                             image: myData[0]['Student_image']);
                        }
                      }else{
                        return _drawerHeader();
                      }
                    },
                  ),
                  SizedBox(height: 30.0),
                  InkWell(
                      onTap: (){
                      },
                      child: _buildRow(Icons.home, "Home")),
                  _buildDivider(),
                  _buildRow(Icons.person_pin, "My profile"),
                  _buildDivider(),

                  InkWell(
                      onTap: (){
                        Navigator.push(context, MaterialPageRoute(builder: (context)=>Coursesstudent(widget.userID,widget.userType)));
                      },
                      child: _buildRow(Icons.folder_shared, "Courses")),
                  _buildDivider(),
                  _buildRow(Icons.grade, "Grades"),
                  _buildDivider(),
                  _buildRow(Icons.message, "Messages", showBadge: true),
                  _buildDivider(),
                  _buildRow(Icons.notifications, "Notifications",
                      showBadge: true),
                  _buildDivider(),
                  _buildRow(Icons.settings, "Settings"),
                  _buildDivider(),
                  SizedBox(height: 20.0,),
                  InkWell(
                      onTap: (){
                        Navigator.push(context,
                            MaterialPageRoute(builder: (context) => Login()));
                      },
                      child: _buildRow(Icons.power_settings_new, "Log Out")),

                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  _drawerHeader({String name,String email,String image}){
    return Column(
      children: <Widget>[
        Container(
          height: 90,
          alignment: Alignment.center,
          decoration: BoxDecoration(
              shape: BoxShape.circle,
              gradient: LinearGradient(
                  colors: [Colors.orange, Colors.deepOrange])),
          child: CircleAvatar(
            radius: 40,
            // backgroundImage:NetworkImage('images/01.JPG'),

            backgroundImage: image != null ?NetworkImage('http://192.168.1.2/WebApp/$image') : ExactAssetImage('images/user.png'),
          ),
        ),
        SizedBox(height: 5.0),
        Text(
          name == null ? '00000':"$name",
          style: TextStyle(
              color: Colors.black,
              fontSize: 18.0,
              fontWeight: FontWeight.w600),
        ),
        Text(
          email == null ? '00000':"$email",
          style: TextStyle(color: active, fontSize: 16.0),
        ),
      ],
    );
  }

}


Divider _buildDivider() {
  return Divider(
    height: 30.0,
    color: divider,
  );
}

Widget _buildRow(IconData icon, String title, {bool showBadge = false}) {
  final TextStyle tStyle = TextStyle(color: active, fontSize: 16.0);
  return Container(
    padding: const EdgeInsets.symmetric(vertical: 5.0),
    child: Row(children: [
      Icon(
        icon,
        color: active,
      ),
      SizedBox(width: 10.0),
      Text(
        title,
        style: tStyle,
      ),
      Spacer(),
        showBadge ? Material(
          color: Colors.deepOrange,
          elevation: 5.0,
          shadowColor: Colors.red,
          borderRadius: BorderRadius.circular(5.0),
          child: Container(
            width: 25,
            height: 25,
            alignment: Alignment.center,
            decoration: BoxDecoration(
              color: Colors.deepOrange,
              borderRadius: BorderRadius.circular(5.0),
            ),
            child: Text(
              "10+",
              style: TextStyle(
                  color: Colors.white,
                  fontSize: 12.0,
                  fontWeight: FontWeight.bold),
            ),
          ),
        ):Container(),
    ]),
  );
}
