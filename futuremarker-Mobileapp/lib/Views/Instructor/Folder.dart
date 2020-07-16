import 'dart:io';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:file_picker/file_picker.dart';


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
        title: Text('Folder Name'),
      ),
      body:  Container(
        child: Stack(
          children: <Widget>[


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
