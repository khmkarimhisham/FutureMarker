import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Instructor/CourseController.dart';

class Assignment extends StatefulWidget {
  int assignmentID, courseID;
  String assignmentName;

  Assignment(this.courseID, this.assignmentID, this.assignmentName);
  @override
  _AssignmentState createState() => _AssignmentState();
}

class _AssignmentState extends State<Assignment> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('${widget.assignmentName}'),
      ),
      body: SingleChildScrollView(
        child: Column(
          children: <Widget>[
            Container(
              margin: EdgeInsets.symmetric(vertical: 10, horizontal: 20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(5.0),
              ),
              padding: const EdgeInsets.all(16.0),
              child: FutureBuilder(
                future: Courses().CourseContent(widget.courseID),
                builder: (context, ss) {
                  if (ss.hasError) {
                    print('error');
                  }
                  if (ss.hasData) {
                    List myData = ss.data['assignments'];
                  //  print(myData);
                    Map myMap=myData[0];

                          return  Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Wrap(

                                children: <Widget>[
                                  Text(
                                    '${myMap['assignment_title']}',
                                    style: TextStyle(fontSize: 18),
                                  ),

                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Text(
                                'Due:${myMap['assignment_deadline']}',
                                style: TextStyle(fontSize: 12),
                              ),
                              Divider(),
                              SizedBox(
                                height: 10,
                              ),
                              //hena haykon l post body lgai mn ldatabse
                              Text(
                                  '${myMap['assignment_desc_dir']}'),

                              Divider(),
                              Text(
                                'Created At ${myMap['created_at']}',
                                style: TextStyle(fontSize: 12),
                              ),

                            ],
                          );

                  }
                  else {
                    return CircularProgressIndicator();
                  }
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}
