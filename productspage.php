<?php
// phpinfo();
// exit();
session_start();
require_once('Models/ProductspageDataSet.php');
$view = new stdClass();
$productspageDataSet = new ProductspageDataSet();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    $Loginname = $_SESSION['email'];
}

if(isset($_SESSION['watchlist'])){
    $watchlist = $_SESSION['watchlist'];
}

$view->ProductspageDataSet = $productspageDataSet->fetchAllProducts();

if(isset($_GET['id'])){
    $ajaxid = $_GET['id'];
    $view->ProductspageDataSet = $productspageDataSet->fetchAjaxHintID($ajaxid);
}

if(isset($_POST['searchtext'])) {
    $searchtext = $_POST['searchtext'];
}

if (isset($_POST['search'])) {
    $view->ProductspageDataSet = $productspageDataSet->searchProducts($searchtext);
}

require_once('Views/productspage.phtml');

