<?php
session_start();
require_once('Models/ProductspageDataSet.php');
$view = new stdClass();
$productspageDataSet = new ProductspageDataSet();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    $Loginname = $_SESSION['email'];
}

$view->countProducts = $productspageDataSet->countProducts();

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

$num_per_page = 12;

$count_rows = $view->countProducts;

$total_pages = ceil($count_rows/$num_per_page);

if(isset($_GET["page"])){
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page-1) * 12;

$view->ProductspageDataSet = $productspageDataSet->fetchAllProducts($start_from, $num_per_page);

require_once('Views/productspage.phtml');

