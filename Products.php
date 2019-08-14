<?php
session_start();
require_once('Models/ProductsDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Products';


$productsDataSet = new ProductsDataSet();
$view->ProductsDataSet = $productsDataSet->fetchAllProducts();


require_once('Views/Products.phtml');

