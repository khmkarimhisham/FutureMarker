<?php

session_start();

if (!isset($_SESSION['User_ID'])) {
    header("Location: login.php");
}

require 'DB/db.php';

if ($_SESSION['User_type'] == "student") {
    header("Location: Home.php");
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $Course_ID = $_GET['course_id'];

    $result1 = mysqli_query($db_connection, "SELECT `Course_name` FROM `course` WHERE `Course_ID` = $Course_ID");
    if (mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $Course_name = $row['Course_name'];
    } else {
        header("Location: course_content.php?course_id=$Course_ID");
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
</head>

<body style="background-color: f0f0f0">

    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark homeheader ">
        <a class="navbar-brand" href="Home.php">
            <img class="navbar-brand" src="images/logo.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card -row my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Add Assignment</h5>
                        <form class="form-signin" method="post" enctype="multipart/form-data" action="add_assignment_logic.php">

                            <input id="Course_ID" name="Course_ID" value=<?php echo $Course_ID; ?> hidden>

                            <div class="container my-3">
                                <label for="deadline">Deadline</label>
                                <input class="mx-3" type="datetime-local" id="deadline" name="deadline" required>
                            </div>

                            <div class="container">
                                <div class="form-label-group">
                                    <input type="text" id="inputtitle" name="inputtitle" class="form-control" placeholder="Titel" required>
                                    <label for="inputtitle">Title</label>
                                </div>
                            </div>

                            <div class="container">
                                <textarea id="summernote" name="summernote"></textarea>
                                <script>
                                    $('#summernote').summernote({
                                        placeholder: 'Descraption',
                                        tabsize: 10,
                                        height: 300,
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
                            </div>
                            <hr class="my-4">

                            <div class="container">
                                <div class="form-label-group">
                                    <input type="number" id="compile" name="compile" class="form-control" placeholder="Dgree Of Compile" required>
                                    <label for="compile">Dgree Of Compile</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="number" id="Styleofcode" name="Styleofcode" class="form-control" placeholder="Dgree Of Code Style" required>
                                    <label for="Styleofcode">Dgree Of Code Style</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="number" id="featureinput" name="featureinput" class="form-control" placeholder="Dgree Of Feature Testing " required>
                                    <label for="featureinput">Dgree Of Feature Testing</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="number" id="dynamicinput" name="dynamicinput" class="form-control" placeholder="Dgree Of Dynamic Testing" required>
                                    <label for="dynamicinput">Dgree Of Dynamic Testing</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="number" id="totalgrade" name="totalgrade" class="form-control" placeholder="Total Grade" required>
                                    <label for="totalgrade">Total Grade</label>
                                </div>
                            </div>
                            <hr class="my-4">

                            <div class="container">

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col">
                                            <label for="attach">Upload Attachment</label>
                                        </div>
                                        <div class="col">
                                            <input type="file" class="form-control-file " id="file1" name="file1">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col">
                                            <label for="attach_model">Upload Model Answer</label>
                                        </div>
                                        <div class="col">
                                            <input type="file" class="form-control-file " id="file2" name="file2">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="container">
                                <h5 class="card-title text-left">Dynamic Testing</h5>
                                <input type="number" id="dynamic_number"  name="dynamic_number" value="0" hidden>

                                <div id="mylocation">
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-primary btn-lg " type="button" onclick="addtoform()">Add</button>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <h5 class="card-title text-left">Feature Testing</h5>
                                <input type="number" id="feature_number" name="feature_number" value="0" hidden>

                                <div id="mylocation2"></div>

                                <div class="text-right">
                                    <button type="button" class="btn btn-primary btn-lg " onclick="addtoform2()">Add</button>
                                </div>
                            </div>
                            <hr>
                            <div class="container">

                                <div class="text-right">
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>