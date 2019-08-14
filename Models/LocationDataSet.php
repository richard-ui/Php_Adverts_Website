<?php

require_once ('Models/Database.php');
require_once ('Models/LocationData.php');

class LocationDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchLocations()              
    {

        $sqlQuery = "SELECT phones.Title, Locations.idLocations, Locations.City, Locations.Lat, Locations.`long`, Locations.CenterLat, Locations.CenterLong
        FROM phones
        INNER JOIN Locations on phones.locID = Locations.idLocations
        "; // inner join binds only primary key and foreign key together

        $statement = $this->_dbHandle->prepare($sqlQuery);           // prepares query
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {                        // while loop to loop through rows
            $dataSet[] = new LocationData($row);
        }
        return $dataSet;
    }



    public function searchLocations($searchText)              // function to display products from phones table
    {
        $sqlQuery = "SELECT phones.Title, Locations.idLocations, Locations.City, Locations.Lat, Locations.`long`, Locations.CenterLat, Locations.CenterLong
        FROM phones
        INNER JOIN Locations on phones.locID = Locations.idLocations
        where City like '%" . $searchText. "%'
        ";

        $statement = $this->_dbHandle->prepare($sqlQuery);           // prepares query
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {                        // while loop to loop through rows
            $dataSet[] = new LocationData($row);
        }
        return $dataSet;                                  // return dataset
    }


}

