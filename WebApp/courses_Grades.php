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
    <link rel="stylesheet" href="CSS/couresbody.css">
    <link href="CSS/default.css" rel="stylesheet" type="text/css" media="screen" />

    <!-- Makes the file tree(s) expand/collapsae dynamically -->
    <script src="JS/php_file_tree.js" type="text/javascript"></script>

    <script type="text/javascript" src="JS/index.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!------ Include the above in your HEAD tag ---------->
</head>
<body style="background-color: f0f0f0">
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark homeheader">
        <a class="navbar-brand" href="index.php">
            <img class="navbar-brand" src="images/logo.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $usertype == "instructor" ?  "courses_instructor.php" : "courses_student.php"; ?>">
                        Courses
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        Groups
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="#">

                        Grades
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav navedit ">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-bell">
                            <span class="badge badge-info">11</span>
                        </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-search">
                            <span class="badge badge-success"></span>
                        </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-envelope">
                            <span class="badge badge-info">2</span>
                        </i>
                    </a>
                </li>
                <li>

                    <div class="dropdown mydrop">
                        <button type="button" class="btn btn-primary dropdown-toggle mydropbutton" data-toggle="dropdown">
                            <img src="<?php echo $_SESSION['User_image']; ?>" width="30" height="30">

                            <?php echo $_SESSION['User_email'];
                            ?>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="Profile.php">Your Profile</a>
                            <a class="dropdown-item" href="#">Future Academy</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>Log out</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
        <div class="col-4">
                <div class="card -row my-5" style=" border-radius: 25px;">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="<?php echo $Course_image; ?>" width="240" height="240" class="avatar img-circle img-thumbnail" alt="avatar">
                        </div>
                        </hr><br>
                        <div>
                            <hr class="my-2">
                            <div> <a class="aedit active" href="#"> <label>Material</label></a></div>
                            <hr class="my-3">
                            <div> <a class="aedit" href="#"> <label>Update</label></a></div>
                            <hr class="my-3">
                            <div> <a class="aedit" href="#"> <label>Grades</label></a></div>
                            <hr class="my-3">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card -row my-5" style=" border-radius: 25px;">
                    <div class="card-body">
                                                                         <!--Course name-->
                        <label class="profilelebal" style="font-size: 24">Mobile Programming</label><br>
                        <label class="profilelebal" style="font-size: 18">Grades</label>
                        <hr class="my-1">
                        <table class="table table-sm table-light ">
                            <!---->
                            <tr class="table-active "><label style="font-size: 18"> Assignment 1 :</label> <label style="font-size: 18;font-weight: 200; margin-left: 15px;">98</label>
                             </tr><hr class="my-2 ">
                             <tr class="table-active "><label style="font-size: 18"> Assignment 2 :</label> <label style="font-size: 18;font-weight: 200; margin-left: 15px;">98</label>
                             </tr><hr class="my-2 ">
                             <tr class="table-active "><label style="font-size: 18"> Assignment 3 :</label> <label style="font-size: 18;font-weight: 200;margin-left: 15px; ">98</label>
                             </tr><hr class="my-2 ">
                             <tr class="table-active "><label style="font-size: 18"> Assignment 4 :</label> <label style="font-size: 18;font-weight: 200;margin-left: 15px;">98</label>
                             </tr><hr class="my-2 ">
                        </table>


                    </div>
                </div>
            </div>

        </div>
    </div>


</body>
</html>