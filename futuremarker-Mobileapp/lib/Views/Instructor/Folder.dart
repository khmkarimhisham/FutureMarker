import 'dart:io';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:file_picker/file_picker.dart';
import 'package:futuremarkerapp/Controllers/Instructor/CourseController.dart';


class FolderContent extends StatefulWidget {
  int CourseID;
  String FolderName, CourseDir;
  FolderContent(this.CourseID,this.FolderName,this.CourseDir);
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
            FutureBuilder(
              future: Courses().CourseContent(widget.CourseID),
              builder: (context, ss) {
                if (ss.hasError) {
                  print('error');
                }
                if (ss.hasData) {
                  List myData = ss.data['material'];
                  print('anas ${widget.CourseDir}');
                  return ListView.builder(
                      itemCount: myData.length,
                      itemBuilder: (context, position) {
                        Map myMap = myData[position];
                        return myMap.keys.last == 'dir' ? Container(): SingleChildScrollView(
                          child: Container(
                            child: Center(
                              child: Padding(
                                padding: EdgeInsets.all(8.0),
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                                  children: <Widget>[
                                    GestureDetector(
                                      onTap: (){},
                                      child: Card(
                                        elevation: 5,
                                        child: ListTile(
                                          leading: Icon(Icons.insert_drive_file),
                                          title: Text('${myMap.values.last}'),
                                        ),
                                      ),
                                    )
                                  ],
                                ),
                              ),
                            ),
                          ),
                        );
                      });
                } else {
                  return Text('not found matiral0');
                }
              },
            ),


            Positioned(
              bottom: 40,
              right: 20,
              child: InkWell(
                onTap: () {
                 // selectfile();

                },
                child: Icon(
                  Icons.file_upload,
                  color: Colors.black,
                  size: 45,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
