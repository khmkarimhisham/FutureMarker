import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:futuremarker/UI/folder.dart';
import 'dart:async';
import 'package:http/http.dart' as http;

import 'package:futuremarker/API/CourseDataAPI.dart';

class coursecontent extends StatefulWidget {
  String CourseID,Coursename,dir;
  coursecontent(this.CourseID,this.Coursename,this.dir);
  @override
  _coursecontentState createState() => _coursecontentState();
}

class _coursecontentState extends State<coursecontent> {
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    print(widget.CourseID);
    print('hahahahahah');
  }

  void dispose() {
    indexcontroller.close();
    super.dispose();
  }

  PageController pageController = PageController(initialPage: 0);
  StreamController<int> indexcontroller = StreamController<int>.broadcast();
  int index = 0;

  Future getContent(String dir) async{
    String url = 'http://192.168.1.2/WebApp/read.php';
    http.Response response = await http.post(url,body: {
      'myPath': dir
    });
    if(response.statusCode == 200){
      return jsonDecode(response.body);
    }else return [];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.Coursename),
        backgroundColor: Colors.lightBlue,
      ),
      body: PageView(
                physics: NeverScrollableScrollPhysics(),
                onPageChanged: (index) {
                  indexcontroller.add(index);
                },
                controller: pageController,
                children: <Widget>[
      Container(
      decoration: BoxDecoration(
        color: Colors.white70,
      ),
      child: FutureBuilder(
        future: getContent(widget.dir),
        builder: (context,ss){
          if(ss.hasError){
            print('');
          }if(ss.hasData){
            List myData = ss.data;
            print(myData);
            return ListView.builder(
              itemCount: myData.length,
                itemBuilder: (context,position){
                Map myMap = myData[position];
              return myMap.keys.first == 'T' ? Container()
                  : SingleChildScrollView(
                child: Container(
                  child: Center(
                    child: Padding(
                      padding: EdgeInsets.all(8.0),
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                        children: <Widget>[
                          GestureDetector(
                            onTap: ()=>Navigator.push(context, MaterialPageRoute(builder: (context)=>Folder(widget.CourseID,'${widget.dir}/${myMap.values.first}'))),
                            child: Card(
                              elevation: 5,
                              child: ListTile(
                                leading: Icon(Icons.folder),
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
          }else{
            return Text('This Course Is Empty');
          }
        },
      ),
    ),
                  Center(
                    child: Text('user'),
                  ),
                  Center(
                    child: Text('Security'),
                  ),
                  Center(
                    child: Text('Message'),
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
                    icon: Icon(Icons.insert_drive_file),
                    title: Text('Marirals')),
                FancyBottomNavigationItem(
                    icon: Icon(Icons.filter_frames), title: Text('Assignment')),
                FancyBottomNavigationItem(
                    icon: Icon(Icons.grade), title: Text('Grades')),
                FancyBottomNavigationItem(
                    icon: Icon(Icons.mode_edit), title: Text('Updates')),
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
              color: activeColor,
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
