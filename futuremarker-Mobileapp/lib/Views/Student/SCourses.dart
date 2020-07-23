import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Student/CourseController.dart';
import 'package:futuremarkerapp/Controllers/Student/UserDataController.dart';
import 'package:futuremarkerapp/Views/Student/SCourse.dart';
import 'package:futuremarkerapp/Views/Student/Student_Drawer.dart';



class StudentCourses extends StatefulWidget {
  @override
  _StudentCoursesState createState() => _StudentCoursesState();
}

class _StudentCoursesState extends State<StudentCourses> {
  final GlobalKey<ScaffoldState> _courseskey = GlobalKey<ScaffoldState>();
  final primary = Color(0xfff263238);
  final secondary = Colors.white;
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  TextEditingController _accessController = TextEditingController();
  Future<void> _showMyDialog() async {
    return showDialog<void>(
      context: context,
      barrierDismissible: false, // user must tap button!
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Join Course'),
          content: SingleChildScrollView(
            child: ListBody(
              children: <Widget>[
                Form(
                  key: _formKey,
                  child: TextFormField(

                    style: TextStyle(
                        color: Colors.black,
                        fontSize: 18.0,
                        fontWeight: FontWeight.bold),
                    decoration: InputDecoration(
                      hintText: ' Enter Course Access Code',
                    ),
                    controller: _accessController,
                    validator: (value) => value.length >= 14
                        ? null
                        : 'Access code should be 14 characters',
                    onSaved: (value) => _accessController.text = value,
                  ),
                )
              ],
            ),
          ),
          actions: <Widget>[
            FlatButton(
              child: Text('Cancel'),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
            FlatButton(
              child: Text('Join'),
              onPressed: () {
                var key = _formKey.currentState;
                if (key.validate()) {
                  key.save();

                  setState(() {
                    Courses().joinCourse(_accessController.text);

                    Navigator.pop(context);
                  });
                }


              }),
          ],
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _courseskey,
      backgroundColor: Color(0xfff0f0f0),
      drawer: MyDrawer(),
      body: SingleChildScrollView(
        child: Container(
          height: MediaQuery.of(context).size.height,
          width: MediaQuery.of(context).size.width,
          child: Stack(
            children: <Widget>[
              FutureBuilder(
                  future: UserData().getData(),
                  builder: (BuildContext context, AsyncSnapshot ss) {
                    if (ss.hasError) {
                      print('error');
                    }
                    if (ss.hasData) {

                      List mycourse = ss.data['courses'];

                      int i = 0;
                      while (i <= mycourse.length) {
                        i++;
                      }
                      return Container(
                        padding: EdgeInsets.only(top: 100),
                        height: MediaQuery.of(context).size.height,
                        width: double.infinity,
                        child: ListView.builder(
                            scrollDirection: Axis.vertical,
                            shrinkWrap: true,
                            itemCount: mycourse.length,
                            itemBuilder: (context, i) {
                              return InkWell(
                                onTap: (){
                                  Navigator.push(context,
                                      MaterialPageRoute(builder: (context) => StudentCourse(mycourse[i]['id'],mycourse[i]['course_name'],mycourse[i]['course_material_dir'])));
                                },
                                child: Container(
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(25),
                                    color: Colors.white,
                                  ),
                                  width: double.infinity,
                                  height: 110,
                                  margin: EdgeInsets.symmetric(
                                      vertical: 10, horizontal: 20),
                                  padding: EdgeInsets.symmetric(
                                      vertical: 10, horizontal: 20),
                                  child: Row(
                                    crossAxisAlignment: CrossAxisAlignment.start,
                                    children: <Widget>[
                                      Container(
                                        width: 80,
                                        height: 80,
                                        margin: EdgeInsets.only(right: 15),
                                        decoration: BoxDecoration(
                                          borderRadius: BorderRadius.circular(50),
                                          border: Border.all(
                                              width: 3, color: secondary),
                                          image: DecorationImage(
                                              image:  NetworkImage(
                                                  '${UserData().imageurl}/${mycourse[i]['course_image']}'),
                                              fit: BoxFit.fill),
                                        ),
                                      ),
                                      Flexible(
                                        fit: FlexFit.loose,
                                        child: Center(
                                          child: Text(
                                            "${mycourse[i]['course_name']}",
                                            softWrap: false,
                                            overflow: TextOverflow.fade,
                                            style: TextStyle(
                                                color: primary,
                                                fontWeight: FontWeight.bold,
                                                fontSize: 18),
                                          ),
                                        ),
                                      )
                                    ],
                                  ),
                                ),
                              );
                            }),
                      );
                    } else {
                      return Center(
                        child: Text('You Don\'t join in any course'),
                      );
                    }
                  }),
              Container(
                height: 110,
                width: double.infinity,
                decoration: BoxDecoration(
                    color: primary,
                    borderRadius: BorderRadius.only(
                        bottomLeft: Radius.circular(30),
                        bottomRight: Radius.circular(30))),
                child: Padding(
                  padding: const EdgeInsets.only(top: 20.0),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: <Widget>[
                      IconButton(
                        onPressed: () {
                          _courseskey.currentState.openDrawer();
                        },
                        icon: Icon(
                          Icons.menu,
                          color: Colors.white,
                          size: 35.0,
                        ),
                      ),
                      Text(
                        "Courses",
                        style: TextStyle(color: Colors.white, fontSize: 24),
                      ),
                      IconButton(
                        onPressed: () {
                          _showMyDialog();
                        },
                        icon: Icon(
                          Icons.add,
                          color: Colors.white,
                          size: 35.0,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
