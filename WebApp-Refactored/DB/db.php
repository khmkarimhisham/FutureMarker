<?php
$db_connection = mysqli_connect("localhost","root","","futuremarker");
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>