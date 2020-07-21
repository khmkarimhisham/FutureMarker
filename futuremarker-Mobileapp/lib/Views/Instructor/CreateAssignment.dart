import 'package:flutter/material.dart';
import 'package:datetime_picker_formfield/datetime_picker_formfield.dart';
import 'package:futuremarkerapp/Controllers/Instructor/AssignmentController.dart';
import 'package:intl/intl.dart';




class CreateAssignment extends StatefulWidget {
  int CourseID;
  CreateAssignment(this.CourseID);
  @override
  _CreateAssignmentState createState() => _CreateAssignmentState();
}

class _CreateAssignmentState extends State<CreateAssignment> {
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
        'Create',
        style: TextStyle(fontSize: 20, color: Colors.white),
      ),
    );
  }
  TextEditingController _dueController = TextEditingController();
  TextEditingController _titleController = TextEditingController();
  TextEditingController _descriptionController = TextEditingController();
  TextEditingController _compileDegreeController = TextEditingController();
  TextEditingController _styleDegreeController = TextEditingController();
  TextEditingController _dynamicTestDegreeController = TextEditingController();
  TextEditingController _featureTestDegreeController = TextEditingController();
  TextEditingController _attemptsController = TextEditingController();
  DateTime datetime;
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  final format = DateFormat("yyyy-MM-dd HH:mm");
  @override
  Widget build(BuildContext context) {
    final height = MediaQuery.of(context).size.height;
    return Scaffold(
        appBar: AppBar(
          backgroundColor: Color(0xfff263238),
          title: Center(child: Text('Create Assignment')),
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
                      Text('Enter The Assignment Information' ,style: TextStyle(fontWeight: FontWeight.bold ,fontSize: 22 ),),
                      SizedBox(height: 50),
                      Form(
                        key: _formKey,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.stretch,
                          children: <Widget>[
                            Padding(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 32.0, vertical: 8.0),
                              child: Column(children: <Widget>[

                                DateTimeField(

                                  decoration: InputDecoration(

                                    hintText: ' DeadLine',
                                  ),
                                  style: TextStyle(
                                      color: Colors.black,
                                      fontSize: 18.0,
                                      fontWeight: FontWeight.bold),
                                  controller: _dueController,
                                  format: format,
                                  onShowPicker: (context, currentValue) async {
                                    final date = await showDatePicker(
                                        context: context,
                                        firstDate: DateTime(1900),
                                        initialDate: currentValue ?? DateTime.now(),
                                        lastDate: DateTime(2100));
                                    if (date != null) {
                                      final time = await showTimePicker(
                                        context: context,
                                        initialTime:
                                        TimeOfDay.fromDateTime(currentValue ?? DateTime.now()),
                                      );
                                     // print(DateTimeField.combine(date, time));
                                      datetime=DateTimeField.combine(date, time);

                                      return DateTimeField.combine(date, time);


                                    } else {
                                      return currentValue;

                                    }

                                  },


                                ),
                              ]),
                            ),
                            Padding(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 32.0, vertical: 8.0),
                              child: TextFormField(
                                style: TextStyle(
                                    color: Colors.black,
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold),
                                decoration: InputDecoration(

                                  hintText: ' Title',
                                ),
                                controller: _titleController,
                                validator: (value) => value.length >= 3
                                    ? null
                                    : 'Name should Contain at least 3 char',
                                onSaved: (value) =>
                                _titleController.text = value,
                              ),
                            ),
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

                                  hintText: ' Description',
                                ),
                                controller: _descriptionController,
                                validator: (value) => value.length >= 20
                                    ? null
                                    : 'Description should Contain at least 20 char',
                                onSaved: (value) =>
                                _descriptionController.text = value,
                              ),
                            ),
                            Padding(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 32.0, vertical: 8.0),
                              child: TextFormField(
                                style: TextStyle(
                                    color: Colors.black,
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold),
                                decoration: InputDecoration(

                                  hintText: ' Compilation Mark',
                                ),
                               // keyboardType: TextInputType.number,
                                controller: _compileDegreeController,
                                validator: (value) => value.length >= 1
                                    ? null
                                    : 'Please Enter The Compilation Mark',
                                onSaved: (value) =>
                                _compileDegreeController.text = value,
                              ),
                            ),
                            Padding(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 32.0, vertical: 8.0),
                              child: TextFormField(
                                style: TextStyle(
                                    color: Colors.black,
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold),
                                decoration: InputDecoration(

                                  hintText: ' Style Mark',
                                ),
                                keyboardType: TextInputType.number,
                                controller: _styleDegreeController,
                                validator: (value) => value.length >= 1
                                    ? null
                                    : 'Please Enter The Style Mark',
                                onSaved: (value) =>
                                _styleDegreeController.text = value,
                              ),
                            ),
                            Padding(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 32.0, vertical: 8.0),
                              child: TextFormField(
                                style: TextStyle(
                                    color: Colors.black,
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold),
                                decoration: InputDecoration(

                                  hintText: 'Dynamic Testing Mark',
                                ),
                                keyboardType: TextInputType.number,
                                controller: _dynamicTestDegreeController,
                                validator: (value) => value.length >= 1
                                    ? null
                                    : 'Please Enter The Dynamic Testing Mark',
                                onSaved: (value) =>
                                _dynamicTestDegreeController.text = value,
                              ),
                            ),
                            Padding(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 32.0, vertical: 8.0),
                              child: TextFormField(
                                style: TextStyle(
                                    color: Colors.black,
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold),
                                decoration: InputDecoration(

                                  hintText: ' Feature Testing Mark',
                                ),
                                keyboardType: TextInputType.number,
                                controller: _featureTestDegreeController,
                                validator: (value) => value.length >= 1
                                    ? null
                                    : 'Please Enter The Feature Testing Mark',
                                onSaved: (value) =>
                                _featureTestDegreeController.text = value,
                              ),
                            ),
                            Padding(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 32.0, vertical: 8.0),
                              child: TextFormField(
                                style: TextStyle(
                                    color: Colors.black,
                                    fontSize: 18.0,
                                    fontWeight: FontWeight.bold),
                                decoration: InputDecoration(

                                  hintText: ' Permissible Attempts',
                                ),
                                keyboardType: TextInputType.number,
                                controller: _attemptsController,
                                validator: (value) => value.length >= 1
                                    ? null
                                    : 'Please Enter The Permissible Attempts',
                                onSaved: (value) =>
                                _attemptsController.text = value,
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
        CAssignment().createAssignment(widget.CourseID, _titleController.text, _descriptionController.text,
            '${datetime}', _compileDegreeController.text, _styleDegreeController.text, _dynamicTestDegreeController.text, _featureTestDegreeController.text,
            _attemptsController.text);

        Navigator.pop(context);
      });
    }
  }
}
