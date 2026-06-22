<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_portal";

//connect to database
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
