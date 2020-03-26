<?php
require 'DB/db.php';
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT Email FROM user WHERE token='$token' LIMIT 1";
    $results = mysqli_query($db_connection, $sql);
    $email = mysqli_fetch_assoc($results)['Email'];
} elseif (isset($_POST['new_pass'])) {

    $email = $_POST['email'];
    $new_pass = $_POST['new_pass'];
    $confirm_password = $_POST["new_pass_c"];
    if ($new_pass != $confirm_password) {
        $error_message = $error_message . "• Password did not match.<br>";
    } else {
        $sql = "UPDATE user SET Password='$new_pass' WHERE Email='$email'";
        $results = mysqli_query($db_connection, $sql);
        if ($results) {

            header('location: login.php');
        }
    }
} else {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset password</title>
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

    <div class="signupheader ">
        <nav class="navbar navbar-expand-sm navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="index.php">
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
                        <h5 class="card-title text-center">Change Password</h5>
                        <form class="form-signin" action="new_pass.php" method="post">
                            <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>" hidden>


                            <div class="form-label-group">
                                <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Password" required>
                                <label for="new_pass">Password</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="new_pass_c" name="new_pass_c" class="form-control" placeholder="Password" required>
                                <label for="new_pass_c">Confirm password</label>
                            </div>
                            <?php
                            if (!empty($error_message)) {
                                echo '<div class="alert alert alert-danger alert-dismissible fade show" role="alert">'
                                    .  $error_message .
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            }
                            ?>
                            <button class="btn btn-lg btn-primary btn-block " type="submit">Change</button>
                            <a class="d-block text-center mt-2 small" href="login.php">log in </a>
                            <a class="d-block text-center mt-2 small" href="signup.php">Don`t have account? Sign Up</a>

                            <hr class="my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>