<?php
session_start();
require_once('Models/LocationDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Locations Page';

$locationDataSet = new LocationDataSet();

$view->LocationDataSet = $locationDataSet->fetchLocations(); // function to display products


if (isset($_POST['searchLocButton'])) {

    $search = $_POST['searchText'];
    $view->LocationDataSet = $locationDataSet->searchLocations($search);

}


require_once('Views/locations.phtml');

