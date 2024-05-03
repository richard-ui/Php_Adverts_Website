<?php

class ProductspageData {

    protected $_id,$_Title, $_Image, $_Price, $_Location;

    public function __construct($dbRow) {
        $this->_id = $dbRow['id'];
        $this->_Title = $dbRow['Title'];
        $this->_Image = $dbRow['Image'];
        $this->_Price = $dbRow['Price'];
    }

    public function getId() {
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
}


