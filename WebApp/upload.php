<?php
session_start();

if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$usertype = $_SESSION['User_type'];

require 'DB/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $upload_check=false;
    $create=false;
    if ($_POST['Select']==1) {
        $Course_ID = $_POST['course_id'];
        echo "here1";

        $result1 = mysqli_query($db_connection, "SELECT * FROM `course` WHERE `Course_ID` = $Course_ID");
        if (mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);

            $Course_dir =  $row['Course_material_dir'];
        }
    } elseif ($_POST['Select']==2) {
        echo "here2";
        $Course_ID = $_POST['course_id'];
        $result1 = mysqli_query($db_connection, "SELECT * FROM `course` WHERE `Course_ID` = $Course_ID");
        if (mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $Course_dir =  $row['Course_material_dir'];
        }
        $folder_name = $_POST['foldername'];
        $folder_dir = $Course_dir . '/' . $folder_name;
        if(!file_exists($folder_dir)){
            mkdir($folder_dir, 0700);
            $create=true;
        }
        print_r($_FILES);
        if (isset($_FILES["folderfile"]["name"])) {
            $info = pathinfo($_FILES["folderfile"]["name"]);
            $ext = $info['extension']; // get the extension of the file
            $newname = "newname." . $ext;
            $target = $folder_dir.'/'. $newname;
            $upload_check = move_uploaded_file($_FILES["folderfile"]["tmp_name"], $target);
        
        }
       header("Location: course_content_i.php?course_id=$Course_ID&create=$create");
    }else{
        header("Location: course_content_i.php?course_id=$Course_ID");

    }
} else {
    header("Location: courses_instructor.php");
}
