<?php
$view = new stdClass();
$view->pageTitle = 'getHint';

require_once('Models/ProductspageDataSet.php');
$productspageDataSet = new ProductspageDataSet();

if(!empty($_GET['q']))
{
    $q = $_GET['q'];

    $view->ProductspageDataSet = $productspageDataSet->searchtextforAjax($q);
    $array = [];

    foreach ($view->ProductspageDataSet as $productData){
        $array[] = [
            'id' => $productData->getId(),
            'image' => $productData->getImage(),
            'name' => $productData->getTitle(),
            'price' => $productData->getPrice(),
        ];
    }
    if ($array == "") {
        echo $array === "" ? "no suggestions" : $array;
    }
    else {
        echo json_encode($array);
    }

}









