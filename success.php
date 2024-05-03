<?php
session_start();
$view = new stdClass();

unset($_SESSION["cart"]);

require_once('Views/success.phtml');