<?php
require_once 'db.php';
if(isset($_POST['inst_email']))
{
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $email=$_POST["inst_email"];
    $password=$_POST["password"];
    $id=mysqli_query($db_connection,"SELECT max(Instructor_ID) FROM `instructor`;");
    settype($id ,"integer");
    $id++;
    $query = mysqli_query($db_connection, "INSERT INTO `instructor` (`Instructor_ID`, `Instructor_firstname`, `Instructor_lastname`, `Instructor_Email`, `Instructor_password`, `Instructor_image`) VALUES ('$id', '$firstname', '$lastname', '$email', '$password', NULL);");
   if($query=TRUE){

    header('Location: login.php');
   }else{
       echo "check for query";
   }
}elseif(isset($_POST['std_email'])) {

    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $email=$_POST["std_email"];
    $password=$_POST["password"];
    $id=mysqli_query($db_connection,"SELECT max(Student_ID) FROM `student`;");
    settype($id ,"integer");
    $id++;

    $query = mysqli_query($db_connection, "INSERT INTO `student` (`Student_ID`, `Student_firstname`, `Student_lastname`, `Student_Email`, `Student_password`, `Student_image`) VALUES ($id, '$firstname', '$lastname', '$email', '$password', NULL);");
   if($query=TRUE){

    header('Location: login.php');

        }
    }else{
    echo "the form not posted";
    }
?>