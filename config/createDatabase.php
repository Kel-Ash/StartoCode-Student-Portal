<?php
//check if database exists, if not create it
function checkIfDatabaseExits()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_portal";
    $conn = mysqli_connect($servername, $username, $password);
    if (!mysqli_select_db($conn, $dbname)) {

        $createDatabase = "CREATE DATABASE IF NOT EXISTS $dbname";
        mysqli_query($conn, $createDatabase);
    }
    mysqli_close($conn);
}

//check if table exist
function checkIfTableExist()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "student_portal";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $checkTable = "SELECT 1 FROM student LIMIT 1";
    $result = mysqli_query($conn, $checkTable);
    if ($result) {
        echo "Table already exists";
    } else {
        echo "Table does not exist, creating table";
    }
}
checkIfDatabaseExits();
checkIfTableExist();
