import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';

class User{
  String URL='http://192.168.1.7:8000/api';

  var status ;
  var token ;

  Future getUser(int id) async{
    String myUrl = "$URL/getuser/${id}";
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key) ?? 0;
    http.Response response = await http.get(myUrl,
        headers: {
          'Accept':'application/json',
          'Authorization' : 'Bearer $value'
        });
    print(json.decode(response.body));
    return json.decode(response.body);

  }

}