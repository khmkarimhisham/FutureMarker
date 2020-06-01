import 'package:flutter/material.dart';
import 'package:flutter_custom_clippers/flutter_custom_clippers.dart';

// ignore: camel_case_types
class InstructorHome extends StatefulWidget {
  @override
  _InstructorHomeState createState() => _InstructorHomeState();
}
final GlobalKey<ScaffoldState> _key = GlobalKey<ScaffoldState>();
final Color primary = Color(0xfff263238);
final Color active = Colors.white;
final Color divider = Colors.grey.shade600;
class _InstructorHomeState extends State<InstructorHome> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _key,
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('Home'),
        automaticallyImplyLeading: false,
        leading: IconButton(
          icon: Icon(Icons.menu),
          onPressed: () {
            _key.currentState.openDrawer();
          },
        ),

      ),
      drawer: _buildDrawer(),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: <Widget>[
            Container(
              width: double.infinity,
              height: 400,
              decoration: BoxDecoration(
                  color: Colors.white12,
                  borderRadius: BorderRadius.circular(10.0)),
              child: Column(
                children: <Widget>[
                  Text('anas hassan go to room 5')
                ],
              ),
              
            ),
            _buildDivider(),
            SizedBox(height: 10.0),
            Container(
              width: double.infinity,
              height: 400,
              decoration: BoxDecoration(
                  color: Colors.lightGreen,
                  borderRadius: BorderRadius.circular(10.0)),
            ),
            SizedBox(height: 10.0),
            Container(
              width: double.infinity,
              height: 400,
              decoration: BoxDecoration(
                  color: Colors.pink,
                  borderRadius: BorderRadius.circular(10.0)),
            ),
          ],
        ),
      ),
    );
  }
  _buildDrawer() {

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
                  SizedBox(height: 20.0,),

                  Container(
                    height: 90,
                    alignment: Alignment.center,
                    decoration: BoxDecoration(
                        shape: BoxShape.circle,
                        gradient: LinearGradient(
                            colors: [Colors.orange, Colors.deepOrange])),
                    child: CircleAvatar(
                      radius: 40,
                   //   backgroundImage: CachedNetworkImageProvider(image),
                    ),
                  ),
                  SizedBox(height: 5.0),
                  Text(
                    "Anas Hassan",
                    style: TextStyle(
                        color: Colors.white,
                        fontSize: 18.0,
                        fontWeight: FontWeight.w600),
                  ),
                  Text(
                    "anashassan@outlook.com",
                    style: TextStyle(color: active, fontSize: 16.0),
                  ),
                  SizedBox(height: 30.0),
                  _buildRow(Icons.home, "Home"),
                  _buildDivider(),
                  _buildRow(Icons.person_pin, "My profile"),
                  _buildDivider(),
                  _buildRow(Icons.folder_shared, "Courses"),
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
                  SizedBox(height: 50.0,),
                  _buildRow(Icons.power_settings_new, "Log Out"),

                ],
              ),
            ),
          ),
        ),
      ),
    );
  }

  Divider _buildDivider() {
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
}

