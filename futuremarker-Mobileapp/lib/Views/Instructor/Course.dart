import 'package:flutter/material.dart';
import 'dart:async';

class Course extends StatefulWidget {
  static final String path = "lib/src/pages/misc/navybar.dart";
  @override
  _CourseState createState() => _CourseState();
}

class _CourseState extends State<Course> {
  @override
  void dispose() {
    indexcontroller.close();
    super.dispose();
  }

  TextEditingController _nameController = TextEditingController();
  TextEditingController _CommentController = TextEditingController();

  Future<void> _showMyDialog() async {
    return showDialog<void>(
      context: context,
      barrierDismissible: false, // user must tap button!
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Create Folder'),
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
                      hintText: ' Folder Name',
                    ),
                    controller: _nameController,
                    validator: (value) => value.length >= 3
                        ? null
                        : 'Name should Contain at least 3 char',
                    onSaved: (value) => _nameController.text = value,
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
              child: Text('Creare'),
              onPressed: () {},
            ),
          ],
        );
      },
    );
  }
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

  PageController pageController = PageController(initialPage: 0);
  StreamController<int> indexcontroller = StreamController<int>.broadcast();
  int index = 0;
  Color _iconColor = Colors.grey;
  @override
  Widget build(BuildContext context) {
    Icon icone = Icon(Icons.favorite_border);
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('Course Name'),
      ),
      body: PageView(
        physics: NeverScrollableScrollPhysics(),
        onPageChanged: (index) {
          indexcontroller.add(index);
        },
        controller: pageController,
        children: <Widget>[
          //Material screen
          Container(
            child: Stack(
              children: <Widget>[
                Column(
                  children: <Widget>[
                    Center(
                      child: Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Column(
                          // mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                          children: <Widget>[
                            Card(
                              child: ListTile(
                                leading: Icon(Icons.folder),
                                title: Text('database'),
                              ),
                            ),
                            Card(
                              child: ListTile(
                                leading: Icon(Icons.folder),
                                title: Text('database'),
                              ),
                            ),
                            Card(
                              child: ListTile(
                                leading: Icon(Icons.folder),
                                title: Text('database'),
                              ),
                            ),
                            Card(
                              child: ListTile(
                                leading: Icon(Icons.folder),
                                title: Text('database'),
                              ),
                            ),
                            Card(
                              child: ListTile(
                                leading: Icon(Icons.folder),
                                title: Text('database'),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  ],
                ),
                Positioned(
                  bottom: 40,
                  right: 20,
                  child: InkWell(
                    onTap: () {
                      _showMyDialog();
                    },
                    child: Icon(
                      Icons.create_new_folder,
                      color: Colors.black,
                      size: 45,
                    ),
                  ),
                ),
              ],
            ),
          ),
          //assinments screen
          Container(
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
                            leading: Icon(Icons.assignment),
                            title: Text('database'),
                            subtitle: Text('due:24/12/2020'),
                          ),
                        ),
                        Card(
                          child: ListTile(
                            leading: Icon(Icons.assignment),
                            title: Text('database'),
                            subtitle: Text('due:24/12/2020'),
                          ),
                        ),
                        Card(
                          child: ListTile(
                            leading: Icon(Icons.assignment),
                            title: Text('database'),
                            subtitle: Text('due:24/12/2020'),
                          ),
                        ),
                        Card(
                          child: ListTile(
                            leading: Icon(Icons.assignment),
                            title: Text('database'),
                            subtitle: Text('due:24/12/2020'),
                          ),
                        ),
                        Card(
                          child: ListTile(
                            leading: Icon(Icons.assignment),
                            title: Text('database'),
                            subtitle: Text('due:24/12/2020'),
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
                    onTap: () {},
                    child: Icon(
                      Icons.create,
                      color: Colors.black,
                      size: 45,
                    ),
                  ),
                ),
              ],
            ),
          ),
          //grades screen
          Center(
            child: Text('grades'),
          ),
          //posts screen
          Container(
            child: Stack(
              children: <Widget>[
                SingleChildScrollView(
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

                    ],
                  ),
                ),
                Positioned(
                  bottom: 40,
                  right: 20,
                  child: InkWell(
                    onTap: () {

                    },
                    child: Icon(
                      Icons.add,
                      color: Colors.black,
                      size: 45,
                    ),
                  ),
                ),
              ],
            ),
          ),
          //members screem
          Container(
            child: Center(
              child: Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  // mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: <Widget>[
                    Card(
                      child: ListTile(
                        leading: Container(
                          width: 80,
                          height: 100,
                          margin: EdgeInsets.only(right: 15),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(50),
                            border: Border.all(width: 3, color: Colors.white),
                            image: DecorationImage(
                                image: AssetImage('Images/01.png'),
                                fit: BoxFit.fill),
                          ),
                        ),
                        title: Text('Mohamed Essam'),
                      ),
                    ),
                    Card(
                      child: ListTile(
                        leading: Container(
                          width: 80,
                          height: 100,
                          margin: EdgeInsets.only(right: 15),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(50),
                            border: Border.all(width: 3, color: Colors.white),
                            image: DecorationImage(
                                image: AssetImage('Images/01.png'),
                                fit: BoxFit.fill),
                          ),
                        ),
                        title: Text('Mohamed Essam'),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ],
      ),
      bottomNavigationBar: StreamBuilder<Object>(
          initialData: 0,
          stream: indexcontroller.stream,
          builder: (context, snapshot) {
            int cIndex = snapshot.data;
            return FancyBottomNavigation(
              currentIndex: cIndex,
              items: <FancyBottomNavigationItem>[
                FancyBottomNavigationItem(
                    icon: Icon(Icons.book), title: Text('Material')),
                FancyBottomNavigationItem(
                    icon: Icon(Icons.assignment), title: Text('Assignments')),
                FancyBottomNavigationItem(
                    icon: Icon(Icons.grade), title: Text('Grades')),
                FancyBottomNavigationItem(
                    icon: Icon(Icons.speaker_phone), title: Text('Updates')),
                FancyBottomNavigationItem(
                    icon: Icon(Icons.people), title: Text('Members')),
              ],
              onItemSelected: (int value) {
                indexcontroller.add(value);
                pageController.jumpToPage(value);
              },
            );
          }),
    );
  }
}

class FancyBottomNavigation extends StatefulWidget {
  final int currentIndex;
  final double iconSize;
  final Color activeColor;
  final Color inactiveColor;
  final Color backgroundColor;
  final List<FancyBottomNavigationItem> items;
  final ValueChanged<int> onItemSelected;

  FancyBottomNavigation(
      {Key key,
      this.currentIndex = 0,
      this.iconSize = 24,
      this.activeColor,
      this.inactiveColor,
      this.backgroundColor,
      @required this.items,
      @required this.onItemSelected}) {
    assert(items != null);
    assert(onItemSelected != null);
  }

  @override
  _FancyBottomNavigationState createState() {
    return _FancyBottomNavigationState(
        items: items,
        backgroundColor: backgroundColor,
        currentIndex: currentIndex,
        iconSize: iconSize,
        activeColor: activeColor,
        inactiveColor: inactiveColor,
        onItemSelected: onItemSelected);
  }
}

class _FancyBottomNavigationState extends State<FancyBottomNavigation> {
  final int currentIndex;
  final double iconSize;
  Color activeColor;
  Color inactiveColor;
  Color backgroundColor;
  List<FancyBottomNavigationItem> items;
  int _selectedIndex;
  ValueChanged<int> onItemSelected;

  _FancyBottomNavigationState(
      {@required this.items,
      this.currentIndex,
      this.activeColor,
      this.inactiveColor = Colors.black,
      this.backgroundColor,
      this.iconSize,
      @required this.onItemSelected}) {
    _selectedIndex = currentIndex;
  }

  Widget _buildItem(FancyBottomNavigationItem item, bool isSelected) {
    return AnimatedContainer(
      width: isSelected ? 124 : 50,
      height: double.maxFinite,
      duration: Duration(milliseconds: 250),
      padding: EdgeInsets.fromLTRB(12, 8, 12, 8),
      decoration: !isSelected
          ? null
          : BoxDecoration(
              color: Color(0xfff263238),
              borderRadius: BorderRadius.all(Radius.circular(50)),
            ),
      child: ListView(
        shrinkWrap: true,
        padding: EdgeInsets.all(0),
        physics: NeverScrollableScrollPhysics(),
        scrollDirection: Axis.horizontal,
        children: <Widget>[
          Row(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              Padding(
                padding: const EdgeInsets.only(right: 8),
                child: IconTheme(
                  data: IconThemeData(
                      size: iconSize,
                      color: isSelected ? backgroundColor : inactiveColor),
                  child: item.icon,
                ),
              ),
              isSelected
                  ? DefaultTextStyle.merge(
                      style: TextStyle(color: backgroundColor),
                      child: item.title,
                    )
                  : SizedBox.shrink()
            ],
          )
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    activeColor =
        (activeColor == null) ? Theme.of(context).accentColor : activeColor;

    backgroundColor = (backgroundColor == null)
        ? Theme.of(context).bottomAppBarColor
        : backgroundColor;

    return Container(
      width: MediaQuery.of(context).size.width,
      height: 56,
      padding: EdgeInsets.only(left: 8, right: 8, top: 6, bottom: 6),
      decoration: BoxDecoration(
          color: backgroundColor,
          boxShadow: [BoxShadow(color: Colors.black12, blurRadius: 2)]),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: items.map((item) {
          var index = items.indexOf(item);
          return GestureDetector(
            onTap: () {
              onItemSelected(index);

              setState(() {
                _selectedIndex = index;
              });
            },
            child: _buildItem(item, _selectedIndex == index),
          );
        }).toList(),
      ),
    );
  }
}

class FancyBottomNavigationItem {
  final Icon icon;
  final Text title;

  FancyBottomNavigationItem({
    @required this.icon,
    @required this.title,
  }) {
    assert(icon != null);
    assert(title != null);
  }
}
