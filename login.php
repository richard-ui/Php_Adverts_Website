<?php
require_once('Models/LoginDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Login';
$loginDataSet = new LoginDataSet();             // stores a login dataset class

session_start();                                // allows me to starts a session
//main edited verion...


$usernameError = "";                            // error variables will begin as empty
$passwordError = "";
$loginError = "";
$captchaError = "";

$errors1 = array(); // array created to store errors

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];                   // posted details posted by user
// st
}

if (isset($_POST['login'])) {

    if(empty($username))
    {
        array_push($errors1, 1);                     // if empty add to array
        $usernameError = "Username required";
    }

    if(empty($password))
    {
        array_push($errors1, 2);
        $passwordError = "Password required";
    }

    if(isset($_POST['check'])) {
        if ($_POST['check'] != NULL) {                     // if checkbox ticked..
            setcookie('username', $username, time() + 3600);      // then stores a cookie of the users username and password for a limited time
            setcookie('password', $password, time() + 3600);
        }
    }

    if (count($errors1) == 0)
    {
        $password = md5($password);
        $result = $loginDataSet->login($username, $password);


        if ($result['email'])
        {
            // if array empty/ if username and encrypted password valid from database table/ if session answer equals correct answer then....

            echo '<script>window.location="productspage.php"</script>';     // ...the site will locate the user to the productspage...
            $_SESSION['LoginName'] = $username;                             // ...and also the site will store a session of the user 'username'
        }
        else
        {
            $loginError = "Login Failed!";               // ...else user has failed to login
            unset($_SESSION['LoginName']);               // and users session will be unset
        }
    }
}








//
//$usernameError = "";                            // error variables will begin as empty
//$passwordError = "";
//$loginError = "";
//$captchaError = "";
//
//$errors1 = array();                            // array created to store errors
//
//$username = $_POST['user'];
//$password = $_POST['pass'];                   // posted details posted by user
//$result = $loginDataSet->login($username, $password);     // stores login dataset function named 'login' into a variable named 'result'
//
//if (isset($_POST['login'])) {                 // if login button is clicked
//    if(empty($username)){
//        array_push($errors1, 1);                     // if empty add to array
//        $usernameError = "Username required";
//    }
//
//    if(empty($password)){
//        array_push($errors1, 2);
//        $passwordError = "Password required";
//    }
//
//
//   if($_POST['check'] != NULL){                     // if checkbox ticked..
//       setcookie('username', $username, time() + 3600);      // then stores a cookie of the users username and password for a limited time
//       setcookie('password', $password, time() + 3600);
//   }
//
//    if(empty($errors1) && ($result['email']) && $_SESSION['answer'] == $_POST['answer']){
//       // if array empty/ if username and password valid from database table/ if session answer equals correct answer then....
//
//       echo '<script>window.location="productspage.php"</script>';     // ...the site will locate the user to the productspage...
//       $_SESSION['LoginName'] = $username;                             // ...and also the site will store a session of the user 'username'
//    }
//    else
//    {
//        $loginError = "Login Failed!";               // ...else user has failed to login
//        unset($_SESSION['LoginName']);               // and users session will be unset
//    }
//}




require_once('Views/login.phtml');