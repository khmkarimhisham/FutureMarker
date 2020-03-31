<?php

include "db.php";
$error_message = "";
$res = false;

 $user_type = $_POST["typeuser"];
 $firstname = $_POST["firstname"];
 $lastname = $_POST["lastname"];
 $email = $_POST["email"];
 $password = $_POST["password"];
 
   
  $query = mysqli_query($db_connection, "INSERT INTO `user`(`Email`, `Password`, `User_type`) VALUES ('$email','$password', '$user_type');");
        if ($query) {
            $result = mysqli_query($db_connection, "SELECT `User_ID` FROM `user` WHERE `Email` = '$email'");
           
           
            if ($result->num_rows > 0) {
                $id = ($result->fetch_assoc())["User_ID"];
                if ($user_type == "instructor") {
                    $query2 = mysqli_query($db_connection, "INSERT INTO `instructor`(`Instructor_ID`, `Instructor_firstname`, `Instructor_lastname`, `Instructor_email`, `Instructor_image`) VALUES ('$id','$firstname','$lastname','$email', 'images/user.png');");
                    $res = $query2;
                   
                } else if ($user_type == "student") {
                    $query2 = mysqli_query($db_connection, "INSERT INTO `student`(`Student_ID`, `Student_firstname`, `Student_lastname`, `Student_email`, `Student_image`) VALUES ('$id','$firstname','$lastname','$email', 'images/user.png');");
                    $res = $query2;
                    
                }
                
            }


}
echo json_encode($res);
?>
