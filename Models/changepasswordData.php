<?php

class registerData {

    protected $_u_name, $_u_password;

    public function __construct($dbRow) {

        $this->_u_name = $dbRow['username'];
        $this->_u_password = $dbRow['password'];
		
    }

    public function getName() {
        return $this->_u_name;
    }

    public function getPassword() {
        return $this->_u_password;
    }
	    
	
}


