<?php
$view = new stdClass();
$view->pageTitle = 'Register';

require_once('Models/registerDataSet.php');


$firstnameError = "";
$lastnameError = "";
$password1Error = "";
$password2Error = "";
$emailError = "";
$addressError = "";
$phoneError = "";

$useregister = "";

if(isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $firstname = ($_POST["firstname"]);
    $email = ($_POST["email"]);
    $phone = ($_POST["phone"]);
}

$errors = array();         // array that will gather errors

$registerDataSet = new registerDataSet();

// On submitting form below function will execute.
if(isset($_POST['register'])) {

    if (empty($_POST["firstname"])) {
        array_push($errors, 1);
        $firstnameError = "FirstName is required";
    }

    if (empty($_POST["lastname"])) {
        array_push($errors, 1);
        $lastnameError = "LastName is required";
    }
                                                                 // check name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
        array_push($errors, 2);
        $firstnameError = "Only letters and white space allowed";
    }

    if(empty($_POST["password_1"])){
        array_push($errors, 3);
        $password1Error = "Password required";
    }

    if(empty($_POST["password_2"])){
        array_push($errors, 4);
        $password2Error = "Password required";
    }
    if ($_POST['password_1'] != $_POST['password_2']){
        array_push($errors, 5);
        $password2Error = "Passwords do not match!";
    }
    if (empty($_POST["email"])) {
        array_push($errors, 6);
        $emailError = "Email is required";
    }
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {          // check email right format
        array_push($errors, 7);
        $emailError = "Invalid email format!";
    }
    if(empty($_POST["address"])){
        array_push($errors, 8);
        $addressError = "Address required";
    }
    if(empty($_POST["phone"])){
        array_push($errors, 9);
        $phoneError = "Phone No* is required";
    }
    if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone)) {         // phone must be format of 3-3-4 e.g. 076-576-3456
        array_push($errors, 10);
        $phoneError = "Invalid Phone No*";
    }
    if (strlen($_POST['password_1']) < 6) {
        array_push($errors, 10);
        $password1Error = "Password must not be less than 5 characters!";
    }

    if (!preg_match("#[0-9]+#", $_POST['password_1'])) {
        array_push($errors, 10);
        $password1Error = "Password must include at least one number!";
    }
    if (!preg_match("#[!?@£$%^&*()]+#", $_POST['password_1'])) {
        array_push($errors, 10);
        $password1Error = "Requires special symbol!!";
    }

    if (!preg_match("#[a-zA-Z]+#", $_POST['password_1'])) {
        array_push($errors, 10);
        $password1Error = "Password must include at least one letter!";
    }

    if (empty($errors)){
        $useregister = "User has been registered!";
        $registerDataSet->signupuser();
    }
}



require_once('Views/register.phtml');