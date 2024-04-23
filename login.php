<?php
session_start();
require_once('Models/LoginDataSet.php');
$loginDataSet = new LoginDataSet();

$usernameError = "";
$passwordError = "";
$loginError = "";
$captchaError = "";

$errors1 = array();

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
}

if (isset($_POST['login'])) {

    if(empty($username))
    {
        array_push($errors1, 1);
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
            echo '<script>window.location="productspage.php"</script>';
            $_SESSION['email']     = $username;
            $_SESSION['logged_in'] = true;
        }
        else
        {
            $loginError = "Login Failed!";
        }
    }
}
require_once('Views/login.phtml');