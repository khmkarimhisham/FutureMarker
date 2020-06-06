import 'package:flutter/material.dart';

class CreateCourse extends StatefulWidget {
  @override
  _CreateCourseState createState() => _CreateCourseState();
}

class _CreateCourseState extends State<CreateCourse> {
  TextEditingController _nameController = TextEditingController();
  TextEditingController _descriptionController = TextEditingController();
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Center(child: Text('Create Course')),
        automaticallyImplyLeading: false,



      ),
      body:Container(
        child: Stack(
          children: <Widget>[
            Container(
              width: double.infinity,
              height: double.infinity,
              color: Colors.grey,
            ),
            Container(
              padding: EdgeInsets.only(top:80,left:10,right: 10,bottom: 50),
              color: Colors.white,
            ),

          ],
        ),
      ),
    );
  }
}
