import 'dart:async';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';

class ImagePickerApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Sample Imagepicker Widget',
      home: ImagePickerWidget(),
    );
  }
}

class ImagePickerWidget extends StatefulWidget {
  ImagePickerWidget({Key key}) : super(key: key);

  @override
  _ImagePickerWidgetState createState() => _ImagePickerWidgetState();
}

class _ImagePickerWidgetState extends State {

  File _image;
  @override
  void initState() {
    super.initState();
  }

  void open_camera()
  async {
    var image = await ImagePicker.pickImage(source: ImageSource.camera);
    setState(() {
      _image = image;
    });

  }
  void open_gallery()
  async {
    var image = await ImagePicker.pickImage(source: ImageSource.gallery);
    setState(() {
      _image = image;
    });
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(title: Text("Sample Imagepicker Widget"),
          backgroundColor: Colors.black45,),
        body: Center(
          child: Container(
            child: Column(
              children: [
                Container(
                  color: Colors.black12,
                  height: 300.0,
                  width: 900.0,
                  child: _image == null ? Text("Still waiting!") : Image.file(_image),),
                FlatButton(
                  color: Colors.deepOrangeAccent,
                  child: Text("Open Camera", style: TextStyle(color: Colors.white),),
                  onPressed: (){
                    open_camera();
                  },),
                FlatButton(
                  color: Colors.limeAccent,

                  child:Text("Open Gallery", style: TextStyle(color: Colors.black),),
                  onPressed: (){
                    open_gallery();
                  },
                )
              ],
            ),
          ),
        )

    );

  }
}




//import 'dart:io';
//import 'package:async/async.dart';
//import 'package:flutter/cupertino.dart';
//import 'package:flutter/material.dart';
//import 'package:path_provider/path_provider.dart';
//import 'package:http/http.dart' as http;
//import 'dart:math';
//import 'package:path/path.dart';
//import 'package:image/image.dart' as Img;
//
//
//class UploadImage extends StatefulWidget {
//  @override
//  _UploadImageState createState() => _UploadImageState();
//}
//
//class _UploadImageState extends State<UploadImage> {
//
//  File image;
//  var imageName,randomNumber;
//
//  @override
//  Widget build(BuildContext context) {
//    return Scaffold(
//      appBar: AppBar(
//        backgroundColor: Color(0xfff263238),
//        title: Text('Edit Profile'),
//      ),
//      body: ListView(
//        children: <Widget>[
//          Center(
//            child: image == null ? Text('No image selected') : new Image.file(image),
//          ),
//          Row(
//            mainAxisAlignment: MainAxisAlignment.center,
//            children: <Widget>[
//              RaisedButton(
//                child: Icon(Icons.image),
//                onPressed: () =>getImage(),
//              ),
//
//
//            ],
//          ),
//          _submitButton(),
//          Image(
//            image: AssetImage('$imageName'),
//          )
//        ],
//      ),
//    );
//  }
//
//  Future getImage()async{
//    var imageFile = await ImagePicker.pickImage(source: ImageSource.gallery);
//    final tempDir=await getTemporaryDirectory();
//    final path = tempDir.path;
//    var rng = new Random();
//    randomNumber=rng.nextInt(1000000000);
//    imageName="Image_$randomNumber.jpg";
//    Img.Image _image=Img.decodeImage(imageFile.readAsBytesSync());
//    Img.Image smallerImage=Img.copyResize(_image,width: 500);
//    var compressedImage=new File("$path/$imageName")
//      ..writeAsBytesSync(Img.encodeJpg(smallerImage, quality:85));
//
//    setState(() {
//      image=compressedImage;
//    });
//  }
//
////  Future upload (File imageFile)async{
////    var steam = http.ByteStream(DelegatingStream.typed(imageFile.openRead()));
////    var length =await imageFile.length();
////    var uri =Uri.parse("http://192.168.1.9/images/upload_imahe.php");
////    var request = http.MultipartRequest("POST",uri);
////    var multipartfile = http.MultipartFile("image",steam,length,filename: basename(imageFile.path));
////    request.files.add( multipartfile);
////    var response =await request.send();
////
////    if(response.statusCode==200){
////      print("image uploud");
////    }
////    else print('image not uploud');
////  }
//  Widget _submitButton() {
//    return Container(
//      width: 50.0,
//      padding: EdgeInsets.symmetric(vertical: 15),
//      alignment: Alignment.center,
//      decoration: BoxDecoration(
//          borderRadius: BorderRadius.all(Radius.circular(5)),
//          boxShadow: <BoxShadow>[
//            BoxShadow(
//                color: Colors.grey.shade200,
//                offset: Offset(2, 4),
//                blurRadius: 5,
//                spreadRadius: 2)
//          ],
//          gradient: LinearGradient(
//              begin: Alignment.centerLeft,
//              end: Alignment.centerRight,
//              colors: [Color(0xfff263238), Color(0xfff668595)])),
//      child: Text(
//        'Submit',
//        style: TextStyle(fontSize: 20, color: Colors.white),
//      ),
//    );
//  }
//
//}
//
