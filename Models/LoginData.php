<?php

class LoginData {

    protected $_u_id, $_u_name, $_u_password;

    public function __construct($dbRow) {
        $this->_u_id = $dbRow['id'];
        $this->_u_name = $dbRow['username'];
        $this->_u_password = $dbRow['password'];
    }

    public function getId() {
        return $this->_u_id;
    }

    public function getName() {
        return $this->_u_name;
    }

    public function getPassword() {
        return $this->_u_password;
    }
}


