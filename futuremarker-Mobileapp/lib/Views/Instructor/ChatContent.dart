import 'package:flutter/material.dart';
import 'dart:math';



class instructorChat extends StatefulWidget {
  @override
  _instructorChatState createState() => _instructorChatState();
}

class _instructorChatState extends State<instructorChat> {
  @override
  TextEditingController _chatController = TextEditingController();

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0.4,
        iconTheme: IconThemeData(color: Colors.black),
        backgroundColor: Color(0xfff263238),
        title: Row(
          children: <Widget>[
            Container(
              width: 40,
              height: 40,
              margin: EdgeInsets.fromLTRB(0, 5, 10, 0),
              child: CircleAvatar(
                backgroundImage: NetworkImage('https://i.pravatar.cc/110'),
                backgroundColor: Colors.grey[200],
                minRadius: 30,
              ),
            ),
            Column(
              mainAxisAlignment: MainAxisAlignment.center,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: <Widget>[
                Text(
                  'Anas Hassan',
                  style: TextStyle(color: Colors.white),
                ),

              ],
            )
          ],
        ),
      ),
      body: Stack(
        children: <Widget>[
          Container(
            color: Colors.white,
            child: Column(
              children: <Widget>[
                Flexible(
                  child: ListView.builder(
                    itemCount: 1,
                    shrinkWrap: true,
                    itemBuilder: (BuildContext context, int index) {
                      return Padding(
                        padding: EdgeInsets.all(10),
                        child: Column(
                          children: <Widget>[
                            Text(
                              'Today',
                              style:
                              TextStyle(color: Colors.grey, fontSize: 12),
                            ),
                            Bubble(
                              message: 'Hi Essam How are you ?',
                              isMe: true,
                            ),
                            Bubble(
                              message: 'have you seen the App yet? have you seen the App yet? have you seen the App yet?',
                              isMe: true,
                            ),
                            Text(
                              'Sep 25, 2020',
                              style:
                              TextStyle(color: Colors.grey, fontSize: 12),
                            ),
                            Bubble(
                              message: 'i am fine !',
                              isMe: false,
                            ),
                            Bubble(
                              message: 'yes i\'ve seen the App',
                              isMe: false,
                            ),
                            Bubble(
                              message: 'have you seen the App yet? have you seen the App yet? have you seen the App yet?',
                              isMe: false,
                            ),
                            Text(
                              'Sep 27, 2020',
                              style:
                              TextStyle(color: Colors.grey, fontSize: 12),
                            ),
                            Bubble(
                              message: 'have you seen the App yet? have you seen the App yet? have you seen the App yet?',
                              isMe: true,
                            ),
                            Text(
                              'Sep 27, 2020',
                              style:
                              TextStyle(color: Colors.grey, fontSize: 12),
                            ),
                          ],
                        ),
                      );
                    },
                  ),
                ),
              ],
            ),
          ),
          Positioned(
            bottom: 0,
            left: 0,
            width: MediaQuery.of(context).size.width,
            child: Container(
              padding: EdgeInsets.all(10),
              decoration: BoxDecoration(color: Colors.white, boxShadow: [
                BoxShadow(
                  color: Colors.grey[300],
                  offset: Offset(-2, 0),
                  blurRadius: 5,
                ),
              ]),
              child: Row(
                children: <Widget>[

                  Padding(
                    padding: EdgeInsets.only(left: 30),
                  ),
                  Expanded(
                    child: TextFormField(
                      controller: _chatController,
                      textInputAction: TextInputAction.send,
                      keyboardType: TextInputType.text,
                      decoration: InputDecoration(
                        contentPadding: const EdgeInsets.symmetric(vertical: 10.0,horizontal: 20.0),
                        hintText: 'Enter Message',
                        border:OutlineInputBorder(
                          borderSide: BorderSide(color: Color(0xfff263238)),

                          borderRadius: BorderRadius.circular(20.0),
                        ),

                      ),
                      //onEditingComplete: ,
                    ),
                  ),
                  IconButton(
                    onPressed: () {},
                    icon: Icon(
                      Icons.send,
                      color: Color(0xfff263238),
                    ),
                  ),
                ],
              ),
            ),
          )
        ],
      ),
    );
  }
}

class Bubble extends StatelessWidget {
  final bool isMe;
  final String message;

  Bubble({this.message, this.isMe});

  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.all(5),
      padding: isMe ? EdgeInsets.only(left: 40) : EdgeInsets.only(right: 40),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: <Widget>[
          Column(
            mainAxisAlignment:
            isMe ? MainAxisAlignment.end : MainAxisAlignment.start,
            crossAxisAlignment:
            isMe ? CrossAxisAlignment.end : CrossAxisAlignment.start,
            children: <Widget>[
              Container(
                padding: EdgeInsets.all(15),
                decoration: BoxDecoration(
                 color: isMe?Color(0xfff263238):Colors.grey,
                  borderRadius: isMe
                      ? BorderRadius.only(
                    topRight: Radius.circular(15),
                    topLeft: Radius.circular(15),
                    bottomRight: Radius.circular(0),
                    bottomLeft: Radius.circular(15),
                  )
                      : BorderRadius.only(
                    topRight: Radius.circular(15),
                    topLeft: Radius.circular(15),
                    bottomRight: Radius.circular(15),
                    bottomLeft: Radius.circular(0),
                  ),
                ),
                child: Column(
                  crossAxisAlignment:
                  isMe ? CrossAxisAlignment.end : CrossAxisAlignment.start,
                  children: <Widget>[
                    Text(
                      message,
                      textAlign: isMe ? TextAlign.end : TextAlign.start,
                      style: TextStyle(
                        color: Colors.white,
                      ),
                    )
                  ],
                ),
              ),
            ],
          )
        ],
      ),
    );
  }
}