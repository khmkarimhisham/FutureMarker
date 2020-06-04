import 'package:flutter/material.dart';
import 'package:path_provider/path_provider.dart';
import 'package:flutter/foundation.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'dart:io';

class Folder extends StatelessWidget {
  String courseID, dir;
  Folder(this.courseID, this.dir);

/*  static var httpClient = new HttpClient();
  Future<File> _downloadFile(String url, String filename) async {
    var request = await httpClient.getUrl(Uri.parse(url));
    var response = await request.close();
    var bytes = await consolidateHttpClientResponseBytes(response);
    String dir = (await getApplicationDocumentsDirectory()).path;
    File file = new File('$dir/$filename');
    await file.writeAsBytes(bytes);
    return file;
  }*/

  Future getContent(String dir) async {
    String url = 'http://192.168.1.2/WebApp/read.php';
    http.Response response = await http.post(url, body: {'myPath': dir});
    if (response.statusCode == 200) {
      return jsonDecode(response.body);
    } else
      return [];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Files'),
      ),
      body: FutureBuilder(
        future: getContent(dir),
        builder: (context, ss) {
          if (ss.hasError) {
            print('');
          }
          if (ss.hasData) {
            List myData = ss.data;
            print(myData);
            return ListView.builder(
                itemCount: myData.length,
                itemBuilder: (context, position) {
                  Map myMap = myData[position];
                  return myMap.keys.first == 'F'
                      ? Container()
                      : SingleChildScrollView(
                    child: Container(
                      child: Center(
                        child: Padding(
                          padding: EdgeInsets.all(3.0),
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                            children: <Widget>[
                              GestureDetector(
                                onTap: (){},
                                child: Card(
                                  elevation: 5,
                                  child: ListTile(
                                    leading: Icon(Icons.insert_drive_file),
                                    title: Text('${myMap.values.first}'),
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
            return Text('This Course Is Empty');
          }
        },
      ),
    );
  }
}
