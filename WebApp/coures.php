<?php

session_start();
require('DB/db.php');
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$User_ID = $_SESSION['User_ID'];

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
                            <a href="#">
                                <h4>Add Course</h4>
                            </a> </div>
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