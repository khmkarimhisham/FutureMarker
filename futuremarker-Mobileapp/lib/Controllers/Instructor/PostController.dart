import 'package:flutter/material.dart';
import 'dart:io';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class Post{

  String URL='http://192.168.1.29:8000/api';

  var status ;
  var token ;



  void createPost(String Post,int id) async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key ) ?? 0;

    String myUrl = "$URL/createPost/${id}";
    http.post(myUrl,
        headers: {
          'Accept':'application/json',
          'Authorization' : 'Bearer $value'
        },
        body: {
          "post_content":"$Post",


        }).then((response){
      status = response.body.contains('error');
      print('Response status : ${response.statusCode}');
      print('Response body : ${response.body}');
    });
  }
  void createComment(String Comment,int id) async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key ) ?? 0;

    String myUrl = "$URL/createComment/${id}";
    http.post(myUrl,
        headers: {
          'Accept':'application/json',
          'Authorization' : 'Bearer $value'
        },
        body: {
          "comment_content":"$Comment",


        }).then((response){
      status = response.body.contains('error');
      print('Response status : ${response.statusCode}');
      print('Response body : ${response.body}');
    });
  }
}