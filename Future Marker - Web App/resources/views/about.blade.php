<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/icon type">
    <title>Future Marker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('CSS/notifaction.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/main.css') }}" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="" src="{{ asset('images/logo-white.png') }}" height="20" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

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

    <main class="py-5 px-5">
        <div class="row justify-content-center mb-3">
            <h2>About US</h2>
        </div>
        <hr>

        <div class="row mb-5">
            <p><strong>Nowadays the world is moving towards the automation and artificial intelligence in all
                    institutions and organizations to facilitate their work and decrease the cost, in addition to
                    getting the highest possible accuracy, So we have decided to build Future Marker which is
                    a smart learning management system that can automatically mark and evaluates the
                    programming assignments and MCQ exams, it also allows the instructors to share the course
                    materials with the students
                </strong></p>
            <p><strong>Future Marker web application is one of the best solutions for the educational institutions
                    especially the ones that are related to programming, it helps them to apply the distance
                    education magnificently as the instructor can share the materials, upload assignments, and
                    tests his students.
                </strong></p>
            <p><strong>
                    This project is trying to solve various problems such as saving time and efforts for
                    instructors who spend much time on marking and evaluating the programming assignments
                    and multiple choices exams manually, besides the final grade, many instructors do not have
                    the opportunity to give every student brief feedback for each one of them about their
                    progress on the assignment submission.
                </strong></p>
        </div>

        <div class="row justify-content-center">
            <h2>Meet The Team</h2>
        </div>


        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card my-4 text-center shadow bg-white rounded">
                    <div class="card-body">
                        <img class="card-img-top rounded-circle mb-3" style=" max-width: 200px;"
                            src="{{ asset('images\Team\0.png') }}">

                        <h3 class="card-title">KARIM HISHAM</h3>
                        <label for="">khm.karimhisham@gmail.com</label><br>
                        <label for="">+2 011 1739 1522</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card my-4 text-center shadow bg-white rounded">
                    <div class="card-body">
                        <img class="card-img-top rounded-circle mb-3" style=" max-width: 200px;"
                            src="{{ asset('images\Team\2.jpg') }}">

                        <h3 class="card-title">ANAS HASSAN</h3>
                        <label for="">anashassan299@outlook.com</label><br>
                        <label for="">+2 010 2351 5929</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card my-4 text-center shadow bg-white rounded">
                    <div class="card-body">
                        <img class="card-img-top rounded-circle mb-3" style=" max-width: 200px;"
                            src="{{ asset('images\Team\1.jpg') }}">

                        <h3 class="card-title">MOHAMED ESSAM</h3>
                        <label for="">essam.lfc@gmail.com</label><br>
                        <label for="">+2 011 1826 1096</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card my-4 text-center shadow bg-white rounded">
                    <div class="card-body">
                        <img class="card-img-top rounded-circle mb-3" style=" max-width: 200px;"
                            src="{{ asset('images\Team\4.jpg') }}">

                        <h3 class="card-title">MARTIN FAWZY</h3>
                        <label for="">mf.martinfawzy@gmail.com</label><br>
                        <label for="">+2 012 2671 8898</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card my-4 text-center shadow bg-white rounded">
                    <div class="card-body">
                        <img class="card-img-top rounded-circle mb-3" style=" max-width: 200px;"
                            src="{{ asset('images\Team\3.jpg') }}">

                        <h3 class="card-title">HAITHAM HASHIM</h3>
                        <label for="">haitham.hashem.ezzat1997@gmail.com</label><br>
                        <label for="">+2 010 0471 8535</label>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>

</html>