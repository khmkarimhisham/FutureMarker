import 'dart:convert';

import 'package:http/http.dart' as http;

class MyClass{
  Future<List> getData(String userType,String userID) async{
    var url='http://192.168.1.2/FutureMarker/WebApp/DB/getdata.php';
    final response = await http.post(url, body: {
      'usertype' : userType,
      'userID' : userID
    });
    if(response.statusCode == 200){
      return jsonDecode(response.body);
    }else return [];
  }
}