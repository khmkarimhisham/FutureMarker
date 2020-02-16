<?php
require 'db.php';
if(isset($_POST['user_email']) && isset($_POST['user_password'])){
    if($_POST['myList']=="1"){
    $email=$_POST['user_email'];
    $password=$_POST['user_password'];
    $query= mysqli_query($db_connection,"SELECT `Instructor_Email`, `Instructor_password` FROM `instructor` WHERE `Instructor_Email`='$email' AND `Instructor_password` = '$password' ");
    $row = mysqli_fetch_assoc($query);
   
    if(isset($row)){
        header('Location: Home.php');
    }else{
    echo 'failure';
    }
    }elseif($_POST['myList']=="2"){
        $email=$_POST['user_email'];
        $password=$_POST['user_password'];
        $query= mysqli_query($db_connection,"SELECT `Student_Email`, `Student_password` FROM `student` WHERE `Student_Email`='$email' AND `Student_password` = '$password' ");
        $row = mysqli_fetch_assoc($query);
        if(isset($row)){
            header('Location: Home.php');
        }else{
        echo 'failure';
        }
    }else{
        echo 'i can`t recognize you';
    }
}

?>
