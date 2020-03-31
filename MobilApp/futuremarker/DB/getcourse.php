<?php
include "db.php";
$User_type = $_POST['usertype'];
$userID = $_POST['userID'];

$query;
if($User_type=='instructor'){
    $query = mysqli_query($db_connection,"SELECT course.Course_ID, course.Course_name, course.Course_image FROM `Course` JOIN `teaches` ON teaches.Course_ID = course.Course_ID WHERE teaches.Instructor_ID = $userID");}
else if($User_type=='student'){   
    $query = mysqli_query($db_connection,"SELECT course.Course_ID, course.Course_name, course.Course_image FROM `Course` JOIN `enrollment` ON enrollment.Course_ID = course.Course_ID WHERE enrollment.Student_ID = $userID");}
    

$arr = array();

while($row = $query->fetch_assoc()){
    $arr[] = $row;
}


echo json_encode($arr);


?>