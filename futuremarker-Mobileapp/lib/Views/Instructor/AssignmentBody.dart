import 'package:flutter/material.dart';

class Assignment extends StatefulWidget {
  @override
  _AssignmentState createState() => _AssignmentState();
}

class _AssignmentState extends State<Assignment> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('Assignment Name'),
      ),
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
                  Wrap(

                    children: <Widget>[
                      Text(
                        'Add Two Numbers',
                        style: TextStyle(fontSize: 18),
                      ),

                    ],
                  ),
                  SizedBox(
                    height: 10,
                  ),
                  Text(
                    'Due:14 /12 /2020-12 pm',
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

                  Divider(),
                  Text(
                    'Created At 14 /12 /2020-12 pm',
                    style: TextStyle(fontSize: 12),
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
