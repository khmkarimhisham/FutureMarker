<?php
require 'DB/db.php';
if (isset($_GET['token'])) {
$token=$_GET['token'];
    $sql = "SELECT Email FROM user WHERE token='$token' LIMIT 1";
    $results = mysqli_query($db_connection, $sql);
    $email = mysqli_fetch_assoc($results)['Email'];
} elseif (isset($_POST['new_pass'])) {
    $email=$_POST['email'];
    $new_pass=$_POST['new_pass'];
        $sql = "UPDATE user SET Password='$new_pass' WHERE Email='$email'";
        $results = mysqli_query($db_connection, $sql);

        header('location: login.php');
}else{
    header('location: login.php');

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
    <form class="login-form" action="new_pass.php" method="post">
        <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>" hidden>

        <h2 class="form-title">New password</h2>
        <!-- form validation messages -->
        <div class="form-group">
            <label>New password</label>
            <input type="password" name="new_pass" id="new_pass">
        </div>
        <div class="form-group">
            <label>Confirm new password</label>
            <input type="password" name="new_pass_c">
        </div>
        <div class="form-group">
            <button type="submit" name="new_password" class="login-btn">Submit</button>
        </div>
    </form>
</body>

</html>