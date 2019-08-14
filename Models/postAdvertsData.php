<?php

class postAdvertsData {

    protected $_Id, $_Title, $_Image, $_Price, $_Color, $_BrandName;

    public function __construct($dbRow) {
        $this->_Id = $dbRow['id'];
        $this->_Title = $dbRow['Title'];
        $this->_Image = $dbRow['Image'];
        $this->_Price = $dbRow['Price'];
        $this->_Color = $dbRow['Color'];
        $this->_BrandName = $dbRow['BrandName'];

    }
    public function getId() {
        return $this->_Id;
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

    public function getColor() {
        return $this->_Color;
    }

    public function getBrandName() {
        return $this->_BrandName;
    }

}
