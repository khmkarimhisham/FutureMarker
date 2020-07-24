import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Student/Grades.dart';

class StudentGrades extends StatefulWidget {
  @override
  _StudentGradesState createState() => _StudentGradesState();
}

class _StudentGradesState extends State<StudentGrades> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          backgroundColor: Color(0xfff263238),
          title: Text('Grades'),
          automaticallyImplyLeading: false,
        ),
        body: SingleChildScrollView(
          child: Card(
            child: Container(
              alignment: Alignment.topLeft,
              padding: EdgeInsets.all(15),
              child: FutureBuilder(
                future: Grade().Grades(),
                builder: (context, ss) {
                  if (ss.hasError) {
                    print('error');
                  }
                  if (ss.hasData) {
                    List Courses = ss.data['courses'];
                    List Assignment=ss.data['finishedAssignments'];
                    List Quiz=ss.data['finishedQuizzes'];


                   print('*******************${Assignment.length}');
                     return ListView.builder(
                         scrollDirection: Axis.vertical,
                         shrinkWrap: true,
                         itemCount: Courses.length,
                         itemBuilder:(context,position){
                           Map course=Courses[position];
                           List list=Assignment[position];
                           List Qlist=Quiz[position];

                           return Column(
                             children: <Widget>[
                               Center(
                                 child: Container(
                                     child: Column(
                                       children: <Widget>[
                                         Container(
                                           alignment: Alignment.center,
                                           child: Text(
                                             "${course['course_name']}",
                                             style: TextStyle(
                                               fontWeight: FontWeight.w500,
                                               fontSize: 23,
                                             ),
                                             textAlign: TextAlign.left,
                                           ),
                                         ),
                                         SizedBox(
                                           height: 25,
                                         ),
                                         Container(
                                           alignment: Alignment.center,
                                           child: Text(
                                             "Assignments",
                                             style: TextStyle(
                                               //   color: Colors.white,
                                               fontWeight: FontWeight.w500,
                                               fontSize: 23,
                                             ),
                                             textAlign: TextAlign.left,
                                           ),
                                         ),
                                         SizedBox(
                                           height: 15,
                                         ),

                                         ListView.builder(
                                             scrollDirection: Axis.vertical,
                                             shrinkWrap: true,
                                             itemCount: list.length,
                                             itemBuilder: (context, Aposition) {
                                               Map Amap = list[Aposition];
                                               return Column(
                                                 children: <Widget>[
                                                   Row(
                                                     mainAxisAlignment:
                                                     MainAxisAlignment.spaceAround,
                                                     children: <Widget>[
                                                       Text(
                                                         '${Amap['assignment']['assignment_title']}',
                                                         style: TextStyle(
                                                           fontWeight: FontWeight.w500,
                                                           fontSize: 18,
                                                         ),
                                                       ),
                                                       Text(
                                                         '${Amap['compilation_grade'] + Amap['style_grade'] + Amap['dynamic_test_grade'] + Amap['feature_test_grade']} %',
                                                         style: TextStyle(
                                                           fontWeight: FontWeight.w500,
                                                           fontSize: 18,
                                                         ),
                                                       ),
                                                     ],
                                                   ),
                                                   SizedBox(
                                                     height: 20,
                                                   )
                                                 ],
                                               );
                                             }),

                                         Divider(
                                           color: Colors.black38,
                                           height: 20,
                                         ),
                                         Container(
                                           alignment: Alignment.center,
                                           child: Text(
                                             "Quizzes",
                                             style: TextStyle(
                                               //   color: Colors.white,
                                               fontWeight: FontWeight.w500,
                                               fontSize: 23,
                                             ),
                                             textAlign: TextAlign.left,
                                           ),
                                         ),
                                         SizedBox(
                                           height: 25,
                                         ),
                                         ListView.builder(
                                             scrollDirection: Axis.vertical,
                                             shrinkWrap: true,
                                             itemCount: Qlist.length,
                                             itemBuilder: (context, position) {
                                               Map Qmap = Qlist[position];
                                               return Column(
                                                 children: <Widget>[
                                                   Row(
                                                     mainAxisAlignment:
                                                     MainAxisAlignment.spaceAround,
                                                     children: <Widget>[
                                                       Text(
                                                         '${Qmap['quiz']['quiz_title']}',
                                                         style: TextStyle(
                                                           fontWeight: FontWeight.w500,
                                                           fontSize: 18,
                                                         ),
                                                       ),
                                                       Text(
                                                         '${Qmap['quiz_grade'] }%',
                                                         style: TextStyle(
                                                           fontWeight: FontWeight.w500,
                                                           fontSize: 18,
                                                         ),
                                                       ),
                                                     ],
                                                   ),
                                                   SizedBox(
                                                     height: 20,
                                                   )
                                                 ],
                                               );
                                             }),
                                       ],
                                     )),
                               ),
                               Divider(
                                 color: Colors.black38,
                                 height: 50,
                               ),
                             ],
                           );
                     }
                     );
                   // return CircularProgressIndicator();
                  }
                  else {
                    return Center(
                      child: CircularProgressIndicator(),
                    );
                  }
                },
              ),

            ),
          ),
        )
    );
  }
}
