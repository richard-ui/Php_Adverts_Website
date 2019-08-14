<?php

class watchlistData {                           
    protected $_watchlistid, $_phoneswatchlistid, $user, $advert_name;

    public function __construct($dbRow) {
                                                           
        $this->_watchlistid = $dbRow['watchlistid'];
        $this->_phoneswatchlistid = $dbRow['phoneswatchlistid'];
        $this->_user = $dbRow['username'];
        $this->_advertname = $dbRow['advert_name'];
    }

    public function getId() {                      // public methods
        return $this->_watchlistid;
    }

    public function getPhone() {
        return $this->_phoneswatchlistid;
    }
    public function getUser() {                      // public methods
        return $this->_user;
    }

    public function getAdvert() {
        return $this->_advertname;
    }

	
	
}


