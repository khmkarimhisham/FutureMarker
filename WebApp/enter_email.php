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
        $header='From: fm.futuremarker@gmail.com' . "\r\n".'MINE-Version: 1.0' . "\r\n".'Content-Type: text/html; charset=utf-8';
        $stat = mail($to, $subject, $msg,$header);
        if ($stat) {
            $send_msg = "We sent an email to  <b>$email</b> to help you recover your account.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Reset PHP</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
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
    <form class="login-form" action="enter_email.php" method="post">
        <h2 class="form-title">Reset password</h2>
        <div class="form-group">
            <label>Your email address</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <button type="submit" name="reset-password" class="login-btn">Submit</button>
        </div>
    </form>
</body>

</html>