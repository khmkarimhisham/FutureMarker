import 'package:flutter/material.dart';
import 'package:flutter_custom_clippers/flutter_custom_clippers.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:futuremarkerapp/Controllers/Instructor/UserDataConrtoller.dart';
import 'package:futuremarkerapp/Views/Auth/Login.dart';
import 'package:futuremarkerapp/Views/Instructor/Courses.dart';
import 'package:futuremarkerapp/Views/Instructor/Home.dart';
import 'package:futuremarkerapp/Views/Instructor/Profile.dart';
import 'package:futuremarkerapp/Views/Instructor/Chat.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class MyDrawer extends StatelessWidget {
  @override
  final Color active = Colors.white;
  final Color divider = Colors.grey.shade600;
  final Color primary = Color(0xfff263238);

  _save(String token) async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = token;
    prefs.remove(key);
    prefs.remove('email');

  }



  Widget build(BuildContext context) {
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
              child: Column(
                children: <Widget>[
                  SizedBox(
                    height: 20.0,
                  ),
                  FutureBuilder(
                      future: UserData().getData(),
                      builder: (BuildContext context, AsyncSnapshot ss) {
                        if (ss.hasError) {
                          print('Error');
                        }
                        if (ss.hasData) {

                          Map myData = ss.data['user'];

                          return _BuildHeader(name: "${myData['name']}",email: "${myData['email']}",image:"${myData['image']}" );
//                        return Container();
                        }
                        else{
                          return _BuildHeader();
                        }
                      }),
                  SizedBox(height: 30.0),
                  InkWell(
                      onTap: () {
                        Navigator.pushAndRemoveUntil(
                            context,
                            MaterialPageRoute(
                                builder: (context) => InstructorHome()),
                            (Route<dynamic> route) => false);
                      },
                      child: _buildRow(Icons.home, "Home")),
                  buildDivider(),
                  InkWell(
                      onTap: () {
                        Navigator.pushAndRemoveUntil(
                            context,
                            MaterialPageRoute(
                                builder: (context) => InstructorProfile()),
                            (Route<dynamic> route) => false);
                      },
                      child: _buildRow(Icons.person_pin, "My profile")),
                  buildDivider(),
                  InkWell(
                      onTap: () {
                        Navigator.pushAndRemoveUntil(
                            context,
                            MaterialPageRoute(
                                builder: (context) => MyCourses()),
                            (Route<dynamic> route) => false);
                      },
                      child: _buildRow(Icons.folder_shared, "Courses")),
                  buildDivider(),
                  _buildRow(Icons.grade, "Grades"),
                  buildDivider(),
                  InkWell(
                      onTap: () {
                        Navigator.pushAndRemoveUntil(
                            context,
                            MaterialPageRoute(
                                builder: (context) => InstructorListChat()),
                            (Route<dynamic> route) => false);
                      },
                      child: _buildRow(Icons.message, "Messages",
                          showBadge: true)),
                  buildDivider(),
                  _buildRow(Icons.notifications, "Notifications",
                      showBadge: true),
                  buildDivider(),
                  _buildRow(Icons.settings, "Settings"),
                  buildDivider(),
                  SizedBox(
                    height: 50.0,
                  ),
                  InkWell(
                      onTap: () {
                        _save('0');
                        Navigator.pushAndRemoveUntil(
                            context,
                            MaterialPageRoute(
                                builder: (context) => LoginPage()),
                            (Route<dynamic> route) => false);
                      },
                      child: _buildRow(Icons.power_settings_new, "Log out")),
                  FlatButton(
                    child: Text('Print'),
                    onPressed: ()async{
                      final prefs = await SharedPreferences.getInstance();
                      final key = 'token';
                      print(prefs.get(key));
                    },
                  )
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  _BuildHeader({String name, String email, String image}) {
    return Column(
      children: <Widget>[
        Container(
          height: 90,
          alignment: Alignment.center,
          child: CircleAvatar(
            radius: 40,
             backgroundImage: image != null ?NetworkImage('${UserData().imageurl}/$image') : ExactAssetImage('Images/avatar.jpg'),
          ),
        ),
        SizedBox(height: 5.0),
        Text(
          name == null ? 'User' : "$name",
          style: TextStyle(
              color: Colors.white, fontSize: 18.0, fontWeight: FontWeight.w600),
        ),
        Text(
          email == null ? 'future@gmail.com' : "$email",
          style: TextStyle(color: active, fontSize: 16.0),
        ),
      ],
    );
  }

  Divider buildDivider() {
    return Divider(
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
        showBadge
            ? Material(
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
              )
            : Container(),
      ]),
    );
  }
}
