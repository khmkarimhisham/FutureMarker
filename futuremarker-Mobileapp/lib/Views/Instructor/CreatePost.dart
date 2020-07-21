import 'package:flutter/material.dart';
import 'package:futuremarkerapp/Controllers/Instructor/PostController.dart';



class createPost extends StatefulWidget {
 int CourseID;
 createPost(this.CourseID);
  @override
  _createPostState createState() => _createPostState();
}

class _createPostState extends State<createPost> {
  @override
  void initState() {
    super.initState();
  }


  Widget _submitButton() {
    return Container(
      width: MediaQuery.of(context).size.width,
      padding: EdgeInsets.symmetric(vertical: 15),
      alignment: Alignment.center,
      decoration: BoxDecoration(
          borderRadius: BorderRadius.all(Radius.circular(5)),
          boxShadow: <BoxShadow>[
            BoxShadow(
                color: Colors.grey.shade200,
                offset: Offset(2, 4),
                blurRadius: 5,
                spreadRadius: 2)
          ],
          gradient: LinearGradient(
              begin: Alignment.centerLeft,
              end: Alignment.centerRight,
              colors: [Color(0xfff263238), Color(0xfff668595)])),
      child: Text(
        'Post',
        style: TextStyle(fontSize: 20, color: Colors.white),
      ),
    );
  }
  TextEditingController _PostController = TextEditingController();
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    final height = MediaQuery.of(context).size.height;
    return Scaffold(
        appBar: AppBar(
          backgroundColor: Color(0xfff263238),
          title: Center(child: Text('Create Post')),
          automaticallyImplyLeading: false,



        ),
        body:Container(
          height: height,
          child: Stack(
            children: <Widget>[

              Container(
                padding: EdgeInsets.symmetric(horizontal: 20),
                child: SingleChildScrollView(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: <Widget>[
                      SizedBox(height: 80,),
                      Text('Enter The Post Information' ,style: TextStyle(fontWeight: FontWeight.bold ,fontSize: 22 ),),
                      SizedBox(height: 50),
                      Form(
                        key: _formKey,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.stretch,
                          children: <Widget>[

                            Padding(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 32.0, vertical: 8.0),
                              child: TextFormField(
                                maxLines: 3,
                                style: TextStyle(
                                    color: Colors.black,
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold),
                                decoration: InputDecoration(

                                  hintText: 'Enter Your Post',
                                ),
                                controller: _PostController,
                                validator: (value) => value.length >= 15
                                    ? null
                                    : 'Post should Contain at least 15 char',
                                onSaved: (value) =>
                                _PostController.text = value,
                              ),
                            ),


                          ],
                        ),
                      ),

                      SizedBox(height: 20),
                      InkWell(
                          onTap: (){
                            Create();
                          },
                          child: _submitButton()),


                      SizedBox(height: height * .055),

                    ],
                  ),
                ),
              ),

            ],
          ),
        )
    );
  }
  Create(){
    var key = _formKey.currentState;
    if (key.validate()) {
      key.save();

      setState(() {
       Post().createPost(_PostController.text, widget.CourseID);

        Navigator.pop(context);
      });
    }
  }
}
