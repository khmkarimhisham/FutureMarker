import 'package:flutter/material.dart';
import 'dart:io';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';


class CAssignment{

  String URL='http://futuremarker.com/api';

  var status ;
  var token ;

  void createAssignment(int id,String title,String deac,String due,String com,String style,String d,String f ,String p ) async {
    final prefs = await SharedPreferences.getInstance();
    final key = 'token';
    final value = prefs.get(key ) ?? 0;

    String myUrl = "$URL/createAssignment/${id}";
    http.post(myUrl,
        headers: {
          'Accept':'application/json',
          'Authorization' : 'Bearer $value'
        },
        body: {
          "deadline":"$due",
          "title":"$title",
          "description":"$deac",
          "compileDegree":"$com",
          "styleDegree":"$style",
          "dynamicTestDegree":"$d",
          "featureTestDegree":"$f",
          "attempts":"$p"

        }).then((response){
      status = response.body.contains('error');
      print('Response status : ${response.statusCode}');
      print('Response body : ${response.body}');
    });
  }
}