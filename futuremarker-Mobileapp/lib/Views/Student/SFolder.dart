import 'dart:io';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:file_picker/file_picker.dart';
import 'package:futuremarkerapp/Controllers/Student/CourseController.dart';
import 'package:flutter/gestures.dart';
import 'package:futuremarkerapp/Controllers/Student/UserDataController.dart';
import 'package:url_launcher/url_launcher.dart';

import '../../x.dart';


class SFolderContent extends StatefulWidget {
  int CourseID;
  String FolderName, CourseDir;
  List mylist;
  SFolderContent(this.CourseID,this.FolderName,this.CourseDir,this.mylist);
  @override
  _SFolderContentState createState() => _SFolderContentState();
}

class _SFolderContentState extends State<SFolderContent> {
  String filePath;
  @override
  void initState() {
    super.initState();
  }



  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('${widget.FolderName}'),
      ),
      body:  Container(
        child: Stack(
          children: <Widget>[
            ListView.builder(
                itemCount: widget.mylist.length,
                itemBuilder: (context, position) {
                  Map myMap = widget.mylist[position];
                  List<String> y1 = [];
                  List<String> y2 = [];
                  if(widget.mylist.isNotEmpty){
                    myMap.forEach((x, y) {
                      y1.add(x);
                      y2.add(y);
                    });
                  }
                  return SingleChildScrollView(
                    child: Container(
                      child: Center(
                        child: Padding(
                          padding: EdgeInsets.all(8.0),
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                            children: <Widget>[
                              GestureDetector(
                                onTap: (){

                                },
                                child: Card(
                                  elevation: 5,
                                  child: ListTile(
                                    leading: Icon(Icons.insert_drive_file),
                                    title: RichText(
                                        text:
                                        LinkTextSpan(
                                            url:
                                            '${UserData().imageurl}/${widget.CourseDir}/${widget.FolderName}/${y2.first}', text: '${y2.first}', style: TextStyle(color: Colors.black,fontSize: 16))
                                    ),
                                  ),
                                ),
                              )
                            ],
                          ),
                        ),
                      ),
                    ),
                  );
                }),

          ],
        ),
      ),
    );
  }
}
