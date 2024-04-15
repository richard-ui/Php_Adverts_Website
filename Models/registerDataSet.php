<?php

require_once ('Models/Database.php');
require_once ('Models/registerData.php');

class registerDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function signupuser()
    {
        $password_1 = $_POST["password_1"];
        $password = md5($password_1);

        $sqlquery = "INSERT INTO userinfo (firstname, lastname, password, email, address, phone) VALUES ('" . $_POST["firstname"] . "','" . $_POST["lastname"] . "','" . $password . "','" . $_POST["email"] . "','" . $_POST["address"] . "','" . $_POST["phone"] . "')";

        $statement = $this->_dbHandle->prepare($sqlquery);
        $statement->execute();    // run statement

    }
}