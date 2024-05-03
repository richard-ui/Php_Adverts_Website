<?php

require_once ('Models/Database.php');
require_once ('Models/LoginData.php');

class LoginDataSet {
    protected $_dbHandle, $_dbInstance;
        
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function login($u_name,$u_password){
        $sqlQuery = "select email from userinfo WHERE email = '$u_name' AND password = '$u_password'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserId($u_name){
        $sqlQuery = "select id from userinfo WHERE email = '$u_name'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

}


