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

  PageController pageController = PageController(initialPage: 0);
  StreamController<int> indexcontroller = StreamController<int>.broadcast();
  int index = 0;
  @override
  Widget build(BuildContext context) {
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
          Container(
            child: Center(
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
          ),
          Container(
            child: Center(
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
          ),
          Center(
            child: Text('Security'),
          ),
          Center(
            child: Text('Message'),
          ),
          Container(
            child: Center(
              child: Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  // mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: <Widget>[
                    Card(
                      child: ListTile(
                        leading:  Container(
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
                        leading:  Container(
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
