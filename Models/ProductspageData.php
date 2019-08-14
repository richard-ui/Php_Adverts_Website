<?php

class ProductspageData {                       // productspage class

    protected $_id,$_Title, $_Image, $_Price, $_Location;

    public function __construct($dbRow) {                   // fetch rows from database
        $this->_id = $dbRow['id'];
        $this->_Title = $dbRow['Title'];
        $this->_Image = $dbRow['Image'];
        $this->_Price = $dbRow['Price'];
//        $this->_Location = $dbRow['location'];

    }

    public function getId() {                       // public methods to return rows
        return $this->_id;
    }

    public function getTitle() {
        return $this->_Title;
    }

    public function getImage() {
        return $this->_Image;
    }

    public function getPrice() {
        return $this->_Price;
    }


//    public function getLocation() {
//        return $this->_Location;
//    }

}


