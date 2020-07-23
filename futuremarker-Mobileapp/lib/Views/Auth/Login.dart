import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Views/Instructor/Home.dart';
import 'package:futuremarkerapp/Views/Student/SHome.dart';
import 'package:futuremarkerapp/Views/Student/SProfile.dart';

import 'package:google_fonts/google_fonts.dart';

import 'package:futuremarkerapp/Views/Auth/Signup.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:futuremarkerapp/Controllers/Auth/AuthController.dart';

import '../Widget/bezierContainer.dart';

class LoginPage extends StatefulWidget {
  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  read() async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final Ekey = 'email';
    final Pkey = 'password';

    final value = prefs.get(key) ?? 0;
    final Evalue = prefs.get(Ekey) ?? 0;
    final Pvalue = prefs.get(Pkey) ?? 0;


    if (value != 0) {
      sendData
          .loginData(Evalue,Pvalue).then((onValue){
        if(onValue['token']!= 0){
          sendData.save(onValue['token'],_emailController.text.trim(), _passwordController.text.trim());
          if(onValue['role']==1){
            Navigator.push(context,
                MaterialPageRoute(builder: (context) => InstructorHome()));
          }else{
            Navigator.push(context,
                MaterialPageRoute(builder: (context) => StudentHome()));
          }
        }
      });

    }
  }

  @override
  initState() {
    read();
  }

  SendData sendData = new SendData();
  TextEditingController _emailController = TextEditingController();
  TextEditingController _passwordController = TextEditingController();
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  String _email = '';
  String _password = '';
  bool visibility = true;
  String errmessage = "";

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
        'log in',
        style: TextStyle(fontSize: 20, color: Colors.white),
      ),
    );
  }

  Widget _createAccountLabel() {
    return InkWell(
      onTap: () {
        Navigator.push(
            context, MaterialPageRoute(builder: (context) => SignUpPage()));
      },
      child: Container(
        margin: EdgeInsets.symmetric(vertical: 20),
        padding: EdgeInsets.all(15),
        alignment: Alignment.bottomCenter,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Text(
              'Don\'t have an account ?',
              style: TextStyle(fontSize: 13, fontWeight: FontWeight.w600),
            ),
            SizedBox(
              width: 10,
            ),
            Text(
              'Register',
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
              top: -height * .15,
              right: -MediaQuery.of(context).size.width * .4,
              child: BezierContainer()),
          Container(
            padding: EdgeInsets.symmetric(horizontal: 20),
            child: SingleChildScrollView(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  SizedBox(height: height * .2),
                  _title(),
                  SizedBox(height: 50),
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
                              if (value.length >= 5 &&
                                      value.contains('@gmail.com') ||
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
                          height: 15.0,
                        ),
                        Center(
                          child: Text(
                            errmessage,
                            style: TextStyle(fontSize: 16, color: Colors.red),
                          ),
                        ),
                      ],
                    ),
                  ),
                  SizedBox(height: 20),
                  InkWell(onTap: () => _LogIn(), child: _submitButton()),
                  Container(
                    padding: EdgeInsets.symmetric(vertical: 10),
                    alignment: Alignment.centerRight,
                    child: Text('Forgot Password ?',
                        style: TextStyle(
                            fontSize: 14, fontWeight: FontWeight.w500)),
                  ),
                  SizedBox(height: height * .055),
                  InkWell(
                      onTap: () {
                        Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => SignUpPage()));
                      },
                      child: _createAccountLabel()),
                ],
              ),
            ),
          ),
        ],
      ),
    ));
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

  void _showDialog() {
    showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: new Text('Failed'),
            content: new Text('Check your email or password'),
            actions: <Widget>[
              new RaisedButton(
                child: new Text(
                  'Close',
                ),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
            ],
          );
        });
  }


  _LogIn() {
    var key = _formKey.currentState;
    if (key.validate()) {
      key.save();

      setState(() {
        sendData
            .loginData(
                _emailController.text.trim(), _passwordController.text.trim()).then((onValue){
//                  onValue = {'token': 00000, 'email'::000}
          if(onValue['token']!= 0){
            sendData.save(onValue['token'],_emailController.text.trim(), _passwordController.text.trim());
            if(onValue['role']==1){
            Navigator.push(context,
                MaterialPageRoute(builder: (context) => InstructorHome()));
            }else{
              Navigator.push(context,
                  MaterialPageRoute(builder: (context) => StudentHome()));
            }
          }
        });
//            .whenComplete(() {
////          if (sendData.status) {
////            _showDialog();
////            errmessage = 'Check email or password';
////          } else {
//            Navigator.push(context,
//                MaterialPageRoute(builder: (context) => InstructorHome()));
//
//
//            print(_emailController.text);
//
////          }
//        })
        ;
      });
    }
  }
}
