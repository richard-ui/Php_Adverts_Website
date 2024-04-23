<?php

class registerData {

    protected $_u_firstname, $_u_lastname, $_u_password, $_u_email, $_u_address, $_u_phone;          // protected register variables

    public function __construct($dbRow) {
        $this->_u_firstname = $dbRow['firstname'];
        $this->_u_lastname = $dbRow['lastname'];
        $this->_u_password = $dbRow['password'];
        $this->_u_email = $dbRow['email'];
        $this->_u_address = $dbRow['address'];
        $this->_u_phone = $dbRow['phone'];
    }

    public function getFirstName() {
        return $this->_u_firstname;
    }
    public function getLastName() {
        return $this->_u_lastname;
    }

    public function getPassword() {
        return $this->_u_password;
    }

    public function getEmail() {
        return $this->_u_email;
    }

    public function getAddress() {
        return $this->_u_address;
    }

    public function getPhone() {
        return $this->_u_phone;
    }
}


