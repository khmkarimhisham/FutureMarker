import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Instructor/UserDataConrtoller.dart';
import 'package:futuremarkerapp/Views/Instructor/Instructor_Drawer.dart';
import 'package:futuremarkerapp/Views/Instructor/CreateCourse.dart';

import 'Course.dart';
import 'Folder.dart';

class MyCourses extends StatefulWidget {
  @override
  _MyCoursesState createState() => _MyCoursesState();
}

class _MyCoursesState extends State<MyCourses> {
  final GlobalKey<ScaffoldState> _courseskey = GlobalKey<ScaffoldState>();
  final primary = Color(0xfff263238);
  final secondary = Colors.white;


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
                                      MaterialPageRoute(builder: (context) => Course(mycourse[i]['id'],mycourse[i]['course_name'],mycourse[i]['course_material_dir'])));
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
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => CreateCourse()),
                          );
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
