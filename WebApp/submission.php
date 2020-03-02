<?php

session_start();

if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}

$usertype = $_SESSION['User_type'];
$Student_ID = $_SESSION['User_ID'];
require 'DB/db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $Course_ID = $_GET['course_id'];
    $Assignment_ID = $_GET['assignment_id'];
    $Doing_ID = $_GET['submission'];
    $sql = "SELECT `Assignment_title`, assignment.Full_grade, assignment.Compilation_grade, assignment.Style_grade, assignment.Dynamic_test_grade, assignment.Feature_test_grade, doing_assignment.Compilation_grade AS `Doing_compilation_grade`, doing_assignment.Compilation_feedback, doing_assignment.Style_grade AS `Doing_style_grade`, doing_assignment.Comment_feedback, doing_assignment.Indentation_feedback, doing_assignment.Methods_feedback, doing_assignment.Identifiers_feedback, doing_assignment.Dynamic_test_grade AS `Doing_dynamic_test_grade`, `Dynamic_test_feedback`, doing_assignment.Feature_test_grade AS `Doing_feature_test_grade`, `Feature_test_feedback` FROM `assignment` JOIN `doing_assignment` ON assignment.Assignment_ID = doing_assignment.Assignment_ID WHERE doing_assignment.Doing_ID = '$Doing_ID'";
    $result = mysqli_query($db_connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
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

<body>
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
        <div class="card -row" style="padding:25px">
            <div class="card-body">
                <h4 class="card-title text-center"><strong><?php echo "\"", $row['Assignment_title'] . "\" "; ?>Feedback</strong></h4>
                <form class="form-signin ">
                    <ul class="treeview-animated-list mb-3">

                        <div class="row">
                            <div class="col">
                                <i class="fas fa-angle-right"></i>
                                <span><i></i><strong>Compilation</strong></span>
                            </div>
                            <div class="col text-right">
                                <span><i></i><label><strong><?php echo $row['Doing_compilation_grade'] . "/" . $row['Compilation_grade'] ?></strong></label></span>
                            </div>
                        </div>
                        <ul class="nested">
                            <li>
                                <div class="treeview-animated-element">
                                    <i></i>
                                    <p><?php echo $row['Compilation_feedback']; ?></p>
                                </div>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-angle-right"></i>
                                <span><strong>Style</strong></span>
                            </div>
                            <div class="col text-right">
                                <span><i></i><label><strong><?php echo $row['Doing_style_grade'] . "/" . $row['Style_grade'] ?></strong></label></span>
                            </div>
                        </div>
                        <ul class="nested">
                            <li>
                                <div class="treeview-animated-element">
                                    <i></i><label><strong>Comments:</strong></label><br>
                                    <p><?php echo $row['Comment_feedback']; ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="treeview-animated-element">
                                    <i></i><label><strong>Indentation:</strong></label><br>
                                    <p><?php echo $row['Indentation_feedback']; ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="treeview-animated-element">
                                    <i></i><label><strong>Identifiers:</strong></label><br>
                                    <p><?php echo $row['Identifiers_feedback']; ?></p>
                                </div>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-angle-right"></i>
                                <span><i></i><strong>Test Cases</strong></span>
                            </div>
                            <div class="col text-right">
                                <span><i></i><label><strong><?php echo $row['Doing_dynamic_test_grade'] . "/" . $row['Dynamic_test_grade'] ?></strong></label></span>
                            </div>
                        </div>
                        <ul class="nested">
                            <pre><?php echo $row['Dynamic_test_feedback']; ?></pre>
                        </ul>
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-angle-right"></i>
                                <span><i></i><strong>Feature Testing</strong></span>
                            </div>
                            <div class="col text-right">
                                <span><i></i><label><strong><?php echo $row['Doing_feature_test_grade'] . "/" . $row['Feature_test_grade'] ?></strong></label></span>
                            </div>
                        </div>
                        <ul class="nested">
                            <p><?php echo $row['Feature_test_feedback']; ?></p>
                        </ul>
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-angle-right"></i>
                                <span><i></i><strong>Total Grade</strong></span>
                            </div>
                            <div class="col text-right ">
                                <span><i></i><label><strong><?php echo $row['Doing_compilation_grade'] + $row['Doing_style_grade'] + $row['Doing_dynamic_test_grade'] + $row['Doing_feature_test_grade'] . "/" . $row['Full_grade'] ?></strong></label></span>
                            </div>
                        </div>
                        </ul>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footerstyle">
        <p>©Future Marker 2020 Copyright:s</p>
    </div>
</body>

</html>