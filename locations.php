<?php
require_once('Models/LocationDataSet.php');

$locationDataSet = new LocationDataSet();
$view->LocationDataSet = $locationDataSet->fetchLocations();

if (isset($_POST['searchLocButton'])) {
    $search = $_POST['searchText'];
    $view->LocationDataSet = $locationDataSet->searchLocations($search);
}

require_once('Views/locations.phtml');

