import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';


class SendData {

  String URL='http://192.168.1.24:8000/api';

  var status ;
  var token ;


  registerData(int role,String name ,String email , String password) async{

    String FullUrl = "$URL/register";
    final response = await  http.post(FullUrl,
        headers: _SetHeader(),
        body: {
          "role":"$role",
          "name": "$name",
          "email": "$email",
          "password" : "$password"
        } ) ;
    status = response.body.contains('error');

    var data = json.decode(response.body);

    if(status){
      print('data : ${data["error"]}');
    }else{
      print('data : ${data["token"]}');
      _save(data["token"]);
    }

  }
  loginData(String email , String password) async{

    String FullUrl = "$URL/login";
    final response = await  http.post(FullUrl,
        headers: _SetHeader(),
        body: {
          "email": "$email",
          "password" : "$password"
        } ) ;
    status = response.body.contains('error');

    var data = json.decode(response.body);

    if(status){
      print('data : ${data["error"]}');
    }else{
      print('data : ${data["token"]}');
      _save(data["token"]);
    }

  }
  _SetHeader() => {

     'Accept':'application/json',

  };

  _save(String token) async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = token;
    prefs.setString(key, value);
  }

  read() async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key ) ?? 0;
    print('read : $value');
  }

}
