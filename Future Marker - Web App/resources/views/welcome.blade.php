<!DOCTYPE html>

<html>

<head>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/icon type">
    <title>Future Marker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('CSS/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="JS/index.js"></script>

</head>

<body>

    <!-- Navigation -->
    <div class="header">
        <nav class="navbar navbar-expand-md navbar-custom navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img class="" src="{{ asset('images/logo-white.png') }}" height="30" alt="logo">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCustom"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse collapse" id="navbarCustom">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item">
                            <a class="nav-link mx-1" href="download">Download App</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-1" href="about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-1" href="login">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-1" href="register">Register</a>
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
                    <a href="register" class="btn btn-warning btn btn-lg bg-light border-0">Join Us!</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="box" style="background-image: url(images/515.jpg);">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <div class="box-part text-center">

                        <i class="fa fa-clock-o fa-5x" aria-hidden="false"></i>

                        <div class="title">
                            <h4>Time Saving</h4>
                        </div>

                        <div class="text">
                            <span>You do not need to waste time correcting tasks. With the Future Marker you can do all
                                this in minutes.</span>
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
                            <span>by sending feedback as soon as possible Future marker help you to improve your code
                                skills by re submit your task.</span>
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
                            <span>as a insractor can create tasks and Quizs and upload Matiral,as a student can download
                                matiral and submit tasks and quizs.</span>
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
    <!-- Page Content -->
    <div class="box" style="background-image: url(images/section-background.png);">
        <div class="container">
            <div class="row">

                <div class="col">

                    <div class="box-part text-left">

                        <p><img src="images/chat.png" style="width:96px; height:104px"></p>

                        <h2>Easy and Fast Communication</h2>

                        <p style="font-size:24px;line-height:1.25em;">Now the users don't have to wait untill seeing
                            each others when they can communicate through online messenger </p>
                        <a href="register" class="btn btn-warning btn btn-lg">Join Us!</a>

                    </div>
                </div>

                <div class="col">

                    <div class="box-part text-right">

                        <p><img src="images/comp.png" style="width:90%; height:80%"></p>


                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Page Content -->
    <div class="box" style="background-image: url(images/639.jpg); background-size: cover;">
        <div class="container">
            <div class="row">

                <div class="col">
                    <h2 class="glow">Future Marker is multiplatform which can be used from smart phone and PC</h2>
                    <div class="box-part text-center textstyle">

                    </div>
                </div>

            </div>

        </div>
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
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Future Marker</h5>
                    <p>
                        Future Marker is the first automated assessment for coding tasks in Future Academy which is
                        developed by Computer science students
                    </p>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none">

                <!-- Grid column -->
                <div class="col-md-2 mx-auto">

                    <!-- Links -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Resourses</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Video</a>
                        </li>
                        <li>
                            <a href="#!">Presentations</a>
                        </li>
                        <li>
                            <a href="#!">Research</a>
                        </li>
                        <li>
                            <a href="#!">Stories</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none">

                <!-- Grid column -->
                <div class="col-md-2 mx-auto">

                    <!-- Links -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Connect</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Blog</a>
                        </li>
                        <li>
                            <a href="#!">News&amp;Press</a>
                        </li>
                        <li>
                            <a href="#!">Event</a>
                        </li>

                    </ul>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none">

                <!-- Grid column -->
                <div class="col-md-2 mx-auto">

                    <!-- Links -->
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4">About</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Contact</a>
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

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Future Marker Copyright

        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

</body>

</html>