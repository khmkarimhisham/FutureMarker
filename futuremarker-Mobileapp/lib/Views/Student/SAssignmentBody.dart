import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Student/CourseController.dart';
import 'package:futuremarkerapp/Controllers/Student/UserDataController.dart';
import 'package:html2md/html2md.dart' as html2md;


import '../../x.dart';



class StudentAssignment extends StatefulWidget {


  Map assignmentMap,att;
  String dec;


  StudentAssignment(this.assignmentMap,this.dec,this.att);
  @override
  _StudentAssignmentState createState() => _StudentAssignmentState();
}

class _StudentAssignmentState extends State<StudentAssignment> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('${widget.assignmentMap['assignment_title']}'),

      ),
      body: Stack(
        children: <Widget>[
          SingleChildScrollView(
            child: Column(
              children: <Widget>[
                Container(
                  margin: EdgeInsets.symmetric(vertical: 10, horizontal: 20),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(5.0),
                  ),
                  padding: const EdgeInsets.all(16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: <Widget>[
                      Wrap(

                        children: <Widget>[
                          Text(
                            '${widget.assignmentMap['assignment_title']}',
                            style: TextStyle(fontSize: 18),
                          ),

                        ],
                      ),
                      SizedBox(
                        height: 10,
                      ),
                      Text(
                        'Due:${widget.assignmentMap['assignment_deadline']}',
                        style: TextStyle(fontSize: 12),
                      ),
                      Divider(),
                      SizedBox(
                        height: 10,
                      ),

                      Text(
                          '${html2md.convert(widget.dec)}'),

                      ListView.builder(
                          scrollDirection: Axis.vertical,
                          shrinkWrap: true,
                          itemCount: widget.att.length,
                          itemBuilder: (context, position) {
                            Map x = widget.att;
                            List<String> y1 = [];
                            List<String> y2 = [];
                            if(x.isNotEmpty){
                              x.forEach((x, y) {
                                y1.add(x);
                                y2.add(y);
                              });
                            }


                            return Column(
                              children: <Widget>[

                                new RichText(
                                    text:
                                    LinkTextSpan(
                                        url:
                                        '${UserData().imageurl}${y2[position]}', text: '${y1[position]}', style: TextStyle(color: Colors.black))
                                ),
                              ],
                            );
                          }),

                      Divider(),
                      Text(
                        'Created At ${widget.assignmentMap['created_at']}',
                        style: TextStyle(fontSize: 12),
                      ),

                      SizedBox(height: 50,),

                      RichText(
                          text:
                          LinkTextSpan(
                              url:
                              '${UserData().imageurl}/student/course/assignment/${widget.assignmentMap['id']}', text: 'Click To Submit Assignment', style: TextStyle(color: Colors.black,fontSize: 20,fontWeight: FontWeight.bold))
                      ),

                    ],
                  ),
                ),
              ],
            ),
          ),

        ],
      ),
    );
  }
}
