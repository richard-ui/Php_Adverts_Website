<?php
$view = new stdClass();
$view->pageTitle = 'querystring';

require_once('Models/ProductspageDataSet.php');

$productspageDataSet = new ProductspageDataSet();

//$view->ProductspageDataSet = $productspageDataSet->productsPaginate();
$view->ProductspageDataSet = $productspageDataSet->products_FK();

//$productspageDataSet->productsPaginateCount();

//$results_per_page = 5;

//$number_of_pages = ceil($productspageDataSetCount->productsPaginateCount() / $results_per_page);
//echo $number_of_pages;
//
//for($page=1;$page<=$number_of_pages;$page++){
//            echo '<a href="productspage.php?page=' . $page . '">' . $page . '</a> ';
//}

require_once('Views/paginate.phtml');

