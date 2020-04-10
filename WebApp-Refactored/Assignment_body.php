<?php

session_start();

if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$usertype = $_SESSION['User_type'];
$Student_ID = $_SESSION['User_ID'];
require 'DB/db.php';
include "php_file_tree.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $Course_ID = $_GET['course_id'];
    $Assignment_ID = $_GET['assignment_id'];

    $result1 = mysqli_query($db_connection, "SELECT * FROM `assignment` JOIN `course` ON assignment.Course_ID = course.Course_ID WHERE assignment.Assignment_ID = $Assignment_ID");
    if (mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $Course_name = $row['Course_name'];
        $Course_des =  $row['Course_desc'];
        $Course_image =  $row['Course_image'];
        $Assignment_tit = $row['Assignment_title'];
        $Assignment_due = date("F j, Y, g:i a", strtotime($row['Assignment_deadline']));
        $Assignment_date = date("F j, Y, g:i a", strtotime($row['Assignment_date']));
        $Assignment_desc = $row['Assignment_desc_dir'];
    } else {
        header("Location: Home.php");
    }
} else {
    header("Location: Home.php");
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
  
        <div class="row">
            <div class="col" style="margin-left: 25px;">
                <div class="card -row my-3">
                    <div class="card-body">
                        <div>
                            <img src="<?php echo $Course_image; ?>" class="rounded mx-auto d-block" style="width: 260px;" alt="...">

                        </div>
                        <div>
                            <hr class="my-2">
                            <div> <a class="aedit active" href="#"> <label>Matiral</label></a></div>
                            <hr class="my-3">
                            <div> <a class="aedit" href="#"> <label>Update</label></a></div>
                            <hr class="my-3">
                            <div> <a class="aedit" href="students_grades.php?course_id=<?php echo $Course_ID?>&assignment_id=<?php echo $Assignment_ID?>"> <label>Grades</label></a></div>
                            <hr class="my-3">
                            <div> <a class="aedit" href="#"> <label>Members</label></a></div>
                            <hr class="my-3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card -row my-3">
                    <div class="card-body">
                        <div>
                            <a href="course_content.php?course_id=<?php echo $Course_ID; ?>"><strong><?php echo $Course_name ?></strong></a>
                            <hr class="my-3">
                        </div>
                        <div>
                            <h4><strong><?php echo $Assignment_tit; ?></strong></h4>
                        </div>
                        <hr class="my-1 ">
                        <div class="raw">
                            <label>Due : <?php echo $Assignment_due;
                                            ?>
                            </label>
                            <hr class="my-1">


                            <?php
                            echo file_get_contents($Assignment_desc);
                            ?>
                            <hr class="my-1">
                            <small>Posted <?php echo $Assignment_date; ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col" style="margin-right: 25px;">
                <div class="card -row my-3">
                    <div class="card-body">
                        <div class="raw">
                            <h>Assignments</h>
                            <hr class="my-2">
                            <div class="diveditsecond">


                                <?php

                                $result = mysqli_query($db_connection, "SELECT * FROM `doing_assignment` WHERE `Assignment_ID` = '$Assignment_ID' AND `Student_ID` = '$Student_ID'");

                                if (mysqli_num_rows($result) > 0) {
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $Doing_ID = $row['Doing_ID'];
                                        $Doing_time = date("F j, Y, g:i a", strtotime($row['Doing_time']));
                                        echo $Doing_time . '
                                    
                                            <hr class="my-1">
                                            <img src="images/assignment_image.png" width="20" height="20">
                                            <a href="submission.php?course_id=' . $Course_ID . '&assignment_id=' . $Assignment_ID . '&submission=' . $Doing_ID . '" > Submission ' . $count . '</a> <hr class="my-3">
                                      
                                            ';
                                        $count++;
                                    }
                                }
                                ?>

                            </div>
                        </div>

                        <div class="raw">
                            <div class="diveditsecond text-center">
                                <button type="submit" class="btn btn-outline-secondary " data-toggle="modal" data-target="#Submitform">Submit Assignmnet</button>
                            </div>
                            <div class="modal fade" id="Submitform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title" id="exampleModalLabel">Upload Assignment File</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" enctype="multipart/form-data" action="API\assess.php">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="assignmentfile">Assignment File</label>
                                                    <input type="file" class="form-control" name="codeFile" id="codeFile" required>
                                                    <input type="text" class="form-control" name="Assignment_ID" id="Assignment_ID" value="<?php echo $Assignment_ID; ?>" hidden>
                                                    <input type="text" class="form-control" name="Student_ID" id="Student_ID" value="<?php echo $Student_ID; ?>" hidden>
                                                    <input type="text" class="form-control" name="Course_ID" id="Course_ID" value="<?php echo $Course_ID; ?>" hidden>
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
    

    <!-- Footer -->
    <div class="footerstyle">
        <p>©Future Marker 2020 Copyright:s</p>
    </div>
</body>

</html>