<?php
require_once 'DB/db.php';
if (isset($_POST['std_email'])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["std_email"];
    $password = $_POST["password"];
    $sql_statment = "INSERT INTO `student`(`Student_firstname`, `Student_lastname`, `Student_Email`, `Student_password`) VALUES ('$firstname', '$lastname', '$email', '$password');";
    $query = mysqli_query($db_connection, $sql_statment);
    if ($query) {
        header('Location: login.php');
    } else {
        echo "the form not posted";
    }
}else if (isset($_POST['inst_email'])) {

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["inst_email"];
    $password = $_POST["password"];
    $sql_statment = "INSERT INTO `instructor`(`Instructor_firstname`, `Instructor_lastname`, `Instructor_Email`, `Instructor_password`) VALUES ('$firstname', '$lastname', '$email', '$password');";
    $query = mysqli_query($db_connection, $sql_statment);
    if ($query) {
        header('Location: login.php');
    } else {
        echo "check for query";
    }
}
