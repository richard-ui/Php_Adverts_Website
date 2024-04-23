<?php
session_start();

if(isset($_GET['q'])){
    echo '<script>window.location="login.php"</script>';
    unset($_SESSION['logged_in']);
    // Finally, destroy the session.    
    session_destroy();
}