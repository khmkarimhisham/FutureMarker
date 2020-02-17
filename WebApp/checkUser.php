<?php
require_once 'DB/db.php';
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    if ($_POST['myList'] == "1") {
        $sql_statment = "SELECT `Instructor_ID` FROM `instructor` WHERE `Instructor_Email`='$email' AND `Instructor_password` = '$password';";
        $query = mysqli_query($db_connection, $sql_statment);
        $row = mysqli_fetch_assoc($query);
        if (isset($row)) {
            $_SESSION['user_email'] = $email;
            header('Location: Home.php');
        } else {
            echo 'failure';
        }
    } elseif ($_POST['myList'] == "2") {
        $sql_statment = "SELECT `Student_ID` FROM `student` WHERE `Student_Email`='$email' AND `Student_password` = '$password';";
        $query = mysqli_query($db_connection, $sql_statment);
        $row = mysqli_fetch_assoc($query);
        if (isset($row)) {
            $_SESSION['user_email'] = $email;
            header('Location: Home.php');
        } else {
            echo 'failure';
        }
    } else {
        echo 'i can`t recognize you';
    }
}
