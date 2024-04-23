<?php

require_once ('Models/Database.php');
require_once ('Models/changepasswordData.php');

class changepasswordDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function changePW()
    {
        $username = $_POST['username'];
        $newpassword = $_POST['newpass'];

         $sqlquery = "UPDATE userinfo SET password='$newpassword' where email='$username'"; // updates the password when username equals posted username
		 $statement = $this->_dbHandle->prepare($sqlquery);
		 $statement->execute();
    }




    public function validatepass($u_name){             // function to check whether user types in correct username from database
        $sqlQuery = "SELECT password FROM userinfo WHERE email ='$u_name'";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;

        //$sqlQuery = "SELECT password FROM register WHERE username ='$u_name' where username='$u_newpassword'";
    }

}