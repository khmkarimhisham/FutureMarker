import 'package:flutter/material.dart';
import 'package:flutter_custom_clippers/flutter_custom_clippers.dart';
import 'package:futuremarkerapp/Views/Instructor/Instructor_Drawer.dart';


// ignore: camel_case_types
class InstructorHome extends StatefulWidget {
  @override
  _InstructorHomeState createState() => _InstructorHomeState();
}
final GlobalKey<ScaffoldState> _key = GlobalKey<ScaffoldState>();
TextEditingController _CommentController = TextEditingController();

final Color primary = Color(0xfff263238);
final Color active = Colors.white;
final Color divider = Colors.grey.shade600;
Color _iconColor = Colors.grey;

class _InstructorHomeState extends State<InstructorHome> {
  Future<void> _addCommentDialog() async {
    return showDialog<void>(
      context: context,
      barrierDismissible: false, // user must tap button!
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Add Comment'),
          content: SingleChildScrollView(
            child: ListBody(
              children: <Widget>[
                Form(
                  child: TextFormField(
                    maxLines: 3,
                    style: TextStyle(
                        color: Colors.black,
                        fontSize: 18.0,
                        fontWeight: FontWeight.bold),
                    decoration: InputDecoration(
                      hintText: ' Write A Comment',
                    ),
                    controller: _CommentController,
                    validator: (value) => value.length >= 3
                        ? null
                        : 'Comment should Contain at least 3 char',
                    onSaved: (value) => _CommentController.text = value,
                  ),
                )
              ],
            ),
          ),
          actions: <Widget>[
            FlatButton(
              child: Text('Cancel'),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
            FlatButton(
              child: Text('Comment'),
              onPressed: () {},
            ),
          ],
        );
      },
    );
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _key,
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('Home'),
        automaticallyImplyLeading: false,
        leading: IconButton(
          icon: Icon(Icons.menu),
          onPressed: () {
            _key.currentState.openDrawer();
          },
        ),

      ),
      drawer: MyDrawer(),
      body: SingleChildScrollView(
        child: Column(
          children: <Widget>[
            Container(
              margin:
              EdgeInsets.symmetric(vertical: 10, horizontal: 20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(5.0),
              ),
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Row(
                    mainAxisAlignment: MainAxisAlignment.start,
                    children: <Widget>[
                      Text(
                        'Anas hassan',
                        style: TextStyle(fontSize: 18),
                      ),
                      Icon(Icons.play_arrow),
                      Text(
                        'Mobile Programming',
                        style: TextStyle(fontSize: 18),
                      ),
                    ],
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  Text(
                    'Posted on 14 /12 /2020-12 pm',
                    style: TextStyle(fontSize: 12),
                  ),
                  Divider(),
                  SizedBox(
                    height: 10,
                  ),
                  //hena haykon l post body lgai mn ldatabse
                  Text(
                      'In computer science, a data structure is a data organization, management, '
                          'and storage format that enables efficient access and modification. More precisely,'
                          ' a data structure is a collection of data values, the relationships among them, '
                          'and the functions or operations that can be applied to the data.'),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: <Widget>[
//
                      IconButton(
                          icon: Icon(Icons.favorite, color: _iconColor),
                          onPressed: () {
                            setState(() {
                              if(_iconColor == Colors.red){
                                _iconColor = Colors.grey;
                              }
                              else{
                                _iconColor = Colors.red;
                              }
                            });
                          }),

                      SizedBox(
                        width: 5.0,
                      ),
                      Text('55'),
                      SizedBox(
                        width: 16.0,
                      ),
                      InkWell(
                          onTap: (){
                            _addCommentDialog();
                          },
                          child: Icon(Icons.comment)),
                      SizedBox(
                        width: 5.0,
                      ),
                      Text('24'),
                    ],
                  ),
                  Divider(),
                  //Comments
                  Container(
                    margin:
                    EdgeInsets.symmetric(vertical: 10, horizontal: 20),
                    decoration: BoxDecoration(
                      color: Color(0xffff6f6f6),
                      borderRadius: BorderRadius.circular(5.0),
                    ),
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        Row(
                          mainAxisAlignment: MainAxisAlignment.start,
                          children: <Widget>[
                            Container(
                              width: 30,
                              height: 30,
                              margin: EdgeInsets.only(right: 10),
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(50),
                                border: Border.all(width: 3, color: Colors.white),
                                image: DecorationImage(
                                    image: AssetImage('Images/01.png'),
                                    fit: BoxFit.fill),
                              ),
                            ),
                            Text('Mohamed Essam')
                          ],
                        ),
                        Padding(padding: EdgeInsets.only(left: 40),
                          child:  Text('anas ahssan cnfjgoijojgoijsogoigojsojoijioieiion '
                              'jejoijeiojoijo ijoi joi jj oijoijo '),

                        ),
                      ],

                    ),
                  ),
                  Container(
                    margin:
                    EdgeInsets.symmetric(vertical: 10, horizontal: 20),
                    decoration: BoxDecoration(
                      color: Color(0xffff6f6f6),
                      borderRadius: BorderRadius.circular(5.0),
                    ),
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        Row(
                          mainAxisAlignment: MainAxisAlignment.start,
                          children: <Widget>[
                            Container(
                              width: 30,
                              height: 30,
                              margin: EdgeInsets.only(right: 10),
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(50),
                                border: Border.all(width: 3, color: Colors.white),
                                image: DecorationImage(
                                    image: AssetImage('Images/01.png'),
                                    fit: BoxFit.fill),
                              ),
                            ),
                            Text('Mohamed Essam')
                          ],
                        ),
                        Padding(padding: EdgeInsets.only(left: 40),
                          child:  Text('anas ahssan cnfjgoijojgoijsogoigojsojoijioieiion '
                              'jejoijeiojoijo ijoi joi jj oijoijo '),

                        ),
                      ],

                    ),
                  ),
                ],
              ),
            ),
            Container(
              margin:
              EdgeInsets.symmetric(vertical: 10, horizontal: 20),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(5.0),
              ),
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: <Widget>[
                  Row(
                    mainAxisAlignment: MainAxisAlignment.start,
                    children: <Widget>[
                      Text(
                        'Anas hassan',
                        style: TextStyle(fontSize: 18),
                      ),
                      Icon(Icons.play_arrow),
                      Text(
                        'System Programming',
                        style: TextStyle(fontSize: 18),
                      ),
                    ],
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  Text(
                    'Posted on 14 /12 /2020-12 pm',
                    style: TextStyle(fontSize: 12),
                  ),
                  Divider(),
                  SizedBox(
                    height: 10,
                  ),
                  //hena haykon l post body lgai mn ldatabse
                  Text(
                      'In computer science, a data structure is a data organization, management, '
                          'and storage format that enables efficient access and modification. More precisely,'
                          ' a data structure is a collection of data values, the relationships among them, '
                          'and the functions or operations that can be applied to the data.'),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: <Widget>[
//
                      IconButton(
                          icon: Icon(Icons.favorite, color: _iconColor),
                          onPressed: () {
                            setState(() {
                              if(_iconColor == Colors.red){
                                _iconColor = Colors.grey;
                              }
                              else{
                                _iconColor = Colors.red;
                              }
                            });
                          }),

                      SizedBox(
                        width: 5.0,
                      ),
                      Text('55'),
                      SizedBox(
                        width: 16.0,
                      ),
                      InkWell(
                          onTap: (){
                            _addCommentDialog();
                          },
                          child: Icon(Icons.comment)),
                      SizedBox(
                        width: 5.0,
                      ),
                      Text('24'),
                    ],
                  ),
                  Divider(),
                  //Comments
                  Container(
                    margin:
                    EdgeInsets.symmetric(vertical: 10, horizontal: 20),
                    decoration: BoxDecoration(
                      color: Color(0xffff6f6f6),
                      borderRadius: BorderRadius.circular(5.0),
                    ),
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        Row(
                          mainAxisAlignment: MainAxisAlignment.start,
                          children: <Widget>[
                            Container(
                              width: 30,
                              height: 30,
                              margin: EdgeInsets.only(right: 10),
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(50),
                                border: Border.all(width: 3, color: Colors.white),
                                image: DecorationImage(
                                    image: AssetImage('Images/01.png'),
                                    fit: BoxFit.fill),
                              ),
                            ),
                            Text('Mohamed Essam')
                          ],
                        ),
                        Padding(padding: EdgeInsets.only(left: 40),
                          child:  Text('anas ahssan cnfjgoijojgoijsogoigojsojoijioieiion '
                              'jejoijeiojoijo ijoi joi jj oijoijo '),

                        ),
                      ],

                    ),
                  ),
                  Container(
                    margin:
                    EdgeInsets.symmetric(vertical: 10, horizontal: 20),
                    decoration: BoxDecoration(
                      color: Color(0xffff6f6f6),
                      borderRadius: BorderRadius.circular(5.0),
                    ),
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        Row(
                          mainAxisAlignment: MainAxisAlignment.start,
                          children: <Widget>[
                            Container(
                              width: 30,
                              height: 30,
                              margin: EdgeInsets.only(right: 10),
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(50),
                                border: Border.all(width: 3, color: Colors.white),
                                image: DecorationImage(
                                    image: AssetImage('Images/01.png'),
                                    fit: BoxFit.fill),
                              ),
                            ),
                            Text('Mohamed Essam')
                          ],
                        ),
                        Padding(padding: EdgeInsets.only(left: 40),
                          child:  Text('anas ahssan cnfjgoijojgoijsogoigojsojoijioieiion '
                              'jejoijeiojoijo ijoi joi jj oijoijo '),

                        ),
                      ],

                    ),
                  ),
                ],
              ),
            ),

          ],
        ),
      ),
    );
  }






}

