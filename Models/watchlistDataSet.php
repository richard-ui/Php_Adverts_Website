<?php

require_once ('Models/Database.php');
require_once ('Models/watchlistData.php');

class watchlistDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function deletefrom($deleteID)
    {
            $sqlQuery = "DELETE FROM watchlist WHERE watchlistid= '$deleteID'";

            $statement = $this->_dbHandle->prepare($sqlQuery);
            $statement->execute();    // run statement
    }

    public function addPhoneIntoWatchList($watchlist_id, $username, $title)
    {
        $sqlQuery = "INSERT INTO watchlist (watchlistid, username, title)
                     VALUES ('$watchlist_id', '$username', '$title')";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
    }
}