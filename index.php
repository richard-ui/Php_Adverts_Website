<?php
$view = new stdClass();
$view->pageTitle = 'Homepage';

$host = 'helios.csesalford.com';
$user = 'mvb620';
$pass = 'muffin11//';
$dbName = 'mvb620';

$con = mysqli_connect($host, $user, $pass, $dbName);

$sqlQuery = "SELECT phones.Title, Locations.idLocations, Locations.City, Locations.Lat, Locations.`long`, Locations.CenterLat, Locations.CenterLong
FROM phones
INNER JOIN Locations on phones.locID = Locations.idLocations
";

$result = mysqli_query($con, $sqlQuery);

if(mysqli_num_rows($result) > 0)
{
  while($row = mysqli_fetch_array($result))
  {
   echo $row["Title"] . ', ' . $row["City"] . '</br>';
  }

}


require_once('Views/index.phtml');
