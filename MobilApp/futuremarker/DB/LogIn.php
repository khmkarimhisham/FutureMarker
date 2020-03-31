<?php
include "db.php";
$error_message = "";
$res = false;



    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = mysqli_query($db_connection, "SELECT * FROM `user` WHERE `Email`='$email' AND `Password` = '$password';");
   
    $result=array();
 while ($row = mysqli_fetch_assoc($query)){
     $result[]=$row;
 }
    
echo json_encode($result);

?>