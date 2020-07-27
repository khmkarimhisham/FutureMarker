import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';
import 'package:flutter_pdfview/flutter_pdfview.dart';
import 'package:flutter/src/gestures/tap.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:open_file/open_file.dart';


class XPage extends StatefulWidget {
  @override
  _XPageState createState() => _XPageState();
}

class _XPageState extends State<XPage> {
  @override
  Widget build(BuildContext context) {
    String x = 'http://192.168.1.9/1/x.pdf';
    return Scaffold(
      appBar: AppBar(),
      body: Column(
        children: <Widget>[
          Container(
            color: Colors.red,
            child: new RichText(
              text: new LinkTextSpan(
                  url: 'http://192.168.1.9/1/x.pdf',
                  text: 'Show My Pdf'),
            ),
          ),
          SizedBox(height: 100,),
          GestureDetector(
            child: Text('2'),
            onTap: (){
              OpenFile.open("$x");
            },
          )
        ],
      ),
    );
  }
}
class LinkTextSpan extends TextSpan {
  LinkTextSpan({TextStyle style, String url, String text})
      : super(style: style, text: text ?? url, recognizer: new TapGestureRecognizer()..onTap = () {launch(url);
        });
}