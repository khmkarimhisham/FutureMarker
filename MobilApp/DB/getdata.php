<?php
include "db.php";
$error_message = "";
//$res = false;
//
$User_type = $_POST['usertype'];
$userID = $_POST['userID'];

$query;

if($User_type=='instructor'){
    $query = mysqli_query($db_connection,"SELECT * FROM `instructor` WHERE Instructor_ID= '".$userID."'; ");}
else if($User_type=='student'){   
    $query = mysqli_query($db_connection,"SELECT * FROM `student` WHERE Student_ID= '".$userID."'; ");}
    

$arr = array();

while($row = $query->fetch_assoc()){
    $arr[] = $row;
}


echo json_encode($arr);


?>