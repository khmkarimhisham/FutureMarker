<?php

session_start();

if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$usertype = $_SESSION['User_type'];
$userID = $_SESSION['User_ID'];

require('DB/db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // print_r($_POST);
   if(isset($_POST['POST-NUM'])){
        $x=$_POST['POST-NUM'];
            $content=$_POST['textarea'.$x];
        $sql=mysqli_query($db_connection,"INSERT INTO `comment` (`Comment_ID`, `User_ID`, `Comment_time`, `Comment_content`, `Post_ID`) VALUES (NULL, $userID, NOW(),'$content', $x)");
        
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
            <div class="col-12 col-md-8">
                <div class="card -row my-5">

                    <div class="card-body">
                        <h>Posts</h>
                        <hr class="my-2">
                        <div class="raw">
                            <?php
                            $user_comment = '';
                            $result = mysqli_query($db_connection, "SELECT * FROM `post` JOIN `enrollment` ON post.Course_ID = enrollment.Course_ID WHERE enrollment.Student_ID = $userID");
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $count_posts = $row['Post_ID'];
                                    $comments = '';

                                    $data_instructor = mysqli_query($db_connection, "SELECT `Instructor_firstname`,`Instructor_lastname`,`Instructor_image` FROM `instructor` WHERE `Instructor_ID`=" . $row['Instructor_ID']);
                                    if ($data_instructor->num_rows > 0) {
                                        $fetch_instructor = $data_instructor->fetch_assoc();
                                        $data_course = mysqli_query($db_connection, "SELECT `Course_name` FROM `course` WHERE `Course_ID`=" . $row['Course_ID']);


                                        $post_date = date("F j, Y, g:i a", strtotime($row['Post_time']));



                                        $data_comment = mysqli_query($db_connection, "SELECT * FROM comment JOIN user ON comment.User_ID = user.User_ID WHERE Post_ID =" . $row['Post_ID']);
                                        if ($data_comment->num_rows > 0) {
                                            while ($fetch_comment = $data_comment->fetch_assoc()) {

                                                $comment_date =  date("F j, Y, g:i a", strtotime($fetch_comment['Comment_time']));
                                                if ($fetch_comment['User_type'] == "instructor") {
                                                    $user_comment = mysqli_query($db_connection, "SELECT * FROM instructor WHERE instructor.Instructor_ID=" . $fetch_comment['User_ID']);
                                                } else {
                                                    $user_comment = mysqli_query($db_connection, "SELECT * FROM student WHERE Student_ID=" . $fetch_comment['User_ID']);
                                                }
                                                $fetch_user_comment = $user_comment->fetch_assoc();

                                                $comments = $comments. ' 
                                                <li class="media">

                                            <a href="#" >
                                                <img src="' . ($fetch_comment['User_type'] == "instructor" ? $fetch_user_comment['Instructor_image'] : $fetch_user_comment['Student_image']) . '" width="30" height="30">
                                            </a>
                                            <div class="media-body">
                                                <span class="text-muted pull-right">
                                                    <small class="text-muted">' . $comment_date . '</small>
                                                </span>
                                                <strong class="text-success">' . ($fetch_comment['User_type'] == "instructor" ? $fetch_user_comment['Instructor_firstname'] . ' ' . $fetch_user_comment['Instructor_lastname'] : $fetch_user_comment['Student_firstname'] . ' ' . $fetch_user_comment['Student_lastname']) . ' </strong>
                                                <p>
                                                    ' . $fetch_comment['Comment_content'] . '
                                                </p>
                                            </div>
                                            </li>

                                       ';
                                            }
                                        }
                                        if ($data_course->num_rows > 0) {

                                            $fetch_course = $data_course->fetch_assoc();

                                            echo '
                                                <div> 
                                                <a href="#"><img src="' . $fetch_instructor['Instructor_image'] . '" width="30" height="30"> </a>
                                                <a href="#">' . $fetch_instructor['Instructor_firstname'] . '    ' . $fetch_instructor['Instructor_lastname'] . '</a>
                                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                <a href="#">' . $fetch_course['Course_name'] . '</a><br>
                                                ' . $post_date . '
                                                </div>
                                                <div class="diveditfirst">
                                                ' . $row['Post_content'] . '' . $row['Post_attachment'] . '
                                                <hr class="my-2">
                                                <div class="row bootstrap snippets">
                                                    <div class="col-12 col-md-8">
                                                        <div class="comment-wrapper">
                                                            <div class="panel panel-info">
                                                                <div class="panel-body">
                                                                <form method="post" id="' . $count_posts . '" name="' . $count_posts . '" >
                                                                     <input type="number" id="POST-NUM" name="POST-NUM" value="'.$count_posts.'" hidden>

                                                                    <textarea name="textarea' . $count_posts . '" id="textarea' . $count_posts . '" class="form-control" placeholder="write a comment..." rows="3"></textarea>
                                                                    <button type="submit" class="btn btn-info pull-right" >comment</button>
                                                                    </form>
                                                                    <div class="clearfix"></div>
                                                                    <hr>
                                                                    <ul class="media-list">
                                                                   ' . $comments . '
                                                                   </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                                ';
                                        }
                                    }
                                }
                            }



                            ?>

                        </div>
                        <hr class="my-2">
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="card -row my-5">
                    <div class="card-body">
                        <div class="raw">
                            <h>upcoming</h>
                            <hr class="my-2">
                            <div class="diveditsecond">
                                <?php

                                $result = mysqli_query($db_connection, "SELECT * FROM `assignment` JOIN `enrollment` ON assignment.Course_ID = enrollment.Course_ID WHERE enrollment.Student_ID = $userID;");

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $assignment_date = $row['Assignment_date'];
                                        $assignment_title = $row['Assignment_title'];
                                        $assignment_id = $row['Assignment_ID'];
                                        $course_id = $row['Course_ID'];
                                        $assignment_due = date("F j, Y, g:i a", strtotime($row['Assignment_deadline']));
                                        echo $assignment_due . '
                                            <hr class="my-1">
                                            <img src="images/assignment_image.png" width="20" height="20">
                                            <a href="Assignment_body.php?course_id=' . $course_id . '&assignment_id=' . $assignment_id . '">' . $assignment_title . '</a><br><br>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="page-footer font-small footerstyle">
        <hr>
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">©Future Marker 2020 Copyright:
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>