import 'dart:io';
import 'dart:async';
import 'package:flutter/material.dart';
import 'package:file_picker/file_picker.dart';


class FolderContent extends StatefulWidget {
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
            Center(
              child: Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  // mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: <Widget>[
                    Card(
                      child: ListTile(
                        leading: Icon(Icons.insert_drive_file),
                        title: Text('database'),
                      ),
                    ),
                    Card(
                      child: ListTile(
                        leading: Icon(Icons.insert_drive_file),
                        title: Text('database'),
                      ),
                    ),
                    Card(
                      child: ListTile(
                        leading: Icon(Icons.insert_drive_file),
                        title: Text('database'),
                      ),
                    ),
                    Card(
                      child: ListTile(
                        leading:Icon(Icons.insert_drive_file),
                        title: Text('database'),
                      ),
                    ),

                  ],
                ),
              ),
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
