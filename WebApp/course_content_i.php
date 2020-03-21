<?php

session_start();

if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}
$usertype = $_SESSION['User_type'];

require 'DB/db.php';
include "php_file_tree.php";

if (isset($_GET['assignment'])) {
    $assignment_msg = 'Assignment Uploaded Successfully';
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $Course_ID = $_GET['course_id'];

    $result1 = mysqli_query($db_connection, "SELECT * FROM `course` WHERE `Course_ID` = $Course_ID");
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




    <div class="my-2">
        <?php
        if (!empty($assignment_msg)) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                .  $assignment_msg .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
        }
        ?>
    </div>
    <div class="row">
        <div class="col" style="margin-left: 25px;">
            <div class="card -row my-2">
                <div class="card-body">
                    <div>
                        <img src="<?php echo $Course_image; ?>" style="width: 260px;" class="rounded mx-auto d-block" alt="Course Image">
                    </div>
                    <div>
                        <hr class="my-2">
                        <div> <a class="aedit active" href="#"> <label>Material</label></a></div>
                        <hr class="my-3">
                        <div> <a class="aedit" href="Home.php"> <label>Posts</label></a></div>
                        <hr class="my-3">
                        <div> <a class="aedit" href="courses_Grades.php?course_id=<?php echo $Course_ID; ?>"> <label>Grades</label></a></div>
                        <hr class="my-3">
                        <div> <a class="aedit" href="Members.php?course_id=<?php echo $Course_ID ?>"> <label>Members</label></a></div>
                        <hr class="my-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card -row my-2">
                <div class="card-body">
                    <div>
                        <h4><strong><?php echo $Course_name; ?></strong></h4>

                    </div>
                    <div class="text-right">
                        <button type="submit" name="uploadfile" class="btn btn-outline-secondary " data-toggle="modal" data-target="#uploadfile">Upload File</button>
                    </div>
                    <div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" enctype="multipart/form-data">



                                    <div class="modal-body text-center">
                                        <div class="form-group">
                                          <select class="browser-default custom-select">
                                                <option selected="">Choose folder</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="Ufile">Choose file</label>
                                                <input type="file"id="Ufile" name="Ufile" class="text-center center-block file-upload" style="margin-left: 40px;">
                                            </div>


                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-secondary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div><label><?php echo $Course_des; ?></label></div>
                    <div><label><?php echo "Access Code : " . $Course_AC; ?></label></div>
                    <hr class="my-2 ">
                    <div class="container text-right">
                            <a href="#" data-toggle="modal" data-target="#createfolder">
                                <label style="font-size: 16;font-weight: bold;">Create Folder</label>
                            </a>
                        </div>
                        <div class="modal fade" id="createfolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Craete Folder</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" enctype="multipart/form-data">



                                    <div class="modal-body text-center">
                                        
                                        <div class="form-group">
                                                <label for="foldername">Folder Name</label>
                                                <input type="text" class="form-control" name="foldername" id="foldername" placeholder="Folder Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="folderfile">Choose file</label>
                                                <input type="file"id="folderfile" name="folderfile" class="text-center center-block file-upload" style="margin-left: 40px;">
                                            </div>
                                        


                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-secondary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <table class="table table-sm table-light ">
                            <?php
                            echo php_file_tree($Course_dir, "[link]");
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col" style="margin-right: 25px;">
            <div class="card -row my-2">
                <div class="card-body">
                    <div class="raw">
                        <h4><strong>Assignment</strong></h4>
                        <hr class="my-2">
                        <div class="diveditsecond">
                            <?php

                            $result = mysqli_query($db_connection, "SELECT * FROM `assignment` WHERE `Course_ID` = $Course_ID;");

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $assignment_date = $row['Assignment_date'];
                                    $assignment_title = $row['Assignment_title'];
                                    $assignment_id = $row['Assignment_ID'];

                                    $assignment_due = date("F j, Y, g:i a", strtotime($row['Assignment_deadline']));
                                    echo $assignment_due . '
                                            <hr class="my-1">
                                            <img src="images/assignment_image.png" width="20" height="20">
                                            <a href="Assignment_body.php?course_id=' . $Course_ID . '&assignment_id=' . $assignment_id . '">' . $assignment_title . '</a><br><br>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-secondary " onclick="window.location.href='add_assignment.php?course_id=<?php echo $Course_ID; ?>'">Add Assignmnet</button></div>
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