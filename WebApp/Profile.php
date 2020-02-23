<?php

session_start();
require 'DB/db.php';
$email = $_SESSION['User_email'];

$User_ID = $_SESSION['User_ID'];
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bio = $_POST["bio"];
    $phone = $_POST["phone"];
    if ($_SESSION['User_type'] == "instructor") {
        $query = "UPDATE `instructor`SET `Instructor_bio`='$bio',`Instructor_phone`='$phone' WHERE  `Instructor_ID`= $User_ID";
        $query2 = mysqli_query($db_connection, $query);
    } else {
        $query = "UPDATE `student`SET `Student_bio`='$bio',`Student_phone`='$phone' WHERE  `Student_ID`= $User_ID";
        $query2 = mysqli_query($db_connection, $query);
    }
}
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}


if ($_SESSION['User_type'] == "instructor") {
    $sql = "SELECT * FROM `instructor` WHERE `Instructor_ID`= $User_ID";
    $res = mysqli_query($db_connection, $sql);
    $row = mysqli_fetch_assoc($res);
    // print_r($row);
    if ($res) {
        $bio = $row['Instructor_bio'];
        $Phone = $row['Instructor_phone'];
        $firstN = $row['Instructor_firstname'];
        $lastN = $row['Instructor_lastname'];
    }
} else {
    $sql = "SELECT * FROM `student` WHERE `Student_ID`= $User_ID";
    $res = mysqli_query($db_connection, $sql);
    $row = mysqli_fetch_assoc($res);
    print_r($row);
    if ($res) {
        $bio = $row['Student_bio'];
        $Phone = $row['Student_phone'];
        $firstN = $row['Student_firstname'];
        $lastN = $row['Student_lastname'];
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
                    <a class="nav-link" href="coures.html">
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
                            <?php echo $email; ?>
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
                        <img src="images/avatar.jpg" class="rounded mx-auto d-block" alt="..." width="250" height="150">

                    </div>
                    <hr class="my-1">
                    <label class="profilelebal">my Courses</label>
                    <hr class="my-1">
                    <?php

                    $query = mysqli_query($db_connection, "SELECT course.Course_ID, course.Course_name, course.Course_image FROM `Course` JOIN `teaches` ON teaches.Course_ID = course.Course_ID WHERE teaches.Instructor_ID = $User_ID");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {

                            echo '
                                        <div>
                                            <img src="' . $row['Course_image'] . '" width="40" height="40">
                                            <a href="course_content.php?course_id=' . $row['Course_ID'] . '">' . $row['Course_name'] . '</a>
                                        </div>
                                        <hr class="my-1">';
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card -row my-5">
                <div class="card-body">
                    <div class="container text-right">
                        <a href="#" data-toggle="modal" data-target="#editForm">
                            <label class="profilelebal">Edit Profile</label>
                        </a>
                    </div>

                    <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="bio">Bio</label>
                                            <input type="text" class="form-control" name="bio" id="bio" placeholder="Enter Bio">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
                                        </div>

                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div> <label style="font-size: 18"><?php echo $firstN . " " . $lastN . $email; ?> </label></div>

                    <hr>
                    <label class="profilelebal">About Me</label>
                    <hr class="my-1">
                    <div><span>Name:</span><label class="profilelebal"><?php echo $firstN . " " . $lastN; ?> </label></div>
                    <hr class="my-1">
                    <div><span>Bio:</span><label class="profilelebal"><?php echo $bio; ?></label></div>
                    <hr class="my-4">
                    <label class="profilelebal">Contact Information</label>
                    <hr class="my-1">
                    <div><span>Email:</span><a href="#"><label class="profilelebal"><?php echo $email; ?></label></a></div>
                    <hr class="my-1">
                    <div><span>Phone:</span><a href="#"><label class="profilelebal"><?php echo $Phone; ?></label></a></div>

                </div>


            </div>
        </div>
    </div>





    <!-- Footer -->
    <div class="footerstyle">
        <p>©Future Marker 2020 Copyright</p>
    </div>
</body>

</html>