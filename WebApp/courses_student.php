<?php

session_start();
require('DB/db.php');
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$User_ID = $_SESSION['User_ID'];
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $access_code = $_POST['access_code'];
    if (!empty($access_code)) {
        $result = mysqli_query($db_connection, "SELECT `Course_ID` FROM `course` WHERE `Course_access_code`='$access_code';");
        if ($result->num_rows > 0) {
            $Course_ID = $result['Course_ID'];
            $query = mysqli_query($db_connection, "INSERT INTO `enrollment`(`Student_ID`, `Course_ID`) VALUES ($User_ID , $Course_ID);");
            header("Location: couresbody.php?course_id=" . $Course_ID);

        } else {
            $error_message = "Invalid Access Code";
        }
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
            <?php
            if (!empty($error_message)) {
                echo '<div class="alert alert-danger" role="alert">' . $error_message .
                    '</div>';
            }
            ?>
            <div class="row">

                <?php
                $result = mysqli_query($db_connection, "SELECT `Course_ID`, `Course_name`, `Course_image` FROM `course` WHERE (SELECT `Course_ID` FROM `enrollment` WHERE `Student_ID` = $User_ID);");
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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="box-part text-center">
                        <i class="fa fa-plus fa-5x" aria-hidden="false"></i>
                        <div class="title">
                            <div class="container">
                                <a href="#" data-toggle="modal" data-target="#joinForm">
                                    <h4>Join Course</h4>
                                </a>
                            </div>

                            <div class="modal fade" id="joinForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                                <h5 class="modal-title" id="exampleModalLabel">Join Course</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="courses_student.php">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input class="form-control" id="access_code" name="access_code" placeholder="Enter Access Code" require>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-top-0 d-flex justify-content-center">
                                                    <button class="btn btn-primary">Join</button>
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