import 'package:flutter/material.dart';
import 'ChatContent.dart';

class InstructorListChat extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    createTile(Friend friend) => InkWell(
      onTap: (){
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => instructorChat()),
        );
      },

      child: Container(
            decoration: const BoxDecoration(
              border: Border(
                bottom: BorderSide(color: Color(0xfff263238), width: 1.0),
              ),
            ),
            child: Padding(
              padding: const EdgeInsets.symmetric(vertical: 10.0),
              child: Row(
                children: <Widget>[
                  Padding(
                    padding: const EdgeInsets.fromLTRB(0.0, 6.0, 16.0, 6.0),
                    child: Container(
                      width: 50.0,
                      height: 50.0,
                      decoration: BoxDecoration(
                        color: Colors.transparent,
                        image: DecorationImage(
                            image: AssetImage('Images/01.png'),
                            fit: BoxFit.cover),
                        borderRadius: BorderRadius.circular(50.0),
                      ),
                    ),
                  ),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: <Widget>[
                        Row(
                          crossAxisAlignment: CrossAxisAlignment.end,
                          children: <Widget>[
                            Text(
                              friend.name,
                              style: TextStyle(
                                color: Colors.white,
                                fontSize: 18.0,
                              ),
                            ),
                            SizedBox(width: 6.0),
                            Text(
                              friend.msgTime,
                              style: TextStyle(
                                color: Colors.white30,
                              ),
                            ),
                          ],
                        ),
                        SizedBox(height: 10.0),
                        Text(
                          friend.message,
                          style: TextStyle(
                            color: Colors.white70,
                            fontSize: 16.0,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
    );

    final liste = SingleChildScrollView(
      scrollDirection: Axis.vertical,
      physics: const BouncingScrollPhysics(),
      child: Padding(
        padding: const EdgeInsets.only(left: 20.0, right: 20.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: friends.map((book) => createTile(book)).toList(),
        ),
      ),
    );

    return Scaffold(
      backgroundColor: Color(0xfff263238),
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),

        automaticallyImplyLeading: true,
      ),

      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          Padding(
            padding: EdgeInsets.fromLTRB(20.0, 40.0, 20.0, 20.0),
            child: Text(
              'Chats',
              style: TextStyle(
                color: Colors.white,
                fontSize: 26.0,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.fromLTRB(20.0, 0.0, 20.0, 10.0),
            child: Text(
              'Recent Messages',
              style: TextStyle(
                color: Colors.white,
                fontSize: 18.0,
              ),
            ),
          ),
          Flexible(
            child: liste,
          ),
        ],
      ),
    );
  }
}


class Friend {
  String name, message, msgTime;
  Image image;

  Friend(this.name, this.image, this.message, this.msgTime);
}

final List<Friend> friends = [
  Friend('Mohamed Essam', Image(image: AssetImage('Images/01.png')),
      'Hello, how are you?', '1 hr.'),
  Friend('Anas hassan', Image(image: AssetImage('Images/01.png')),
      'Hello, how are you?', '1 hr.'),

];
