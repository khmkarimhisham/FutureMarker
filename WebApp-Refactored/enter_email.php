<?php
require 'DB/db.php';
$token = bin2hex(random_bytes(50));
$send_msg = "";
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $sql = "UPDATE user SET user.token ='$token' WHERE user.Email='$email'";
    $results = mysqli_query($db_connection, $sql);
    // Send email to user with the token in a link they can click on
    if ($results) {
        $to = $email;
        $subject = "Reset your password on examplesite.com";
        $msg = "Hi there, click on this <a href=\"http://localhost/FutureMarker/WebApp/new_pass.php?token=" . $token . "\">link</a> to reset your password on our site";
        $msg = wordwrap($msg, 70);
        $header = 'From: fm.futuremarker@gmail.com' . "\r\n" . 'MINE-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=utf-8';
        $stat = mail($to, $subject, $msg, $header);
        if ($stat) {
            $send_msg = "We sent an email to  <b>$email</b> to help you recover your account.";
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset password For Future Marker Account </title>
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
                        <h5 class="card-title text-center">Reset password</h5>
                        <form class="form-signin" action="enter_email.php" method="post">


                            <div class="form-label-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required>
                                <label for="email">Email address</label>
                            </div>
                            <?php
                            if (!empty($send_msg)) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                                    .  $send_msg .
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            }
                            ?>
                            <button class="btn btn-lg btn-primary btn-block " type="submit">Reset</button>
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