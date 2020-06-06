import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Views/Widget/bezierContainer.dart';

import 'package:google_fonts/google_fonts.dart';

import 'package:futuremarkerapp/Views/Auth/Login.dart';

class SignUpPage extends StatefulWidget {
  @override
  _SignUpPageState createState() => _SignUpPageState();
}

class Item {
  const Item(this.name, this.icon);
  final String name;
  final Icon icon;
}

class _SignUpPageState extends State<SignUpPage> {
  bool visable = false;

  TextEditingController _nameController = TextEditingController();
  TextEditingController _emailController = TextEditingController();
  TextEditingController _passwordController = TextEditingController();
  TextEditingController _confirmpasswordController = TextEditingController();

  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  bool visibility = true;
  bool visibilityconfirm = true;
  Item selectedUser;
  var message;
  String errmessage = ' ';
  List<Item> users = <Item>[
    const Item(
        'Instructor',
        Icon(
          Icons.person,
          color: Colors.black,
        )),
    const Item(
        'Student',
        Icon(
          Icons.person,
          color: Colors.black,
        )),
  ];

  Widget _submitButton() {
    return Container(
      width: MediaQuery.of(context).size.width,
      padding: EdgeInsets.symmetric(vertical: 15),
      alignment: Alignment.center,
      decoration: BoxDecoration(
          borderRadius: BorderRadius.all(Radius.circular(5)),
          boxShadow: <BoxShadow>[
            BoxShadow(
                color: Colors.grey.shade200,
                offset: Offset(2, 4),
                blurRadius: 5,
                spreadRadius: 2)
          ],
          gradient: LinearGradient(
              begin: Alignment.centerLeft,
              end: Alignment.centerRight,
              colors: [Color(0xfff263238), Color(0xfff668595)])),
      child: Text(
        'Register Now',
        style: TextStyle(fontSize: 20, color: Colors.white),
      ),
    );
  }

  Widget _loginAccountLabel() {
    return InkWell(
      onTap: () {
        Navigator.push(
            context, MaterialPageRoute(builder: (context) => LoginPage()));
      },
      child: Container(
        margin: EdgeInsets.symmetric(vertical: 20),
        padding: EdgeInsets.all(15),
        alignment: Alignment.bottomCenter,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Text(
              'Already have an account ?',
              style: TextStyle(fontSize: 13, fontWeight: FontWeight.w600),
            ),
            SizedBox(
              width: 10,
            ),
            Text(
              'Login',
              style: TextStyle(
                  color: Color(0xfff79c4f),
                  fontSize: 13,
                  fontWeight: FontWeight.w600),
            ),
          ],
        ),
      ),
    );
  }

  Widget _title() {
    return RichText(
      textAlign: TextAlign.center,
      text: TextSpan(
          text: 'F',
          style: GoogleFonts.portLligatSans(
            textStyle: Theme.of(context).textTheme.display1,
            fontSize: 30,
            fontWeight: FontWeight.w700,
            color: Color(0xffe46b10),
          ),
          children: [
            TextSpan(
              text: 'uture',
              style: TextStyle(color: Colors.black, fontSize: 30),
            ),
            TextSpan(
              text: 'M',
              style: GoogleFonts.portLligatSans(
                textStyle: Theme.of(context).textTheme.display1,
                fontSize: 30,
                fontWeight: FontWeight.w700,
                color: Color(0xffe46b10),
              ),
            ),
            TextSpan(
              text: 'arker',
              style: TextStyle(color: Colors.black, fontSize: 30),
            ),
          ]),
    );
  }

  @override
  Widget build(BuildContext context) {
    final height = MediaQuery.of(context).size.height;
    return Scaffold(
      body: Container(
        height: height,
        child: Stack(
          children: <Widget>[
            Positioned(
              top: -MediaQuery.of(context).size.height * .15,
              right: -MediaQuery.of(context).size.width * .4,
              child: BezierContainer(),
            ),
            Container(
              padding: EdgeInsets.symmetric(horizontal: 20),
              child: SingleChildScrollView(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    SizedBox(height: height * .2),
                    _title(),
                    SizedBox(
                      height: 50,
                    ),
                    //  _emailPasswordWidget(),
                    Form(
                      key: _formKey,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: <Widget>[
                          Padding(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 32.0, vertical: 8.0),
                            child: Center(
                              child: DropdownButton<Item>(
                                hint: Text(
                                  "Select User Type",
                                  style: TextStyle(
                                      color: Colors.black,
                                      fontSize: 20.0,
                                      fontWeight: FontWeight.bold),
                                ),
                                value: selectedUser,
                                onChanged: (Item Value) {
                                  setState(() {
                                    selectedUser = Value;
                                  });
                                },
                                items: users.map((Item user) {
                                  return DropdownMenuItem<Item>(
                                    value: user,
                                    child: Row(
                                      children: <Widget>[
                                        user.icon,
                                        SizedBox(
                                          width: 10,
                                        ),
                                        Text(
                                          user.name,
                                          style: TextStyle(color: Colors.black),
                                        ),
                                      ],
                                    ),
                                  );
                                }).toList(),
                              ),
                            ),
                          ),
                          SizedBox(
                            height: 10.0,
                          ),
                          Padding(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 32.0, vertical: 8.0),
                            child: TextFormField(
                              style: TextStyle(
                                  color: Colors.black,
                                  fontSize: 18.0,
                                  fontWeight: FontWeight.bold),
                              decoration: InputDecoration(
                                // border: OutlineInputBorder(borderSide: BorderSide.none),
                                icon: Icon(Icons.person, color: Colors.black),
                                hintText: 'Name',
                              ),
                              controller: _nameController,
                              validator: (value) => value.length >= 3
                                  ? null
                                  : 'Name should Contain at least 3 char',
                              onSaved: (value) =>
                                  _nameController.text = value,
                            ),
                          ),
                          SizedBox(
                            height: 10.0,
                          ),

                          Padding(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 32.0, vertical: 8.0),
                            child: TextFormField(
                              style: TextStyle(
                                  color: Colors.black,
                                  fontSize: 18.0,
                                  fontWeight: FontWeight.bold),
                              decoration: InputDecoration(
                                // border: OutlineInputBorder(borderSide: BorderSide.none),
                                icon: Icon(Icons.email, color: Colors.black),
                                hintText: 'Email',
                              ),
                              controller: _emailController,
                              validator: (value) {
                                if (value.length >= 5 &&
                                        value.contains('@gmail.com') ||
                                    value.contains('@hotmail.com') ||
                                    value.contains('@outlook.com')) {
                                  return null;
                                } else {
                                  return 'Email is not valid';
                                }
                              },
                              onSaved: (value) => _emailController.text = value,
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 32.0, vertical: 8.0),
                            child: TextFormField(
                              controller: _passwordController,
                              style: TextStyle(
                                  color: Colors.black,
                                  fontSize: 18.0,
                                  fontWeight: FontWeight.bold),
                              decoration: InputDecoration(
                                // border: OutlineInputBorder(borderSide: BorderSide.none),
                                icon: Icon(
                                  Icons.lock_outline,
                                  color: Colors.black,
                                ),
                                suffixIcon: InkWell(
                                    onTap: () {
                                      _onChangedVisibility();
                                    },
                                    child: visibility == false
                                        ? Icon(Icons.remove_red_eye)
                                        : Icon(Icons.visibility_off)),
                                hintText: 'Password',
                              ),
                              obscureText: visibility,
                              validator: (value) {
                                if (value.length == 0) {
                                  return "Password is Required";
                                } else if (value.length < 6) {
                                  return "Password Should be more than 6.";
                                }
                                return null;
                              },
                              onSaved: (value) =>
                                  _passwordController.text = value,
                            ),
                          ),
                          SizedBox(
                            height: 10.0,
                          ),
                          Padding(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 32.0, vertical: 8.0),
                            child: TextFormField(
                              controller: _confirmpasswordController,
                              style: TextStyle(
                                  color: Colors.black,
                                  fontSize: 18.0,
                                  fontWeight: FontWeight.bold),
                              decoration: InputDecoration(
                                // border: OutlineInputBorder(borderSide: BorderSide.none),
                                icon: Icon(
                                  Icons.lock_outline,
                                  color: Colors.black,
                                ),
                                suffixIcon: InkWell(
                                    onTap: () {
                                      _onChangedVisibilityconfirm();
                                    },
                                    child: visibilityconfirm == false
                                        ? Icon(Icons.remove_red_eye)
                                        : Icon(Icons.visibility_off)),
                                hintText: 'Confirm Password',
                              ),
                              obscureText: visibilityconfirm,
                              validator: (value) {
                                if (value.length == 0) {
                                  return "Password is Required";
                                } else if (value != _passwordController.text) {
                                  return 'Password is not matching';
                                }
                                return null;
                              },
                              //   value.length >= 5 ? null : 'Enter a valid password' ,
                              onSaved: (value) =>
                                  _confirmpasswordController.text = value,
                            ),
                          ),

                          SizedBox(
                            height: 15.0,
                          ),
//                          Center(
//                            child: Text(
//                              errmessage,
//                              style: TextStyle(fontSize: 16, color: Colors.red),
//                            ),
//                          ),

                        ],
                      ),
                    ),
                    SizedBox(
                      height: 20,
                    ),
                    _submitButton(),
                    SizedBox(
                      height: 10,
                    ),
                    _loginAccountLabel(),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  void _onChangedVisibility() {
    setState(() {
      visibility = !visibility;
    });
  }

  void _onChangedVisibilityconfirm() {
    setState(() {
      visibilityconfirm = !visibilityconfirm;
    });
  }
}
