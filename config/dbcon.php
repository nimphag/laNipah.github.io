<?php 

// connect your database
$con = mysqli_connect("localhost","root","","hotel");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

function redirect($page, $status)
{
    $_SESSION['status'] = "$status";
    header("Location: $page");
    exit(0);
}

?>