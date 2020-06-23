import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';


class UserData{

  String URL='http://192.168.1.3:8000/api';
  String imageurl='http://192.168.1.3:8000';

  var status ;
  var token ;

  Future getData() async{
    String FullUrl = "$URL/userData";
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key) ?? 0;

    http.Response response = await http.get(FullUrl,
        headers: {
          'Accept':'application/json',
          'Authorization' : 'Bearer $value'
        });
    print(json.decode(response.body));
    return json.decode(response.body);
  }
  read() async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key ) ?? 0;
    print('read : $value');
  }

}
