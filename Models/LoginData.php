<?php

class LoginData {         //  logindata class

    protected $_u_name,$_u_password;

    public function __construct($dbRow) {        // gathers rows from database

            $this->_u_name = $dbRow['username'];
            $this->_u_password = $dbRow['password'];
    }

    public function getName() {           // public methods
        return $this->_u_name;
    }

    public function getPassword() {
        return $this->_u_password;
    }
}


