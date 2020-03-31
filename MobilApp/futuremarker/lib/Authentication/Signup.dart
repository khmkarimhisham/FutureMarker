import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:futuremarker/Authentication/Login.dart';
import 'package:futuremarker/UI/HomePage.dart';
import 'package:http/http.dart' as http;



class SignUp extends StatefulWidget {
  @override
  _SignUpState createState() => _SignUpState();
}
class Item {
  const Item(this.name,this.icon);
  final String name;
  final Icon icon;
}
class _SignUpState extends State<SignUp> {
  bool visable=false;

  TextEditingController _firstnameController = TextEditingController();
  TextEditingController _lastnameController = TextEditingController();
  TextEditingController _emailController = TextEditingController();
  TextEditingController _passwordController = TextEditingController();
  TextEditingController _confirmpasswordController = TextEditingController();

  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  String _firstname = '';String _lastname = '';String _email = '';
  String _password = '';String _confirmpassword = '';

  bool visibility = true;
  bool visibilityconfirm = true;
  Item selectedUser;
  var message;
  String errmessage=' ';
  List<Item> users = <Item>[
    const Item('instructor',Icon(Icons.person,color: Colors.lightBlue, )),
    const Item('student',Icon(Icons.person,color: Colors.lightBlue , )),
  ];
   Future insertUser()async{
     var key = _formKey.currentState;
     if (key.validate()) {
       key.save();
     }
     String firstname=_firstnameController.text;
     String lastname=_lastnameController.text;
     String email=_emailController.text;
     String password=_passwordController.text;
     String typeuser=selectedUser.name;

     var url='http://192.168.1.2/FutureMarker/WebApp/DB/Signup.php';
     var data={'firstname':firstname,'lastname':lastname,'email':email,'password':password,'typeuser':typeuser};
     var response = await http.post(url, body: data);

     // If Web call Success than Hide the CircularProgressIndicator.
     if(response.statusCode == 200){
       setState(() {
         message = jsonDecode(response.body);
       });
       print(message);
     }else print('error');


     if(message){
       Navigator.push(
           context, MaterialPageRoute(builder: (context) => Login()));
     }else{
       setState(() {
         errmessage = "invaild Email or Password";
       });

     }
   }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      // backgroundColor: Color(0xFF0f2031),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            const SizedBox(height: 90.0,),
            Stack(
              children: <Widget>[

                Padding(
                  padding: const EdgeInsets.only(left: 32.0),
                  child: Text('Sign Up', style: TextStyle(
                      fontSize: 35.0, fontWeight: FontWeight.w800),),
                )
              ],
            ),
            SizedBox(height: 40.0,),
            Form(
              key: _formKey,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.stretch,
                children: <Widget>[
                  Padding(padding: const EdgeInsets.symmetric(horizontal: 32.0,vertical: 8.0),
                    child: Center(
                      child: DropdownButton<Item>(
                        hint:  Text("Select User Type",style: TextStyle(color: Colors.black,fontSize: 20.0,fontWeight: FontWeight.bold),),
                        value: selectedUser,

                        onChanged: (Item Value) {
                          setState(() {
                            selectedUser = Value;
                          });
                        },
                        items: users.map((Item user) {
                          return  DropdownMenuItem<Item>(
                            value: user,
                            child: Row(
                              children: <Widget>[
                                user.icon,
                                SizedBox(width: 10,),
                                Text(
                                  user.name,
                                  style:  TextStyle(color: Colors.black),
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
                    padding:const EdgeInsets.symmetric(horizontal: 32.0, vertical: 8.0),
                    child: TextFormField(
                      style: TextStyle(color: Colors.black,fontSize: 18.0,fontWeight: FontWeight.bold),
                      decoration: InputDecoration(
                        // border: OutlineInputBorder(borderSide: BorderSide.none),
                        icon: Icon(Icons.person, color: Colors.black),
                        hintText: 'First Name',
                      ),
                      controller: _firstnameController,
                      validator: (value) =>
                      value.length >= 3 ? null : 'Name should Contain at least 3 char',
                      onSaved: (value) => _firstname = value,
                    ),
                  ),
                  SizedBox(
                    height: 10.0,
                  ),
                  Padding(
                    padding:const EdgeInsets.symmetric(horizontal: 32.0, vertical: 8.0),
                    child: TextFormField(
                      style: TextStyle(color: Colors.black,fontSize: 18.0,fontWeight: FontWeight.bold),
                      decoration: InputDecoration(
                        // border: OutlineInputBorder(borderSide: BorderSide.none),
                        icon: Icon(Icons.person, color: Colors.black),
                        hintText: 'Last Name',
                      ),
                      controller: _lastnameController,
                      validator: (value) =>
                      value.length >= 3 ? null : 'Name should Contain at least 3 char',
                      onSaved: (value) => _lastname = value,
                    ),
                  ),
                  SizedBox(
                    height: 10.0,
                  ),
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 32.0, vertical: 8.0),
                    child:TextFormField(
                      style: TextStyle(color: Colors.black,fontSize: 18.0,fontWeight: FontWeight.bold),
                      decoration: InputDecoration(
                        // border: OutlineInputBorder(borderSide: BorderSide.none),
                        icon: Icon(Icons.email, color: Colors.black),
                        hintText: 'Email',
                      ),
                      controller: _emailController,
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
                    padding:const EdgeInsets.symmetric(horizontal: 32.0, vertical: 8.0),
                    child: TextFormField(
                      controller: _passwordController,
                      style: TextStyle(color: Colors.black,fontSize: 18.0,fontWeight: FontWeight.bold),
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
                  Padding(
                    padding:const EdgeInsets.symmetric(horizontal: 32.0, vertical: 8.0),
                    child:TextFormField(
                      controller: _confirmpasswordController,
                      style: TextStyle(color: Colors.black,fontSize: 18.0,fontWeight: FontWeight.bold),
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
                      onSaved: (value) => _confirmpassword = value,
                    ),
                  ),
                  SizedBox(
                    height: 30.0,
                  ),
                  Align(
                    alignment: Alignment.center,
                    child: RaisedButton(onPressed: () => insertUser(),
                      padding: const EdgeInsets.fromLTRB(40.0, 16.0, 30.0, 16.0),
                      color: Colors.lightBlue,
                      elevation: 0,
                      shape: RoundedRectangleBorder(
                       borderRadius: BorderRadius.circular(20.0)
                      ),
                    child: Row(
                      mainAxisSize: MainAxisSize.min,
                      children: <Widget>[
                        Text('Sign Up'.toUpperCase(),style:TextStyle(color: Colors.black,fontSize: 18.0,fontWeight: FontWeight.bold),)
                      ],
                    ),
                    ),
                  ),

                 SizedBox(height: 15.0,),
                  Center(
                    child: Text(
                      errmessage,
                      style: TextStyle(fontSize: 16, color: Colors.red),
                    ),
                  ),
                  SizedBox(
                    height: 15.0,
                  ),
                  Center(
                    child:InkWell(
                        onTap: () {
                          Navigator.push(context,
                              MaterialPageRoute(builder: (context) => Login()));

                        },
                        child: Text('have a account? Login',
                            style: TextStyle(color: Colors.blueAccent))),
                  ),

                ],
              ),
            ),
          ],),
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

