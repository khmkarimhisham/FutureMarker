import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Student/UserDataController.dart';
import 'package:futuremarkerapp/Views/Student/Student_Drawer.dart';
import 'package:flutter/src/gestures/tap.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:flutter/gestures.dart';


class settings extends StatefulWidget {
  @override
  _settingsState createState() => _settingsState();
}

class _settingsState extends State<settings> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xfff263238),
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('Settings'),
        automaticallyImplyLeading: true,
      ),
      drawer: MyDrawer(),
      body: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Center(
            child:   RaisedButton(
              onPressed: () {
                launch('${UserData().imageurl}/student/profile');
              },
              textColor: Colors.white,
              padding: const EdgeInsets.all(0.0),
              child: Container(
                decoration: const BoxDecoration(
                  color: Color(0xfff263238),
                ),
                padding: const EdgeInsets.all(10.0),
                child:
                const Text('Update Profile ', style: TextStyle(fontSize: 20)),
              ),
            ),
          ),
        ],
      ),


    );
  }
}
