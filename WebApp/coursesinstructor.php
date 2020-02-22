<?php

session_start();
require 'DB/db.php';
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$User_ID = $_SESSION['User_ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Course_name = $_POST["CourseName"];
    $Course_desc = $_POST["CourseDescription"];
    $Course_image = $_POST["CourseImage"];

    $sql_stat = "INSERT INTO `course`( `Course_name`, `Course_desc`, `Course_image`) VALUES ('$Course_name','$Course_desc','$Course_image');";

    if (mysqli_query($db_connection, $sql_stat)) {
        $Course_ID = mysqli_insert_id($db_connection);
        $query2 = mysqli_query($db_connection, "INSERT INTO `teaches`(`Instructor_ID`, `Course_ID`) VALUES ($User_ID,$Course_ID)");
        if ($query2) {
            header('Location: coursesinstructor.php');
        }
    } else {

        echo "hhhhhhhh";
        $error_message = $error_message . "There is a problem, Please try again later.\n";
    }
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/content.css">

    <!------ Include the above in your HEAD tag ---------->
</head>

<body style="background-color: f0f0f0">
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark homeheader ">
        <a class="navbar-brand" href="#">
            <img class="navbar-brand" src="images/logo.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="box">
        <div class="container">
            <div class="row">

                <?php
$result = mysqli_query($db_connection, "SELECT `Course_ID`, `Course_name`, `Course_image` FROM `course` WHERE (SELECT `Course_ID` FROM `teaches` WHERE `Instructor_ID` = $User_ID);");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="box-part text-center">
                                    <img src="' . $row['Course_image'] . '" width="160" height="160">
                                    <div class="title">
                                        <a href="couresbody.php?course_id=' . $row['Course_ID'] . '">
                                            <h4>' . $row['Course_name'] . '</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ';
    }
}

?>

               </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <div class="box-part text-center">

                        <i class="fa fa-plus fa-5x" aria-hidden="false"></i>

                        <div class="title">
                            <div class="container">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form">
                                    Create New Course
                                </button>
                            </div>

                            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title" id="exampleModalLabel">Create New Course</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="CourseName">CourseName</label>
                                                    <input type="text" class="form-control" name="CourseName" id="CourseName"  placeholder="Enter CourseName">
                                                </div>
                                                <div class="form-group">
                                                    <label for="CourseDescription">Course Description</label>
                                                    <input type="text" class="form-control" name="CourseDescription" id="CourseDescription" placeholder="Enter CourseDescription">
                                                </div>
                                                <div class="form-group">
                                                    <label for="CourseImage">Course Image</label>
                                                    <input type="file" class="form-control" name="CourseImage" id="CourseImage" placeholder="Image">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-top-0 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small footerstyle">
        <hr>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">©Future Marker 2020 Copyright:

        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>
