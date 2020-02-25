<?php

include 'DB/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Course_ID = $_POST['Course_ID'];
    $status_message = "aaaa";



    print_r($_POST);
    $title = $_POST['inputtitle'];
    $deadline = date('Y-m-d H:i:s', strtotime($_POST['deadline']));
    $desc = $_POST['summernote'];
    $compile_degree = $_POST['compile'];
    $style_degree = $_POST['Styleofcode'];
    $Feature_degree = $_POST['featureinput'];
    $Dynamic_degree = $_POST['dynamicinput'];
    $total_grade = $_POST['totalgrade'];

    $targetFilePath = null;
    $targetFilePath2 = null;
    $error_message = '';
    $status_message = '';


    $assignment_attachment_check = true;
    $model_answer_check = true;


    if (!empty($_FILES["file1"]["name"])) {
        $assignment_attachment = basename($_FILES["file1"]["name"]);
        $attachment_dir = "uploads/assignments/attachments/";
        $fileType = pathinfo($assignment_attachment, PATHINFO_EXTENSION);
        do {
            $assignment_attachment = rand() . '.' . $fileType;
            $targetFilePath = $attachment_dir . $assignment_attachment;
        } while (file_exists($targetFilePath));
        $assignment_attachment_check = move_uploaded_file($_FILES["file1"]["tmp_name"], $targetFilePath);
    }

    if (!empty($_FILES["file2"]["name"])) {
        $model_answer = basename($_FILES["file2"]["name"]);
        $modelAnswer_dir = "uploads/assignments/model_answer/";
        $fileType2 = pathinfo($model_answer, PATHINFO_EXTENSION);
        do {
            $model_answer = rand() . '.' . $fileType2;
            $targetFilePath2 = $modelAnswer_dir . $model_answer;
        } while (file_exists($targetFilePath2));
        $model_answer_check = move_uploaded_file($_FILES["file2"]["tmp_name"], $targetFilePath2);
    }

    do {
        $doc_name = rand() . '.doc';
        $doc_dir = "uploads/assignments/description/$doc_name";
    } while (file_exists($doc_dir));
    file_put_contents($doc_dir, $desc);


    if ($assignment_attachment_check && $model_answer_check) {

        $insert = mysqli_query($db_connection, "INSERT INTO `assignment` (`Assignment_title`, `Course_ID`, `Assignment_desc_dir`,
         `Full_grade`, `Compilation_grade`, `Style_grade`, `Dynamic_test_grade`, `Feature_test_grade`,
          `Assignment_deadline`, `Assignment_model_ans`, `Assignment_ma_main`, `Attachments_dir`)
          VALUES ('$title','$Course_ID', '$doc_dir' , $total_grade, $compile_degree , $style_degree , $Dynamic_degree ,
           $Feature_degree, '$deadline' ,'$targetFilePath2', NULL  , '$targetFilePath');");
        if ($insert) {

            $assignment_ID = $db_connection->insert_id;

            if ($_POST['dynamic_number'] > 0) {
                for ($i = 1; $i <= (int) $_POST['dynamic_number']; $i++) {
                    $q = "INSERT INTO `dynamic_test` (`Assignment_ID`,`Input`, `output`, `Hidden`) VALUES ($assignment_ID,'" . $_POST["input$i"] . "', '" . $_POST["output$i"] . "'," . (isset($_POST["switch$i"]) ? '1' : '0') . ")";
                    $sql = mysqli_query($db_connection, $q);
                    if (!$sql) {
                        $error_message .= "Failed to upload dynamic test";
                    }
                }
            }

            if ($_POST['feature_number'] > 0) {
                for ($i = 1; $i <= (int) $_POST['feature_number']; $i++) {
                    $sql2 = mysqli_query($db_connection, "INSERT INTO `feature_test`(`Assignment_ID`, `Test_name`, `regex`)
                     VALUES ($assignment_ID ,'" . $_POST["input-select$i"] . "',' " . $_POST["textarea$i"] . "')");
                    if (!$sql2) {
                        $error_message .= "Failed to upload feature test";
                    }
                }
            }
            $status_message = "Assignment has been uploaded successfully.";
        } else {
            $error_message = "Assignment upload failed, please try again.";
        }
    }
}
echo $status_message;
echo $error_message;
