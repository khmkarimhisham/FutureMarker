import 'dart:async';
import 'dart:io';
import 'dart:math';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:path_provider/path_provider.dart';
import 'package:image/image.dart' as img;

class uploadImage{

  File imagePhoto;

  Future<File> open_gallery()
  async {
    var image = await ImagePicker.pickImage(source: ImageSource.gallery);
    final tempDir=await getTemporaryDirectory();
    final path = tempDir.path;
    String name = "${Random().nextInt(1000000)}";
    img.Image theImage = img.decodeJpg(image.readAsBytesSync());
    File finalImage = File('$path/$name.jpg')..writeAsBytesSync(img.encodeJpg(theImage,quality: 50));
    print(finalImage.path);
//    imagePhoto = finalImage;
    return finalImage;
  }


}

