<?php

class LocationData {                       // productspage class

    protected $_id, $_city, $_lat, $_long, $_centerLat, $_centerLong, $_title;

    public function __construct($dbRow) {                   // fetch rows from database
        $this->_id = $dbRow['idLocations'];
		$this->_city = $dbRow['City'];
        $this->_lat = $dbRow['Lat'];
        $this->_long = $dbRow['long'];
        $this->_centerLat = $dbRow['CenterLat'];
        $this->_centerLong = $dbRow['CenterLong'];
        $this->_title = $dbRow['Title'];
    }

    public function getId() {                       // public methods to return rows
        return $this->_id;
    }

    public function getCity(){
        return $this->_city;
    }

    public function getLat() {
        return $this->_lat;
    }

    public function getLong() {
        return $this->_long;
    }

    public function getCenterLat() {
        return $this->_centerLat;
    }

    public function getCenterLong() {
        return $this->_centerLong;
    }
    public function getTitle() {
        return $this->_title;
    }
}


