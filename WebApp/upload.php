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


// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

// $targetDir_model = "uploads/";
// $fileName2 = basename($_FILES["file2"]["name"]);
// $targetFilePath_model = $targetDir_model . $fileName2;
// $fileType2 = pathinfo($targetFilePath_model,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    
    if(isset($_POST['inputtitel'])){
        $title=$_POST['inputtitel'];
    } 
    if(isset($_POST['deadline'])){
        $deadline=$_POST['deadline'];
    }

    if(isset($_POST['summernote'])){
        $desc=$_POST['summernote'];
    }
    if(isset($_POST['compile'])){
        $compile=$_POST['compile'];
    }
    if(isset($_POST['Styleofcode'])){
        $style=$_POST['Styleofcode'];
    }
    if(isset($_POST['featureinput'])){
        $deg_Feature=$_POST['featureinput'];
    }
    if(isset($_POST['dynamicinput'])){
        $deg_Dynamic=$_POST['dynamicinput'];
    }
    if(isset($_POST['totalgrae'])){
        $total_grade=$_POST['totalgrade'];
    }
    // if(empty($_FILES["file2"]["name"])){
    //     $fileName2=NULL;
    // }
    // Allow certain file formats
    if(move_uploaded_file($_FILES["file"]["tmp_name"] , $targetFilePath)){
        // Insert image file name into database
        $query="INSERT INTO `assignment` (`Assignment_title`,`Assignment_desc_dir`,
        `Full_grade`, `Compilation_grade`, `Style_grade`,`Dynamic_test_grade`,
         `Feature_test_grade`,`Assignment_model_ans`, `Attachments_dir`)
          VALUES ('$title' , $desc , $total_grade, $compile , $style , $deg_Dynamic ,
           $deg_Feature , NULL, '$fileName');";
        $insert = mysqli_query($db_connection,$query);
        if($insert){
            $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
        }else{
            
            $statusMsg = "File upload failed, please try again.";
            echo gettype($fileName);
            echo $fileName;
            echo $deadline;
        } 
    }else{
        $statusMsg = "Sorry, there was an error uploading your file.";
    }
    // if(move_uploaded_file($_FILES['file2']["tmp_name"], $targetFilePath_model)){
    //     // Insert image file name into database
    //     $query="";
    //     $insert = mysqli_query($db_connection,$query);
    //     if($insert){
    //         $statusMsg = "The file ".$fileName2. " has been uploaded successfully.";
    //     }else{
    //         $statusMsg = "File upload failed, please try again.";
    //     } 
    // }else{
    //     $statusMsg = "Sorry, there was an error uploading your file.";
    // }
    

}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>