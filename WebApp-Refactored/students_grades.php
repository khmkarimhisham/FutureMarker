<?php

session_start();

if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$usertype = $_SESSION['User_type'];

require 'DB/db.php';



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $Course_ID = $_GET['course_id'];
    $assignment_id = $_GET['assignment_id'];
    $result1 = mysqli_query($db_connection, "SELECT * FROM `course` WHERE `Course_ID` = $Course_ID");
    $result2 = mysqli_query($db_connection, "SELECT * FROM `assignment` WHERE `Assignment_ID`=$assignment_id");
    if (mysqli_num_rows($result2) > 0) {
        $row = mysqli_fetch_assoc($result2);
        $assignment_tit = $row['Assignment_title'];
        $assignment_weigth = $row['Full_grade'];
    }
    if (mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $Course_name = $row['Course_name'];
        $Course_des =  $row['Course_desc'];
        $Course_image =  $row['Course_image'];
        $Course_dir =  $row['Course_material_dir'];
        $Course_AC =  $row['Course_access_code'];
    } else {
        header("Location: Home.php");
    }
} else {
    header("Location: Home.php");
}


if ($_SESSION['User_type'] == "student") {
    header("Location: courses_content.php");
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
                            <hr class="my-3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card -row my-5" style=" border-radius: 25px;">
                    <div class="card-body">
                        <a href="course_content_i.php?course_id=<?php echo $Course_ID; ?>"><strong><?php echo $Course_name ?></strong></a><br>
                        <label class="profilelebal" style="font-size: 18"><?php echo $assignment_tit ?></label>
                        <hr class="my-1">
                        <table class="table table-sm table-light ">
                            <?php
                            $sql = "SELECT * FROM student JOIN doing_assignment ON student.Student_ID=doing_assignment.Student_ID WHERE doing_assignment.Assignment_ID=$assignment_id";
                            $result = mysqli_query($db_connection, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $Doing_ID=$row['Doing_ID'];
                                    settype($row['Compilation_grade'], "integer");
                                    settype($row['Style_grade'], "integer");
                                    settype($row['Dynamic_test_grade'], "integer");
                                    settype($row['Feature_test_grade'], "integer");
                                    $assignment_grade = $row['Compilation_grade'] + $row['Style_grade'] + $row['Dynamic_test_grade'] + $row['Feature_test_grade'];
                                    echo '<tr class="table-active "><img src="' . $row['Student_image'] . '" width="30" height="30"><a href="submission.php?course_id=' . $Course_ID . '&assignment_id=' . $assignment_id . '&submission=' . $Doing_ID . '"" class="aedit">' . $row['Student_firstname'] . ' ' . $row['Student_lastname'] . '</a> <label style="font-size: 18;font-weight: 200; margin-left: 15px;"> ' . $assignment_grade . '</label> </tr><hr class="my-2 ">';
                                }
                            }
                            ?>

                        </table>


                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>