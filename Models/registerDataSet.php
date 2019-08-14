<?php

require_once ('Models/Database.php');
require_once ('Models/registerData.php');

class registerDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function signupuser()           // main function that gathers the users posted information and stores in register table
    {
        $password_1 = $_POST["password_1"];
        $password = md5($password_1);

        $sqlquery = "INSERT INTO userinfo (firstname, lastname, password, email, address, phone) VALUES ('" . $_POST["firstname"] . "','" . $_POST["lastname"] . "','" . $password . "','" . $_POST["email"] . "','" . $_POST["address"] . "','" . $_POST["phone"] . "')";
       // $sqlquery = "INSERT INTO userinfo (firstname, lastname, password, email, address, phone) VALUES ('" . $_POST["firstname"] . "','" . $_POST["lastname"] . "','" . $_POST["password_1"] . "','" . $_POST["email"] . "','" . $_POST["address"] . "','" . $_POST["phone"] . "')";
        // insert registered user details into userinfo table


        $statement = $this->_dbHandle->prepare($sqlquery);
        $statement->execute();    // run statement

    }
}