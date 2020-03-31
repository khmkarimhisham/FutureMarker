import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:futuremarker/Authentication/Signup.dart';
import 'package:http/http.dart' as http;


import '../UI/HomePage.dart';

class Login extends StatefulWidget {
  @override
  _LoginState createState() => _LoginState();
}

class _LoginState extends State<Login> {
  TextEditingController _emailController = TextEditingController();
  TextEditingController _passwordController = TextEditingController();
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  String _email = '';
  String _password = '';
  bool visibility = true;
  String message = "";

  // ignore: missing_return
  Future<List> CheckUSER() async {
    var key = _formKey.currentState;
    if (key.validate()) {
      key.save();
    }
    var url = 'http://192.168.1.2/FutureMarker/WebApp/DB/LogIn.php';
    final response = await http.post(url, body: {
      "email": _emailController.text,
      "password": _passwordController.text,
    });
    print(response.body);
    var userdata = json.decode(response.body);
    if (userdata.length == 0) {
      setState(() {
        message = "invaild Email or Password";
      });
    } else {
      if (userdata[0]['User_type'] == 'instructor') {
        Navigator.push(
            context, MaterialPageRoute(builder: (context) => HomePage(userdata[0]['User_ID'],userdata[0]['User_type'])));
      } else if (userdata[0]['User_type'] == 'student') {
        Navigator.push(
            context, MaterialPageRoute(builder: (context) => HomePage(userdata[0]['User_ID'],userdata[0]['User_type'])));
      }
    }
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            const SizedBox(
              height: 200.0,
            ),
            Stack(
              children: <Widget>[
                Padding(
                  padding: const EdgeInsets.only(left: 32.0),
                  child: Text(
                    'Log In',
                    style:
                        TextStyle(fontSize: 35.0, fontWeight: FontWeight.w800),
                  ),
                )
              ],
            ),
            SizedBox(
              height: 40.0,
            ),
            Form(
              key: _formKey,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.stretch,
                children: <Widget>[
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
                      keyboardType: TextInputType.emailAddress,
                      validator: (value) {
                        if (value.length >= 5 && value.contains('@gmail.com') ||
                            value.contains('@hotmail.com') ||
                            value.contains('@outlook.com')) {
                          return null;
                        } else {
                          return 'Email is not valid';
                        }
                      },
                      onSaved: (value) => _email = value,
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
                      onSaved: (value) => _password = value,
                    ),
                  ),
                  SizedBox(
                    height: 10.0,
                  ),
                  SizedBox(
                    height: 30.0,
                  ),
                  Align(
                    alignment: Alignment.center,
                    child: RaisedButton(
                      onPressed: () => CheckUSER(),
                      padding:
                          const EdgeInsets.fromLTRB(40.0, 16.0, 30.0, 16.0),
                      color: Colors.lightBlue,
                      elevation: 0,
                      shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(20.0)),
                      child: Row(
                        mainAxisSize: MainAxisSize.min,
                        children: <Widget>[
                          Text(
                            'Log In'.toUpperCase(),
                            style: TextStyle(
                                color: Colors.black,
                                fontSize: 18.0,
                                fontWeight: FontWeight.bold),
                          )
                        ],
                      ),
                    ),
                  ),
                  SizedBox(
                    height: 15.0,
                  ),
                  Center(
                    child: Text(
                      message,
                      style: TextStyle(fontSize: 16, color: Colors.red),
                    ),
                  ),
                  SizedBox(
                    height: 15.0,
                  ),
                  Center(
                    child: InkWell(
                        onTap: () {
                          Navigator.push(
                              context,
                              MaterialPageRoute(
                                  builder: (context) => SignUp()));
                        },
                        child: Text('Create New Account',
                            style: TextStyle(color: Colors.blueAccent))),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  validating() async {
    var key = _formKey.currentState;
    if (key.validate()) {
      key.save();
    }
  }

  void _onChangedVisibility() {
    setState(() {
      visibility = !visibility;
    });
  }
}
