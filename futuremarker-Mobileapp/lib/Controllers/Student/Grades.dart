import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:shared_preferences/shared_preferences.dart';


class Grade{

  String URL='http://192.168.1.29:8000/api';

  var status ;
  var token ;


  Future courseGrade(int id) async{
    String myUrl = "$URL/courseGrade/${id}";
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
  Future Grades() async{
    String myUrl = "$URL/StudentGrade";
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