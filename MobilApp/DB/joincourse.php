<?php
include "db.php";
$User_type = $_POST['usertype'];
$userID = $_POST['userID'];
$access_code = $_POST['accsescode'];

$res = false;

 if (!empty($access_code)) {
     
        $result = mysqli_query($db_connection, "SELECT `Course_ID` FROM `course` WHERE `Course_access_code`='$access_code';");
     
        if ($result->num_rows > 0) {
            
            $row = mysqli_fetch_assoc($result);
            
            $Course_ID = $row['Course_ID'];
            
            $query = mysqli_query($db_connection, "INSERT INTO `enrollment`(`Student_ID`, `Course_ID`) VALUES ($userID , $Course_ID);");
            echo json_encode($query);
            
        } else {
            echo json_encode($res);
        }
    }



?>