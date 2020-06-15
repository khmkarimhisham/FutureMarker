import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;

class SendData {
  final String _url = 'http://192.168.1.16:8000/';

  postData(data, apiUrl) async {
    var FullURL = _url + apiUrl;

    return http.post(
      FullURL,
      body: jsonEncode(data),
      //headers: _setHeaders(),
    );
  }

  _setHeaders() => {
        'Content-type': 'application/json',
        'Accept': 'application/json',
      };
}
