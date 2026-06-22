<?php
include_once(__DIR__ . '/../config/connectionDB.php');
session_start();
global $errorMessage;
$errorMessage = array();

if (isset($_POST['submit'])) {

    isFieldFilled($_FILES['user-image']['name'] ?? "", "Front Image is required", 'user-image');
    validateFirstName($_POST['user-firstname'] ?? "", "First Name must be required", 'user-firstname');
    validateMiddleName($_POST['user-middlename'] ?? "", "Middle Name must be required", 'user-middlename');
    validateLastName($_POST['user-lastname'] ?? "", "Last Name must be required", 'user-lastname');
    validateEmailAddress($_POST['user-email'] ?? "", "Invalid Email Address", 'user-email');
    isFieldFilled($_POST['user-date-of-birth'] ?? "", "Date of Birth is required", 'user-date-of-birth');
    isFieldFilled($_POST['gender'] ?? "", "Please select a gender", 'gender');
    validatePhoneNumber($_POST['user-phone'] ?? "", "Invalid Phone Number", 'user-phone');
    isFieldFilled($_POST['user-address'] ?? "", "Address is required", 'user-address');
    isFieldFilled($_POST['user-state-of-origin'] ?? "", "State of Origin is required", 'user-state-of-origin');
    isFieldFilled($_POST['user-local-government'] ?? "", "Local Government is required", 'user-local-government');
    validateNextOfKin($_POST['user-next-of-kin'] ?? "", "Next of Kin is required", 'user-next-of-king');
    validateJambScore($_POST['user-jamb-score'] ?? "", "Invalid Jamb Score", 'user-jamb-score');


    $image = $_FILES['user-image']['name'] ?? "";
    $firstName = $_POST['user-firstname'];
    $middleName = $_POST['user-middlename'];
    $lastName = $_POST['user-lastname'];
    $email = $_POST['user-email'];
    $dateOfBirth = $_POST['user-date-of-birth'];
    $gender = $_POST['gender'] ?? "";
    $phone = $_POST['user-phone'];
    $address = $_POST['user-address'];
    $stateOfOrigin = $_POST['user-state-of-origin'];
    $localGovernment = $_POST['user-local-government'];
    $nextOfKin = $_POST['user-next-of-kin'];
    $jambScore = $_POST['user-jamb-score'];



    global $errorMessage;
    if (empty($errorMessage)) {


        $sql = "INSERT INTO student (photo, firstName, middleName, lastName, email, DOB, gender, phoneNumber, address, stateOfOrigin, localGovernment, nextOfKin, jambScore) 
                VALUES ('$image', '$firstName', '$middleName', '$lastName', '$email', '$dateOfBirth', '$gender', '$phone', '$address', '$stateOfOrigin', '$localGovernment', '$nextOfKin', '$jambScore')";

        if (mysqli_query($conn, $sql)) {
            $errorMessage = array();
            header("Location: studentRecord.php");
            exit();
        } else {
            die("Database insertion failed: " . mysqli_error($conn));
        }
    }
}

function displayInputValue($key)
{
    if (isset($_POST[$key])) {
        echo $_POST[$key];
    }
}
function displayErrorMessage($key)
{
    global $errorMessage;
    if (array_key_exists($key, $errorMessage)) {
        echo $errorMessage[$key];
    }
}

function isFieldFilled($value, $error, $key)
{
    if (!isset($value) || trim($value) === "") {
        global $errorMessage;
        $errorMessage[$key] = $error;
    }
}

function validateFirstName($firstName, $error, $key)
{
    if (empty(trim($firstName)) || !preg_match("/^[a-zA-Z]+$/", $firstName)) {
        global $errorMessage;
        $errorMessage[$key] = $error;
    }
}
function validateMiddleName($middleName, $error, $key)
{
    if (empty(trim($middleName)) || !preg_match("/^[a-zA-Z\s]+$/", $middleName)) {
        global $errorMessage;
        $errorMessage[$key] = $error;
    }
}
function validateLastName($lastName, $error, $key)
{
    if (empty(trim($lastName)) || !preg_match("/^[a-zA-Z]+$/", $lastName)) {
        global $errorMessage;
        $errorMessage[$key] = $error;
    }
}


function validateEmailAddress($email, $error, $key)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        global $errorMessage;
        $errorMessage[$key] = $error;
    }
}

function validateNextOfKin($nextOfKin, $error, $key)
{
    if (empty(trim($nextOfKin)) || !preg_match("/^[a-zA-Z\s]+$/", $nextOfKin)) {
        global $errorMessage;
        $errorMessage[$key] = $error;
    }
}

function validatePhoneNumber($phone, $error, $key)
{
    global $errorMessage;
    $cleanPhone = preg_replace('/[\s\-()]/', '', $phone);
    if (empty($cleanPhone) || !preg_match("/^[0-9]{10,15}$/", $cleanPhone)) {
        $errorMessage[$key] = $error;
    }

    return $cleanPhone;
}

function validateJambScore($jambScore, $error, $key)
{
    global $errorMessage;
    if (empty($jambScore) || !is_numeric($jambScore) || $jambScore < 0 || $jambScore > 400) {
        $errorMessage[$key] = $error;
    }
}
