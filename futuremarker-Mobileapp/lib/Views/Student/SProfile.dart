import 'dart:io';
import 'package:flutter/material.dart';
import 'package:circular_profile_avatar/circular_profile_avatar.dart';

//import 'package:cached_network_image/cached_network_image.dart';

class StudentProfile extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('Profile'),
        automaticallyImplyLeading: false,
      ),
      body: SafeArea(
          child: ListView(
        children: <Widget>[
          Stack(
            children: <Widget>[
              Container(
                width: double.infinity,
                height: 250,
                color: Color(0xfff263238),
              ),
              Positioned(
                top: 10,
                right: 20,
                child: Icon(
                  Icons.settings,
                  color: Colors.white,
                ),
              ),
              Column(
                children: <Widget>[
                  Padding(
                    padding: const EdgeInsets.only(top: 36.0),
                    child: Center(
                      child: CircularProfileAvatar(
                        null,
                        child: Image(image: AssetImage('Images/01.JPG')),
                        borderColor: Colors.white,
                        borderWidth: 5,
                        elevation: 2,
                        radius: 80,
                      ),
                    ),
                  ),
                  Container(
                    padding: EdgeInsets.all(10),
                    child: Column(
                      children: <Widget>[
                        Card(
                          child: Container(
                            alignment: Alignment.topLeft,
                            padding: EdgeInsets.all(15),
                            child: Column(
                              children: <Widget>[
                                Container(
                                  alignment: Alignment.topLeft,
                                  child: Text(
                                    "User Information",
                                    style: TextStyle(
                                      color: Colors.black87,
                                      fontWeight: FontWeight.w500,
                                      fontSize: 16,
                                    ),
                                    textAlign: TextAlign.left,
                                  ),
                                ),
                                Divider(
                                  color: Colors.black38,
                                ),
                                Container(
                                    child: Column(
                                      children: <Widget>[
                                        ListTile(
                                          contentPadding:
                                          EdgeInsets.symmetric(horizontal: 12, vertical: 4),
                                          leading: Icon(Icons.person),
                                          title: Text("Name"),
                                          subtitle: Text("Mohamed Essam"),
                                        ),
                                        ListTile(
                                          leading: Icon(Icons.email),
                                          title: Text("Email"),
                                          subtitle: Text("essam.lfc@gmail.com"),
                                        ),
                                        ListTile(
                                          leading: Icon(Icons.phone),
                                          title: Text("Phone"),
                                          subtitle: Text("01118261096"),
                                        ),
                                        ListTile(
                                          leading: Icon(Icons.person),
                                          title: Text("About Me"),
                                          subtitle: Text(
                                              "This is a about me link and you can khow about me in this section."),
                                        ),
                                      ],
                                    ))
                              ],
                            ),
                          ),
                        )
                      ],
                    ),
                  ),
                  Padding(
                    padding: EdgeInsets.only(top: 10.0),
                  ),
                  Container(
                    padding: EdgeInsets.all(10),
                    child: Column(
                      children: <Widget>[
                        Card(
                          child: Container(
                            alignment: Alignment.topLeft,
                            padding: EdgeInsets.all(15),
                            child: Column(
                              children: <Widget>[
                                Container(
                                  alignment: Alignment.topLeft,
                                  child: Text(
                                    "My Courses",
                                    style: TextStyle(
                                      color: Colors.black87,
                                      fontWeight: FontWeight.w500,
                                      fontSize: 16,
                                    ),
                                    textAlign: TextAlign.left,
                                  ),
                                ),
                                Divider(
                                  color: Colors.black38,
                                ),
                                Container(
                                    child: Column(
                                      children: <Widget>[
                                        ListTile(
                                          contentPadding:
                                          EdgeInsets.symmetric(horizontal: 12, vertical: 4),
                                          leading:Image(image: AssetImage('Images/01.JPG'),width: 100.0,height: 100.0,),
                                          title: Text("Flutter"),

                                        ),
                                        Divider(
                                          color: Colors.black38,
                                        ),
                                        ListTile(
                                          leading:Image(image: AssetImage('Images/01.JPG'),width: 100.0,height: 100.0,),
                                          title: Text("Web Programming"),

                                        ),
                                        Divider(
                                          color: Colors.black38,
                                        ),
                                        ListTile(
                                          leading:Image(image: AssetImage('Images/01.JPG'),width: 100.0,height: 100.0,),
                                          title: Text("System Programming"),

                                        ),
                                    
                                      ],
                                    ))
                              ],
                            ),
                          ),
                        )
                      ],
                    ),
                  ),

                ],
              ),
            ],
          )
        ],
      )),
    );
  }
}
