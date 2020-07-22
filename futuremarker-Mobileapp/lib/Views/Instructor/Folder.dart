import 'dart:io';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:file_picker/file_picker.dart';
import 'package:futuremarkerapp/Controllers/Instructor/CourseController.dart';
import 'package:flutter/gestures.dart';
import 'package:futuremarkerapp/Controllers/Instructor/UserDataConrtoller.dart';
import 'package:url_launcher/url_launcher.dart';

import '../../x.dart';


class FolderContent extends StatefulWidget {
  int CourseID;
  String FolderName, CourseDir;
  List mylist;
  FolderContent(this.CourseID,this.FolderName,this.CourseDir,this.mylist);
  @override
  _FolderContentState createState() => _FolderContentState();
}

class _FolderContentState extends State<FolderContent> {
  String filePath;
  @override
  void initState() {
    super.initState();
  }


   selectfile() async{
    filePath = await FilePicker.getFilePath(type: FileType.any);

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
            Positioned(
              bottom: 40,
              right: 20,
              child: InkWell(
                onTap: () {
                 // selectfile();

                },
                child: RichText(
                    text:
                    LinkTextSpan(
                        url:
                        '${UserData().imageurl}/instructor/course/${widget.CourseID}', text: 'Upload File', style: TextStyle(color: Colors.black,fontSize: 20,fontWeight: FontWeight.bold))
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
