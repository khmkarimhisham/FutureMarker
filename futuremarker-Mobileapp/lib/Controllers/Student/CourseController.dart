import 'dart:io';
import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class Courses{
  String URL='http://192.168.1.29:8000/api';

  var status ;
  var token ;
  void joinCourse(String Access) async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key ) ?? 0;

    String myUrl = "$URL/joinCourse";
    http.post(myUrl,
        headers: {
          'Accept':'application/json',
          'Authorization' : 'Bearer $value'
        },
        body: {
          "course_access_code":"$Access",

        }).then((response){
      status = response.body.contains('error');
      print('Response status : ${response.statusCode}');
      print('Response body : ${response.body}');
    });
  }

  Future CourseContent(int id) async{
    String myUrl = "$URL/SgetContent/${id}";
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