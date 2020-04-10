<?php

session_start();
require('DB/db.php');
if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}

if ($_SESSION['User_type'] == "student") {
    header("Location: courses_student.php");
}
$User_ID = $_SESSION['User_ID'];
$error_message = "";
if (isset($_GET['submit']) && isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $sql = "SELECT * FROM course WHERE Course_ID =$course_id";
    $result = mysqli_query($db_connection, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $Course_name = $row['Course_name'];
        $Course_image =  $row['Course_image'];
    }
    $post_desc = $_GET['summernote'];
    do {
        $doc_name = rand() . '.doc';
        $doc_dir = "uploads/post/$doc_name";
    } while (file_exists($doc_dir));
    file_put_contents($doc_dir, $post_desc);
    $sql1 = "INSERT INTO `post`( `Instructor_ID`, `Course_ID`, `Post_content`, `Post_attachment`) VALUES ($User_ID,$course_id,'$doc_dir',NULL)";
    $result1 = mysqli_query($db_connection, $sql1);
    if ($result1) {
        $error_message = "The post is uploaded successfully ";
    } else {
        $error_message = "Invalid Access Code";
    }
} else if (isset($_GET['course_id'])) {

    $Course_ID = $_GET['course_id'];
    $sql2 = "SELECT * FROM course WHERE Course_ID =$Course_ID";
    $result2 = mysqli_query($db_connection, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        $row = mysqli_fetch_assoc($result2);
        $Course_name = $row['Course_name'];
        $Course_image =  $row['Course_image'];
    } else {
        header("Location: course_content_i.php?course_id=$Course_ID");
    }
} else {
    header("Location: courses_instructor.php");
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="JS/add_assignment.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-lite.min.js"></script>
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
            <div class="col">
                <div class="card -row" style=" border-radius: 25px;">
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
            <div class="col-8">
                <div class="card -row" style=" border-radius: 25px;">
                    <div class="card-body">
                        <label class="profilelebal" style="font-size: 20"><?php echo $Course_name ?></label><br>
                        <label class="profilelebal" style="font-size: 18">Updates</label>
                        <hr class="my-1">
                        <form class="form-signin" method="GET" enctype="multipart/form-data">
                            <div class="container">
                                <input type="text" id="course_id" name="course_id" class="form-control" value="<?php echo $Course_ID; ?>" hidden>
                                <?php echo $error_message ?>
                                <textarea id="summernote" name="summernote"></textarea>
                                <script>
                                    $('#summernote').summernote({
                                        placeholder: 'Descraption',
                                        tabsize: 10,
                                        height: 100,
                                        toolbar: [
                                            ['style', ['style']],
                                            ['font', ['bold', 'underline', 'clear']],
                                            ['color', ['color']],
                                            ['para', ['ul', 'ol', 'paragraph']],
                                            ['table', ['table']],
                                            ['insert', ['link', 'picture', 'video']],
                                            ['view', ['fullscreen', 'codeview', 'help']]
                                        ]
                                    });
                                </script>
                                <div class="text-right" style="margin-top: 20px;">
                                    <button type="submit" name="submit" class="btn btn-primary">Post</button>
                                </div>
                            </div>

                        </form>
                        <hr>



                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>