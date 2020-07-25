import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Student/UserDataController.dart';
import 'package:futuremarkerapp/Views/Student/Student_Drawer.dart';

class StudentNotification extends StatefulWidget {
  @override
  _StudentNotificationState createState() => _StudentNotificationState();
}

class _StudentNotificationState extends State<StudentNotification> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Notifications'),
        backgroundColor: Color(0xfff263238),
      ),
      drawer: MyDrawer(),
      body: SingleChildScrollView(

        child:FutureBuilder(
            future: UserData().shomeData(),
            builder: (context,ss){
              if(ss.hasError){
                print('error');
              }
              if(ss.hasData){
                List notification=ss.data['notifications'];
                return ListView.builder(
                  scrollDirection: Axis.vertical,
                  shrinkWrap: true,
                    itemCount: notification.length,
                    itemBuilder: (context,position){
                      Map map=notification[position];
                      return  Container(
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(25),
                          color: Colors.white,
                        ),
                        width: double.infinity,
                        height: 110,
                        margin: EdgeInsets.symmetric(
                            vertical: 10, horizontal: 20),
                        padding: EdgeInsets.symmetric(
                            vertical: 10, horizontal: 20),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: <Widget>[
                            Wrap(
                              children: <Widget>[
                                Text(
                                  '${map['content']}',
                                  style: TextStyle(fontSize: 18),
                                ),

                              ],
                            ),
                            SizedBox(
                              height: 10,
                            ),
                            Text(
                              '${map['created_at']}',
                              style: TextStyle(fontSize: 12),
                            ),
                          ],
                        ),
                      );
                    }
                );
              }
              else{
               return CircularProgressIndicator();
              }
            }
        ),
      ),
    );
  }
}
