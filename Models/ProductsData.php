<?php

class ProductsData {   // products data class

    protected $_id,$_Title, $_Image, $_Price;        // create variables

    public function __construct($dbRow) {
        $this->_id = $dbRow['id'];
        $this->_Title = $dbRow['Title'];            // gather rows from database you need
        $this->_Image = $dbRow['Image'];
        $this->_Price = $dbRow['Price'];

    }

    public function getId() {
        return $this->_id;
    }                                                         // public methods

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


