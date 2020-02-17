<?php
session_start();
require('db.php');
//require 'login.php';
// IF USER LOGGED IN
if(isset($_SESSION['user_email'])){
header('Location: home.php');
exit;
}
?>
<!DOCTYPE html>

<html>

<head>
    <title>Future Marker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <script type="text/javascript" src="JS/index.js"></script>
</head>

<body>

    <!-- Navigation -->
    <div class="header ">
        <nav class="navbar navbar-expand-sm navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img class="navbar-brand" src="images/logo.png">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarCustom">
                    <ul class="navbar-nav ml-auto ">

                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Log In</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Sign Up </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="instructor_Signup.php">Insrtuctor</a>
                                <a class="dropdown-item" href="student_Signup.php">Student</a>

                            </div>
                        </li>

                    </ul>
                </div>
            </div>


        </nav>

    </div>

    <!-- Full Page Image Header with Vertically Centered Content -->
    <header class="masthead " style=" background-image: url('images/header.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">Make Your Code Easy</h1>
                    <hr class="divider my-4">
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <button type="button" class=" headerbtn">Sign Up</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="box">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <div class="box-part text-center">

                        <i class="fa fa-clock-o fa-5x" aria-hidden="false"></i>

                        <div class="title">
                            <h4>Time Saving</h4>
                        </div>

                        <div class="text">
                            <span>You do not need to waste time correcting tasks. With the Future Marker you can do all this in minutes.</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <div class="box-part text-center">

                        <i class="fa fa-tasks fa-5x" aria-hidden="true"></i>

                        <div class="title">
                            <h4>Improve Skills</h4>
                        </div>

                        <div class="text">
                            <span>by sending feedback as soon as possible Future marker help you to improve your code skills by re submit your task.</span>
                        </div>



                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <div class="box-part text-center">

                        <i class="fa fa-user fa-5x" aria-hidden="true"></i>

                        <div class="title">
                            <h4>Users</h4>
                        </div>

                        <div class="text">
                            <span>as a insractor can create tasks and Quizs and upload Matiral,as a student can download matiral and submit tasks and quizs.</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="demo" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/s1.jpg">
                <div class="carousel-caption">
                    <h3>Future Marker</h3>
                    <p>The Future is Here!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/s2.jpg">
                <div class="carousel-caption">
                    <h3>Just One Click </h3>
                    <p>You Can Take Your Feedback In Seconds</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/s3.jpg">
                <div class="carousel-caption">
                    <h3>Save Your Time</h3>
                    <p>By Using Future Marker</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small footerstyle">

        <!-- Footer Links -->
        <div class="container text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-4 mx-auto">

                    <!-- Content -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Footer Content</h5>
                    <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
                        consectetur
                        adipisicing elit.</p>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none">

                <!-- Grid column -->
                <div class="col-md-2 mx-auto">

                    <!-- Links -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none">

                <!-- Grid column -->
                <div class="col-md-2 mx-auto">

                    <!-- Links -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none">

                <!-- Grid column -->
                <div class="col-md-2 mx-auto">

                    <!-- Links -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <hr>

        <!-- Call to action -->
        <ul class="list-unstyled list-inline text-center py-2">
            <li class="list-inline-item">
                <h5 class="mb-1">Register for free</h5>
            </li>
            <li class="list-inline-item">
                <a href="#!" class="btn btn-danger btn-rounded">Sign up!</a>
            </li>
        </ul>
        <!-- Call to action -->

        <hr>


        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Copyright:

        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

</body></html>
