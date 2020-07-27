import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Instructor/ProfileController.dart';
import 'Instructor_Drawer.dart';
import 'package:futuremarkerapp/Controllers/Instructor/UserDataConrtoller.dart';

class I_userProfile extends StatelessWidget {
  int userID;
  String name;
  I_userProfile(this.userID,this.name);
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0xfff263238),
      appBar: AppBar(
        backgroundColor: Color(0xfff263238),
        title: Text('${name}'),
        automaticallyImplyLeading: false,
      ),
      drawer: MyDrawer(),
      body: SafeArea(
          child: SingleChildScrollView(
            child: Stack(
              children: <Widget>[

                FutureBuilder(
                    future: User().getUser(userID),
                    builder: (BuildContext context, AsyncSnapshot ss) {
                      if (ss.hasError) {
                        print('error');
                      }
                      if (ss.hasData) {
                        Map myData = ss.data['usrProfile'];
                        List mycourse = ss.data['courses'];
                        // print(mycourse);
//                        int i=0;
//                        while( i<=mycourse.length){
//                          i++;
//                        }

                        return
                          Column(
                            children: <Widget>[
                              _buildProfile(
                                name: '${myData['name']}',
                                email: '${myData['email']}',
                                phone: '${myData['phone']}',
                                bio: '${myData['bio']}',
                                image: '${myData['image']}',
                              ),
                              Container(
                                padding: EdgeInsets.all(10),
                                child: Column(
                                  children: <Widget>[
                                    Card(
                                      child: Container(
                                        decoration: BoxDecoration(
                                            color: Color(0xfff263238)),
                                        alignment: Alignment.topLeft,
                                        padding: EdgeInsets.all(15),
                                        child: Column(
                                          children: <Widget>[
                                            Container(
                                              alignment: Alignment.topLeft,
                                              child: Text(
                                                "${name}'s Courses",
                                                style: TextStyle(
                                                  color: Colors.white,
                                                  fontWeight: FontWeight.w500,
                                                  fontSize: 16,
                                                ),
                                                textAlign: TextAlign.left,
                                              ),
                                            ),
                                            Divider(
                                              color: Colors.black38,
                                            ),
                                            Container(
                                              child: ListView.builder(
                                                  scrollDirection: Axis.vertical,
                                                  shrinkWrap: true,
                                                  padding: const EdgeInsets.all(16),
                                                  itemCount: mycourse.length,
                                                  itemBuilder: (context, i) {
                                                    return ListTile(
                                                      contentPadding:
                                                      EdgeInsets.symmetric(
                                                          horizontal: 12,
                                                          vertical: 4),
                                                      leading: Image(
                                                        image: NetworkImage(
                                                            '${UserData().imageurl}/${mycourse[i]['course_image']}'),
                                                        width: 100.0,
                                                        height: 100.0,
                                                      ),
                                                      title: Text(
                                                        "${mycourse[i]['course_name']}",
                                                        style: TextStyle(
                                                          color: Colors.white,
                                                          fontWeight:
                                                          FontWeight.w500,
                                                          fontSize: 16,
                                                        ),
                                                      ),
                                                    );
                                                  }),
                                            )
                                          ],
                                        ),
                                      ),
                                    )
                                  ],
                                ),
                              ),
                            ],
                          );
                      } else {
                        return _buildProfile();
                      }
                    }),
                Positioned(
                  top: 30,
                  right: 20,
                  child: InkWell(
                    onTap: () {
                      {}
                    },
                    child: Icon(
                      Icons.message,
                      color: Colors.white,
                      size: 35,
                    ),
                  ),
                ),
              ],
            ),

          )),
    );
  }

  _buildProfile({
    String name,
    String email,
    String bio,
    String phone,
    String image,
  }) {
    return Column(
      children: <Widget>[
        Padding(
          padding: const EdgeInsets.only(top: 20.0),
          child: Center(
            child: Container(
              height: 200,
              alignment: Alignment.center,
              child: CircleAvatar(
                radius: 100,
                backgroundImage: image != null
                    ? NetworkImage('${UserData().imageurl}/$image')
                    : ExactAssetImage('Images/avatar.jpg'),
              ),
            ),
          ),
        ),
        Container(
          padding: EdgeInsets.all(10),
          child: Column(
            children: <Widget>[
              Card(
                child: Container(
                  decoration: BoxDecoration(color: Color(0xfff263238)),
                  alignment: Alignment.topLeft,
                  padding: EdgeInsets.all(15),
                  child: Column(
                    children: <Widget>[
                      Container(
                        alignment: Alignment.topLeft,
                        child: Text(
                          "User Information",
                          style: TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.w500,
                            fontSize: 16,
                          ),
                          textAlign: TextAlign.left,
                        ),
                      ),
                      Divider(
                        color: Colors.black38,
                      ),
                      Container(
                          child: Column(
                            children: <Widget>[
                              ListTile(
                                contentPadding: EdgeInsets.symmetric(
                                    horizontal: 12, vertical: 4),
                                leading: Icon(
                                  Icons.person,
                                  color: Colors.white,
                                ),
                                title: Text(
                                  "Name",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                                subtitle: Text(
                                  name == null ? 'User' : "$name",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                              ),
                              ListTile(
                                leading: Icon(
                                  Icons.email,
                                  color: Colors.white,
                                ),
                                title: Text(
                                  "Email",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                                subtitle: Text(
                                  email == null ? 'Future@gmail.com' : "$email",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                              ),
                              ListTile(
                                leading: Icon(
                                  Icons.phone,
                                  color: Colors.white,
                                ),
                                title: Text(
                                  "Phone",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                                subtitle: Text(
                                  phone == 'null' ? '000-000000000' : "$phone",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                              ),
                              ListTile(
                                leading: Icon(
                                  Icons.person,
                                  color: Colors.white,
                                ),
                                title: Text(
                                  "About Me",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                                subtitle: Text(
                                  bio == 'null' ? 'this is bio about me' : "$bio",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.w500,
                                    fontSize: 16,
                                  ),
                                ),
                              ),
                            ],
                          ))
                    ],
                  ),
                ),
              )
            ],
          ),
        ),
      ],
    );
  }
}
