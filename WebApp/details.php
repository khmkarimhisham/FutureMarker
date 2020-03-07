<?php

session_start();
require 'DB/db.php';
$Log_email = $_SESSION['User_email'];
$usertype = $_SESSION['User_type'];
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $User_ID = $_GET['member_id'];



    if ($_SESSION['User_type'] == "instructor") {
        $sql = "SELECT * FROM `Student` WHERE `Student_ID`= $User_ID";
        $res = mysqli_query($db_connection, $sql);
        $row = mysqli_fetch_assoc($res);
        if ($res) {
            $email=$row['Student_Email'];
            $bio = $row['Student_bio'];
            $Phone = $row['Student_phone'];
            $firstN = $row['Student_firstname'];
            $lastN = $row['Student_lastname'];
            $img = $row['Student_image'];
        }
    } else {
        header("Location: Home.php");
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
                            <img src="<?php echo  $img; ?>" width="240" height="240" class="avatar img-circle img-thumbnail" alt="avatar">

                        </div>
                        </hr><br>
                        <hr class="my-1">
                        <label class="profilelebal">Courses</label>
                        <hr class="my-1">
                        <?php

                        $query = mysqli_query($db_connection, "SELECT course.Course_ID, course.Course_name, course.Course_image FROM `Course` JOIN `Enrollment` ON Enrollment.Course_ID = course.Course_ID WHERE Student_ID = $User_ID");
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {

                                echo '
                                        <div>
                                            <img src="' . $row['Course_image'] . '" width="40" height="40">
                                            <a href="course_content_i.php?course_id=' . $row['Course_ID'] . '">' . $row['Course_name'] . '</a>
                                        </div>
                                        <hr class="my-1">';
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card -row my-5" style=" border-radius: 25px;">
                    <div class="card-body">


                        <hr>
                        <label class="profilelebal" style="font-size: 24">Information</label>
                        <hr class="my-1">
                        <div><span class="profilelebal">Name:</span><label style="margin-left: 10px;font-size: 18;"><?php echo $firstN . " " . $lastN; ?> </label></div>
                        <hr class="my-2">
                        <div><span class="profilelebal">Bio:</span><label style="margin-left: 10px;font-size: 18;"><?php echo $bio; ?></label></div>
                        <hr class="my-4">
                        <label class="profilelebal" style="font-size: 24">Contact Information</label>
                        <hr class="my-1">
                        <div><span class="profilelebal">Email:</span><a href="#"><label style="margin-left: 10px;font-size: 18;"><?php echo $email; ?></label></a></div>
                        <hr class="my-2">
                        <div><span class="profilelebal">Phone:</span><a href="#"><label style="margin-left: 10px;font-size: 18;"><?php echo $Phone; ?></label></a></div>

                    </div>
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