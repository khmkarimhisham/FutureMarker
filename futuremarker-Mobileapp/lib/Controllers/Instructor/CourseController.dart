import 'dart:io';
import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class Courses{
  String URL='http://192.168.1.9:8000/api';

  var status ;
  var token ;

  void createCourse(String name , String desc,File image) async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key ) ?? 0;

    String myUrl = "$URL/createCourse";
    http.post(myUrl,
        headers: {
          'Accept':'application/json',
          'Authorization' : 'Bearer $value'
        },
        body: {
          "course_name":"$name",
          "course_desc":"$desc",
          "course_image":"$image"
        }).then((response){
      status = response.body.contains('error');
      print('Response status : ${response.statusCode}');
      print('Response body : ${response.body}');
    });
  }
  Future CourseContent(int id) async{
    String myUrl = "$URL/getContent/${id}";
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