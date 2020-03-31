import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:futuremarker/API/CourseDataAPI.dart';
import 'package:futuremarker/UI/HomePage.dart';
//import 'package:getflutter/getflutter.dart';
import 'package:http/http.dart' as http;

import 'CourseContent.dart';



class Coursesstudent extends StatefulWidget {
  String userID, userType,CourseID;
  Coursesstudent(this.userID, this.userType);

  @override
  _CoursesstudentState createState() => _CoursesstudentState();
}

class _CoursesstudentState extends State<Coursesstudent> {
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    print(widget.userType);
    print(widget.userID);
  }
  // ignore: missing_return
  TextEditingController _coursecode = TextEditingController();
  String message = "";
  _displayDialog(BuildContext context) async {
    return showDialog(
        context: context,
        builder: (context) {
          return AlertDialog(
            title: Text('Join Course',style: TextStyle(fontSize: 22,fontWeight: FontWeight.bold),),
            content: TextField(
              controller: _coursecode,
              decoration: InputDecoration(hintText: "Enter Accses Code"),
            ),
            actions: <Widget>[
              new FlatButton(
                child: new Text('Join',style: TextStyle(fontSize: 18),),
                onPressed: ()=> joincourse(),
              ),
              new FlatButton(
                child: new Text('Cancel',style: TextStyle(fontSize: 18),),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),

            ],
          );
        });
  }
  Future<List> joincourse() async{
    var URL='http://192.168.1.2/FutureMarker/WebApp/DB/joincourse.php';
    final response=await http.post(URL,body:{
      'usertype' : widget.userType,
      'userID' : widget.userID,
      'accsescode':_coursecode.text,
    });
    var coursedata = json.decode(response.body);
    print(coursedata);
    if(coursedata){
      Navigator.pop(context);
      setState(() {

      });
    }else{
      Navigator.pop(context);
      showDialog(context: context,builder: (context){
        return AlertDialog(
          content: Text('You are already in this course!'),
        );
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: new AppBar(
        title: new Text("Courses"),
        backgroundColor: Colors.lightBlue,
        actions: <Widget>[
          IconButton(icon: Icon(Icons.add), onPressed: () => _displayDialog(context),
          ),
        ],
      ),
      body: FutureBuilder(
        future: MyCourse().coursedata(widget.userType, widget.userID),
        builder: (BuildContext context, AsyncSnapshot ss) {
          if (ss.hasError) {
            print('Error');
          }
          if (ss.hasData) {
            print(ss.data);
            List myData = ss.data;
            int i=0;
            while( i<=myData.length){
              i++;
            }

            if (widget.userType == 'instructor') {
              return ListView.builder(
                padding: const EdgeInsets.all(16),
                itemCount: myData.length,
                itemBuilder: (context, i) {
                  return Container(
                    height: 130,
                    child: Card(
                      elevation: 5,
                      child: GestureDetector(
                        onTap: () {
                            Navigator.push(context, MaterialPageRoute(builder: (context)=>coursecontent(
                                myData[i]['Course_ID'],
                                myData[i]['Course_name'],
                                myData[i]['Course_material_dir'],
                            )));
                            //print(' cousre id y anas${myData[i]['Course_ID']}');
                        },
                        child: Row(
                          children: <Widget>[
                            Padding(
                              padding: EdgeInsets.all(10.0),
                              child: Container(
                                width: 100.0,
                                height: 100.0,
                                decoration: BoxDecoration(
                                    image: DecorationImage(
                                      //'http://192.168.1.9/WebApp/uploads/course_img/${ myData[i]['Course_image']}'
                                        image: NetworkImage('http://192.168.1.2/WebApp/${ myData[i]['Course_image']}'),
                                        fit: BoxFit.cover),
                                    borderRadius:
                                        BorderRadius.all(Radius.circular(70.0)),
                                    boxShadow: [
                                      BoxShadow(
                                          blurRadius: 7.0, color: Colors.black)
                                    ]),
                              ),
                            ),
                            Padding(
                              padding: EdgeInsets.all(10.0),

                              child: Text(
                                '${
                                    myData[i]['Course_name']}',
                                style: TextStyle(
                                    fontSize: 20, fontWeight: FontWeight.bold),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  );
                },
              );
            } else  {
              return ListView.builder(
                padding: const EdgeInsets.all(16),
                itemCount: myData.length,
                itemBuilder: (context, i) {
                  return Container(
                    height: 130,
                    child: Card(
                      elevation: 5,
                      child: GestureDetector(
                        onTap: () {
                            Navigator.push(context, MaterialPageRoute(builder: (context)=>coursecontent(myData[i]['Course_ID'], myData[i]['Course_name'],myData[i]['Course_material_dir'])));
                        },
                        child: Row(
                          children: <Widget>[
                            Padding(
                              padding: EdgeInsets.all(10.0),
                              child: Container(
                                width: 100.0,
                                height: 100.0,
                                decoration: BoxDecoration(
                                    image: DecorationImage(
                                        image:  NetworkImage('http://192.168.1.2/WebApp/${ myData[i]['Course_image']}'),
                                        fit: BoxFit.cover),
                                    borderRadius:
                                        BorderRadius.all(Radius.circular(70.0)),
                                    boxShadow: [
                                      BoxShadow(
                                          blurRadius: 7.0, color: Colors.black)
                                    ]),
                              ),
                            ),
                            Padding(
                              padding: EdgeInsets.all(10.0),
                              child: Text(
                                '${myData[i]['Course_name']}',
                                style: TextStyle(
                                    fontSize: 20, fontWeight: FontWeight.bold),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  );
                },
              );
            }
          } else {
            return Center(
              child: Text('You Dont Join to Any Course'),
            ) ;
          }
        },
      ),
    );
  }
}
