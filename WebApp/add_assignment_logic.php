<?php
// Include the database configuration file
include 'DB/db.php';
$statusMsg = '';
$title=NULL;
$deadline=NULL;
$desc=NULL;
$compile=NULL;
$style=NULL;
$deg_Feature=NULL;
$deg_Dynamic=NULL;
$total_grade=NULL;
$row=NULL;

// File upload path
$targetDir = "uploads/assignments/attachments"; 
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$targetDir_model = "uploads/assignments/model_answer";
$fileName2 = basename($_FILES["file2"]["name"]);
$targetFilePath_model = $targetDir_model . $fileName2;
$fileType2 = pathinfo($targetFilePath_model,PATHINFO_EXTENSION);

if(isset($_POST["submit"])){
    $title=$_POST['inputtitle'];
    $deadline=date('Y-m-d H:i:s',strtotime($_POST['deadline']));
    $desc=$_POST['summernote'];
    $desc=strip_tags($desc);
    $compile=$_POST['compile'];
    $style=$_POST['Styleofcode'];
    $deg_Feature=$_POST['featureinput'];
    $deg_Dynamic=$_POST['dynamicinput'];
    $total_grade=$_POST['totalgrade'];
    if(move_uploaded_file($_FILES["file"]["tmp_name"] , $targetFilePath) || move_uploaded_file($_FILES["file2"]["tmp_name"], $targetFilePath_model)){
  
        $insert = mysqli_query($db_connection,"INSERT INTO `assignment` (`Assignment_title`, `Assignment_desc_dir`,
         `Full_grade`, `Compilation_grade`, `Style_grade`, `Dynamic_test_grade`, `Feature_test_grade`, `Assignment_date`,
          `Assignment_deadline`, `Assignment_model_ans`, `Assignment_ma_main`, `Attachments_dir`)
          VALUES ('$title' , '$desc' , $total_grade, $compile , $style , $deg_Dynamic ,
           $deg_Feature,NOW(), '$deadline' ,'$fileName2', NULL  , '$fileName');");
           $row=$db_connection->insert_id;
        if($insert){
            $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            print_r($_POST);
        }else{
            $statusMsg = "File upload failed, please try again.";
        
        } 
    }else{
        if(isset($_POST['input1'])){

        
        $insert = mysqli_query($db_connection,"INSERT INTO `assignment` (`Assignment_title`, `Assignment_desc_dir`,
        `Full_grade`, `Compilation_grade`, `Style_grade`, `Dynamic_test_grade`, `Feature_test_grade`, `Assignment_date`,
         `Assignment_deadline`, `Assignment_model_ans`, `Assignment_ma_main`, `Attachments_dir`)
         VALUES ('$title' , '$desc' , $total_grade, $compile , $style , $deg_Dynamic ,
          $deg_Feature,NOW(), '$deadline' , NULL, NULL, NULL);");
          $row=$db_connection->insert_id;


           if($insert){
               $statusMsg="upload without files";
           }else{
        $statusMsg = "Sorry, there was an error uploading your file.";
           }

           
        }
    }
 
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>