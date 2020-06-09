import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Views/Instructor/Instructor_Drawer.dart';
import 'package:futuremarkerapp/Views/Instructor/CreateCourse.dart';






class MyCourses extends StatefulWidget {
  @override
  _MyCoursesState createState() => _MyCoursesState();
}

class _MyCoursesState extends State<MyCourses> {
  final GlobalKey<ScaffoldState> _courseskey = GlobalKey<ScaffoldState>();
  final primary = Color(0xfff263238);
  final secondary = Colors.white;
  TextEditingController _accessController = TextEditingController();
  Future<void> _showMyDialog() async {
    return showDialog<void>(
      context: context,
      barrierDismissible: false, // user must tap button!
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Join Course'),
          content: SingleChildScrollView(
            child: ListBody(
              children: <Widget>[
                Form(
                  child: TextFormField(

                    style: TextStyle(
                        color: Colors.black,
                        fontSize: 18.0,
                        fontWeight: FontWeight.bold),
                    decoration: InputDecoration(
                      hintText: ' Enter Course Access Code',
                    ),
                    controller: _accessController,
                    validator: (value) => value.length >= 14
                        ? null
                        : 'Access code should be 14 characters',
                    onSaved: (value) => _accessController.text = value,
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
              child: Text('Join'),
              onPressed: () {},
            ),
          ],
        );
      },
    );
  }
  final List<Map> schoolLists = [

    {
      "name": "WilingTon Cambridge",
      "location": "Kasai Pantan NY, 12483",
      "type": "Lower Secondary School",
      "logoText":
      "https://cdn.pixabay.com/photo/2017/01/13/01/22/rocket-1976107_960_720.png"
    },
    {
      "name": "Fredik Panlon",
      "location": "572 Statan NY, 12483",
      "type": "Higher Secondary School",
      "logoText":
      "https://cdn.pixabay.com/photo/2017/03/16/21/18/logo-2150297_960_720.png"
    },

    {
      "name": "Campare Handeson",
      "location": "Kasai Pantan NY, 12483",
      "type": "Lower Secondary School",
      "logoText":
      "https://cdn.pixabay.com/photo/2017/01/13/01/22/rocket-1976107_960_720.png"
    },
  ];
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _courseskey,
      backgroundColor: Color(0xfff0f0f0),
      drawer: MyDrawer(),
      body: SingleChildScrollView(
        child: Container(
          height: MediaQuery.of(context).size.height,
          width: MediaQuery.of(context).size.width,
          child: Stack(
            children: <Widget>[
              Container(
                padding: EdgeInsets.only(top: 100),
                height: MediaQuery.of(context).size.height,
                width: double.infinity,
                child: ListView.builder(
                    itemCount: schoolLists.length,
                    itemBuilder: (BuildContext context, int index) {
                      return InkWell(
                        onTap: (){
//                          Navigator.push(
//                            context,
//                            MaterialPageRoute(builder: (context) => Course()),
//                          );
                        },
                        child: buildList(context, index),
                      );
                    }),
              ),
              Container(
                height: 110,
                width: double.infinity,
                decoration: BoxDecoration(
                    color: primary,
                    borderRadius: BorderRadius.only(
                        bottomLeft: Radius.circular(30),
                        bottomRight: Radius.circular(30))),
                child: Padding(
                  padding: const EdgeInsets.only(top:20.0),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: <Widget>[
                      IconButton(
                        onPressed: () {
                          _courseskey.currentState.openDrawer();
                        },
                        icon: Icon(
                          Icons.menu,
                          color: Colors.white,
                          size: 35.0,
                        ),
                      ),
                      Text(
                        "Courses",
                        style: TextStyle(color: Colors.white, fontSize: 24),
                      ),
                      IconButton(
                        onPressed: () {

                          _showMyDialog();

                        },
                        icon: Icon(
                          Icons.add,
                          color: Colors.white,
                          size: 35.0,

                        ),
                      ),
                    ],
                  ),
                ),
              ),

            ],
          ),
        ),
      ),
    );

  }

  Widget buildList(BuildContext context, int index) {
    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(25),
        color: Colors.white,
      ),
      width: double.infinity,
      height: 110,
      margin: EdgeInsets.symmetric(vertical: 10, horizontal: 20),
      padding: EdgeInsets.symmetric(vertical: 10, horizontal: 20),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          Container(
            width: 80,
            height: 80,
            margin: EdgeInsets.only(right: 15),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(50),
              border: Border.all(width: 3, color: secondary),
              image: DecorationImage(
                  image: AssetImage('Images/01.png'),
                  fit: BoxFit.fill),
            ),
          ),
          Center(
            child: Text(
              schoolLists[index]['name'],
              style: TextStyle(
                  color: primary,
                  fontWeight: FontWeight.bold,
                  fontSize: 18),
            ),
          )
        ],
      ),
    );
  }
}