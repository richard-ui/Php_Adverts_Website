<?php
session_start();
require_once('Models/ProductspageDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Products';
if(isset($_SESSION['LoginName'])) {
    $Loginname = $_SESSION['LoginName']; //created session for logged in user
}

if(isset($_SESSION['watchlist'])){
$watchlist = $_SESSION['watchlist'];
}

$productspageDataSet = new ProductspageDataSet();

$view->ProductspageDataSet = $productspageDataSet->productsPaginate(); // function to display products

if(isset($_GET['id'])){
    $ajaxid = $_GET['id'];
    echo "hello " . $ajaxid;
    $view->ProductspageDataSet = $productspageDataSet->fetchAjaxHintID($ajaxid);
}

if(isset($_POST['searchtext'])) {
    $searchtext = $_POST['searchtext'];
}

if (isset($_POST['search'])) {

$view->ProductspageDataSet = $productspageDataSet->searchProducts($searchtext);

}

require_once('Views/productspage.phtml');

