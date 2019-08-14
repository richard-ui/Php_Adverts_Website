<?php

require_once ('Models/Database.php');
require_once ('Models/postAdvertsData.php');

class postAdvertsDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }


    public function postAdvert()                    // function to post adverts created here
    {
        $pic=($_FILES['userfile']['name']);

        $sqlquery = "INSERT INTO phones (id, Title, Image, Price, Color, BrandName) VALUES ('" . $_POST["advertid"] . "','" . $_POST["title"] . "','" . $pic . "','" . $_POST["price"] . "','" . $_POST["colour"] . "','" . $_POST["brandname"] . "')";

        $statement = $this->_dbHandle->prepare($sqlquery);
        $statement->execute();    // run statement

    }
    public function postAdvert1($id, $title, $pic, $price, $color, $brandname)                    // function to post adverts created here
    {
        //$pic=($_FILES['userfile']['name']);

        $sqlquery = "INSERT INTO phones (id, Title, Image, Price, Color, BrandName) VALUES ('" . $id . "','" . $title . "','" . $pic . "','" . $price . "','" . $color . "','" . $brandname . "')";

        $statement = $this->_dbHandle->prepare($sqlquery);
        $statement->execute();    // run statement

    }
    public function postFruit($id, $fruitname, $image, $fruitid)                    // function to post adverts created here
    {
        $sqlquery = "INSERT INTO Fruits (id, fruit_name, image, fruitID) VALUES ('" . $id . "','" . $fruitname . "','" . $image . "','" . $fruitid . "')";

        $statement = $this->_dbHandle->prepare($sqlquery);
        $statement->execute();    // run statement

    }

    public function userId($id)
    {
        $sqlQuery = "select id from phones WHERE id = '$id'";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}