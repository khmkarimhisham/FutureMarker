<?php

require '../DB/db.php';

// if (!isset($_SESSION['User_ID'])) {
//     header("Location: ../login.php");
// }

if (isset($_FILES['codeFile'])) {
    $error_message = "";
    $Assignment_ID = $_POST['Assignment_ID'];
    $Student_ID = $_POST['Student_ID'];
    $Course_ID = $_POST['Course_ID'];
    $file_name = $_FILES['codeFile']['name'];
    $file_size = $_FILES['codeFile']['size'];
    $file_tmp = $_FILES['codeFile']['tmp_name'];
    $file_type = $_FILES['codeFile']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_path = "../uploads/submitted_assignments/" . mt_rand(0, getrandmax()) . "/";

    while (file_exists($file_path)) {
        $file_path = "../uploads/submitted_assignments/" . mt_rand(0, getrandmax()) . "/";
    }

    mkdir($file_path);
    $file_full_path =  $file_path . $file_name;

    if (move_uploaded_file($file_tmp, $file_full_path)) {

        exec("java -jar dist/API.jar $Student_ID $Assignment_ID $file_full_path", $output);

        if ($output[0] == "true") {
            header("Location: ../Assignment_body.php?course_id=$Course_ID&assignment_id=$Assignment_ID&submit=true");
        } else {
            header("Location: ../Assignment_body.php?course_id=$Course_ID&assignment_id=$Assignment_ID&submit=false");
        }
    } else {
        header("Location: ../Assignment_body.php?course_id=$Course_ID&assignment_id=$Assignment_ID&submit=false");
    }
}
