<?php

require_once 'DB/db.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST["user_type"];
    $firstname = $_POST["inputfirstname"];
    $lastname = $_POST["inputlastname"];
    $email = $_POST["inputEmail"];
    $password = $_POST["inputPassword"];
    $confirm_password = $_POST["inputConfirmPassword"];
    if ($password != $confirm_password) {
        $error_message = $error_message . "Password did not match.\n";
    }
    $sql_stat = "SELECT `Email` FROM `user` WHERE `Email` = '$email';";
    $query = mysqli_query($db_connection, $sql_stat);

    if ($query->num_rows > 0) {
        $error_message = $error_message . "Email is already exist.\n";
    }
    if (empty($error_message)) {
        $query = mysqli_query($db_connection, "INSERT INTO `user`(`Email`, `Password`) VALUES ('$email','$password');");
        if ($query) {
            $result = mysqli_query($db_connection, "SELECT `User_ID` FROM `user` WHERE `Email` = '$email'");
            if ($result->num_rows > 0) {
                $id = ($result->fetch_assoc())["User_ID"];
                if ($user_type == "instructor") {
                    $query2 = mysqli_query($db_connection, "INSERT INTO `instructor`(`Instructor_ID`, `Instructor_firstname`, `Instructor_lastname`, `Instructor_email`) VALUES ('$id','$firstname','$lastname','$email');");
                } else if ($user_type == "student") {
                    $query2 = mysqli_query($db_connection, "INSERT INTO `student`(`Student_ID`, `Student_firstname`, `Student_lastname`, `Student_email`) VALUES ('$id','$firstname','$lastname','$email');");
                }
                if (!$query2) {
                    $error_message = $error_message . "There is a problem, Please try again later.\n";
                }
            }
            header('Location: login.php');
        } else {
            $error_message = $error_message . "There is a problem, Please try again later.\n";
        }
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Sign Up For Future Marker Account </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/style.css">
    <script type="text/javascript" src="JS/index.js"></script>
</head>

<body>
    <!-- Navigation -->
    <div class="signupheader ">
        <nav class="navbar navbar-expand-sm navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img class="navbar-brand" src="images/logo.png">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card card-signin flex-row my-5">
                    <div class="card-img-left d-none d-md-flex" style=" background-image: url('images/signup.jpg');">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Register</h5>
                        <form class="form-signin" method="post">
                            <div class="form-label-group">
                                <select name="user_type" class="form-control">
                                    <option value="instructor">instructor</option>
                                    <option value="student">student</option>
                                </select>
                            </div>
                            <div class="form-label-group">
                                <input type="text" id="inputfirstname" name="inputfirstname" class="form-control" placeholder="Username" required autofocus>
                                <label for="inputfirstname">First Name</label>
                            </div>
                            <div class="form-label-group">
                                <input type="text" id="inputlastname" name="inputlastname" class="form-control" placeholder="Username" required>
                                <label for="inputlastname">Last Name</label>
                            </div>
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required>
                                <label for="inputEmail">Email address</label>
                            </div>
                            <hr>
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="inputConfirmPassword" name="inputConfirmPassword" class="form-control" placeholder="Password" required>
                                <label for="inputConfirmPassword">Confirm password</label>
                            </div>
                            <?php echo '<span class="text-danger">' . $error_message . '</span>'; ?>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button>
                            <a class="d-block text-center mt-2 small" href="login.html">Have an account? Login</a>
                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>