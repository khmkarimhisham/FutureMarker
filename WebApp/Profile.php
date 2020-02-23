<?php

session_start();
require 'DB/db.php';
$firstN='';
$lastN='';
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$email=$_SESSION['User_email'];

$User_ID = $_SESSION['User_ID'];
$error_message = "";
   if($_SESSION['User_type']=="instructor"){
    $sql="SELECT * FROM `instructor` WHERE `Instructor_ID`= $User_ID";
    $res=mysqli_query($db_connection,$sql);
    $row=mysqli_fetch_assoc($res);
   // print_r($row);
    if($res){
        $bio=$row['Instructor_bio'];
        $Phone=$row['Instructor_phone'];
        $firstN=$row['Instructor_firstname'];
        $lastN=$row['Instructor_lastname'];
    }
   }else{
    $sql="SELECT * FROM `student` WHERE `Student_ID`= $User_ID";
    $res=mysqli_query($db_connection,$sql);
    $row=mysqli_fetch_assoc($res);
    print_r($row);
    if($res){
        $bio=$row['Student_bio'];
        $Phone=$row['Student_phone'];
        $firstN=$row['Student_firstname'];
        $lastN=$row['Student_lastname'];
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
    <link rel="stylesheet" href="CSS/couresbody.css">

    <script type="text/javascript" src="JS/index.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!------ Include the above in your HEAD tag ---------->
</head>

<body style="background-color: f0f0f0">
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark homeheader">
        <a class="navbar-brand" href="Home.html">
            <img class="navbar-brand" src="images/logo.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="coures.html" >
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
            <ul class="navbar-nav ">
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
                            <img src="http://www.bobmazzo.com/wp-content/uploads/2009/07/bobmazzoCD.jpg" width="30" height="30">

                            anashassan299@outlook.com
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="Profile.html">Your Profile</a>
                            <a class="dropdown-item" href="#">Future Academy</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-sign-out"></i>Log out</a>
                        </div>
                    </div>
                </li>

            </ul>


        </div>
    </nav>

    <div class="row">

        <div class="col-6 col-md-4">
            <div class="card -row my-5">
                <div class="card-body">
                    
                    <div class="container">
                        <img src="images/avatar.jpg" class="rounded mx-auto d-block" alt="..." width="250" height="150" >

                    </div>
                    <hr class="my-1">
                     <label class="profilelebal">my Courses</label>
                    <hr class="my-1">
                    <div>
                     <img src="images/logo-2249282902_5d8718c251f32.png" width="40" height="40">
                                <a href="#">CSC413 Mobile Programming: Fall 2019</a>
                    </div>
                    <hr class="my-1">
                    <div>
                     <img src="images/logo-2249282902_5d8718c251f32.png" width="40" height="40">
                                <a href="#">Information Security Future 2018-2019</a>
                    </div>
                    <hr class="my-1">
                   <div>
                     <img src="images/222.jpg" width="40" height="40">
                                <a href="#">CSC491 Graduation Project: Automated assisment</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card -row ">
                <div class="card-body">
                     <div> <label style="font-size: 18"> </label></div>
                     <div><span>my school :</span><label style="font-size: 18">Future Academy</label></div>
                     <hr >
                    <label class="profilelebal">About Me</label>
                    <hr class="my-1">
                    <div><span>Name:</span><label  class="profilelebal"><?php echo $firstN." ".$lastN; ?> </label></div>
                    <hr class="my-1">
                   <div><span>Bio:</span><label class="profilelebal" ><?php echo $bio; ?></label></div>
                    <hr class="my-4">
               <label class="profilelebal">Contact Information</label>
                    <hr class="my-1">
                    <div><span >Email:</span><a href="#"><label  class="profilelebal"><?php echo $email; ?></label></a></div>
                    <hr class="my-1">
                    <div><span >Phone:</span><a href="#"><label  class="profilelebal"><?php echo $Phone; ?></label></a></div>
                    
                </div>

               
            </div>
        </div>
    </div>





    <!-- Footer -->
    <div class="footerstyle">
        <p>©Future Marker 2020 Copyright</p>
    </div>
</body></html>
