<?php

require_once ('Models/Database.php');
require_once ('Models/postAdvertsData.php');

class postAdvertsDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function postAdvert1($id, $title, $pic, $price, $color, $brandname)                    // function to post adverts created here
    {
        $sqlquery = "INSERT INTO phones (id, Title, Image, Price, Color, BrandName) VALUES ('" . $id . "','" . $title . "','" . $pic . "','" . $price . "','" . $color . "','" . $brandname . "')";
        $statement = $this->_dbHandle->prepare($sqlquery);
        $statement->execute();    // run statement

    }

    public function getPhoneId($id)
    {
        $sqlQuery = "select id from phones WHERE id = '$id'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}