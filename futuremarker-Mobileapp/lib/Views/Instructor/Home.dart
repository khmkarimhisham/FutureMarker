import 'package:flutter/material.dart';
import 'package:flutter_custom_clippers/flutter_custom_clippers.dart';
import 'package:futuremarkerapp/Controllers/Auth/AuthController.dart';
import 'package:futuremarkerapp/Controllers/Instructor/PostController.dart';
import 'package:futuremarkerapp/Controllers/Instructor/UserDataConrtoller.dart';
import 'package:futuremarkerapp/Views/Instructor/Instructor_Drawer.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:html2md/html2md.dart' as html2md;

// ignore: camel_case_types
class InstructorHome extends StatefulWidget {
  @override
  _InstructorHomeState createState() => _InstructorHomeState();
}

TextEditingController _CommentController = TextEditingController();

final Color primary = Color(0xfff263238);
final Color active = Colors.white;
final Color divider = Colors.grey.shade600;
Color _iconColor = Colors.grey;

class _InstructorHomeState extends State<InstructorHome> {
  TextEditingController _CommentController = TextEditingController();
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  SendData sendData = new SendData();

  Future read() async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final Ekey = 'email';
    final Pkey = 'password';
    final value = prefs.get(key) ?? 0;
    final Evalue = prefs.get(Ekey) ?? 0;
    final Pvalue = prefs.get(Pkey) ?? 0;
    if (value != 0) {
      sendData.loginData(Evalue, Pvalue);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('Home'),
      ),
      drawer: MyDrawer(),
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
              child: Center(
                child: FutureBuilder(
                    future: UserData().homeData(),
                    builder: (context, ss) {
                      if (ss.hasError) {
                        print("Error");
                      }
                      if (ss.hasData) {
                        List myList = ss.data['posts'];

                        return ListView.builder(
                            scrollDirection: Axis.vertical,
                            shrinkWrap: true,
                            itemCount: myList.length,
                            itemBuilder: (context, position) {
                              Map mymap = myList[position];
                              List myComment = mymap['comments'];
                              return SingleChildScrollView(
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: <Widget>[
                                    Wrap(
                                      children: <Widget>[
                                        Text(
                                          '${mymap['user']['name']}',
                                          style: TextStyle(fontSize: 18),
                                        ),
                                        Icon(Icons.play_arrow),
                                        Text(
                                          '${mymap['course']['course_name']}',
                                          style: TextStyle(fontSize: 18),
                                        ),
                                      ],
                                    ),
                                    SizedBox(
                                      height: 10,
                                    ),
                                    Text(
                                      'Posted in ${mymap['created_at']}',
                                      style: TextStyle(fontSize: 12),
                                    ),
                                    Divider(),
                                    SizedBox(
                                      height: 10,
                                    ),
                                    //hena haykon l post body lgai mn ldatabse
                                    Text(
                                        '${html2md.convert(mymap['post_content'])}'),
                                    Row(
                                      mainAxisAlignment: MainAxisAlignment.end,
                                      children: <Widget>[
//
//                                    IconButton(
//                                        icon: Icon(Icons.favorite, color: _iconColor),
//                                        onPressed: () {
//                                          setState(() {
//                                            if(_iconColor == Colors.red){
//                                              _iconColor = Colors.grey;
//                                            }
//                                            else{
//                                              _iconColor = Colors.red;
//                                            }
//                                          });
//                                        }),

//                                    SizedBox(
//                                      width: 5.0,
//                                    ),
//                                    Text('55'),
                                        SizedBox(
                                          width: 16.0,
                                        ),
                                        InkWell(
                                            onTap: () {
                                              showDialog<void>(
                                                context: context,
                                                barrierDismissible:
                                                    false, // user must tap button!
                                                builder:
                                                    (BuildContext context) {
                                                  return AlertDialog(
                                                    title: Text('Add Comment'),
                                                    content:
                                                        SingleChildScrollView(
                                                      child: ListBody(
                                                        children: <Widget>[
                                                          Form(
                                                            key: _formKey,
                                                            child:
                                                                TextFormField(
                                                              maxLines: 3,
                                                              style: TextStyle(
                                                                  color: Colors
                                                                      .black,
                                                                  fontSize:
                                                                      18.0,
                                                                  fontWeight:
                                                                      FontWeight
                                                                          .bold),
                                                              decoration:
                                                                  InputDecoration(
                                                                hintText:
                                                                    ' Write A Comment',
                                                              ),
                                                              controller:
                                                                  _CommentController,
                                                              validator: (value) =>
                                                                  value.length >=
                                                                          3
                                                                      ? null
                                                                      : 'Comment should Contain at least 3 char',
                                                              onSaved: (value) =>
                                                                  _CommentController
                                                                          .text =
                                                                      value,
                                                            ),
                                                          )
                                                        ],
                                                      ),
                                                    ),
                                                    actions: <Widget>[
                                                      FlatButton(
                                                        child: Text('Cancel'),
                                                        onPressed: () {
                                                          Navigator.of(context)
                                                              .pop();
                                                        },
                                                      ),
                                                      FlatButton(
                                                        child: Text('Comment'),
                                                        onPressed: () {
                                                          var key = _formKey
                                                              .currentState;
                                                          if (key.validate()) {
                                                            key.save();

                                                            setState(() {
                                                              Post().createComment(
                                                                  _CommentController
                                                                      .text,
                                                                  mymap['id']);

                                                              Navigator.pop(
                                                                  context);
                                                            });
                                                          }
                                                        },
                                                      ),
                                                    ],
                                                  );
                                                },
                                              );
                                            },
                                            child: Icon(Icons.comment)),
                                        SizedBox(
                                          width: 5.0,
                                        ),
                                        Text('${myComment.length}'),
                                      ],
                                    ),
                                    Divider(),
                                    //Comments
                                    ListView.builder(
                                        scrollDirection: Axis.vertical,
                                        shrinkWrap: true,
                                        itemCount: myComment.length,
                                        itemBuilder: (context, pos) {
                                          Map Comment = myComment[pos];

                                          return Container(
                                            margin: EdgeInsets.symmetric(
                                                vertical: 10, horizontal: 20),
                                            decoration: BoxDecoration(
                                              color: Color(0xffff6f6f6),
                                              borderRadius:
                                                  BorderRadius.circular(5.0),
                                            ),
                                            padding: const EdgeInsets.all(16.0),
                                            child: Column(
                                              crossAxisAlignment:
                                                  CrossAxisAlignment.start,
                                              children: <Widget>[
                                                Row(
                                                  mainAxisAlignment:
                                                      MainAxisAlignment.start,
                                                  children: <Widget>[
                                                    Container(
                                                      width: 30,
                                                      height: 30,
                                                      margin: EdgeInsets.only(
                                                          right: 10),
                                                      decoration: BoxDecoration(
                                                        borderRadius:
                                                            BorderRadius
                                                                .circular(50),
                                                        border: Border.all(
                                                            width: 3,
                                                            color:
                                                                Colors.white),
                                                        image: DecorationImage(
                                                            image: NetworkImage(
                                                                '${UserData().imageurl}/${Comment['user']['image']}'),
                                                            fit: BoxFit.fill),
                                                      ),
                                                    ),
                                                    Text(
                                                        '${Comment['user']['name']}')
                                                  ],
                                                ),
                                                Padding(
                                                  padding:
                                                      EdgeInsets.only(left: 40),
                                                  child: Text(
                                                      '${Comment['comment_content']}'),
                                                ),
                                              ],
                                            ),
                                          );
                                        }),
                                  ],
                                ),
                              );
                            });
                      } else {
                        return CircularProgressIndicator();
                      }
                    }),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
