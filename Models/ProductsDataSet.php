<?php

require_once ('Models/Database.php');
require_once ('Models/ProductsData.php');

class ProductsDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }
// this get the products data from the database
    public function fetchAllProducts()                 // function to gather certain rows from products table
                                                       // uses else if statements to check against the querystring filters.
    {
        $sqlQuery = 'SELECT * FROM phones';
        if ($_GET['sort'] == "lowToHigh"){
            $sqlQuery .= " ORDER BY Price ASC"; //this filters it by price ascending
        }
        elseif ($_GET['sort'] == "highToLow"){
            $sqlQuery .= " ORDER BY Price DESC"; //this filters it by price descending
        }elseif ($_GET['sort'] == "name(A-Z"){
            $sqlQuery .= " ORDER BY Title ASC"; //this filters it by name descending
        }

        elseif ($_GET['filter'] == "lessThan50") {
            $sqlQuery = " SELECT * FROM phones WHERE Price  BETWEEN 0 AND 50"; //this filters it by price
        }elseif ($_GET['filter'] == "lessThan100") {
            $sqlQuery = " SELECT * FROM phones WHERE Price  BETWEEN 0 AND 100";//this filters it by price
        }elseif ($_GET['filter'] == "lessThan150") {
            $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 150";//this filters it by price
        }elseif ($_GET['filter'] == "lessThan200") {
            $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 200";//this filters it by price
        }elseif ($_GET['filter'] == "lessThan250") {
            $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 250";//this filters it by price
        }elseif ($_GET['filter'] == "lessThan300") {
            $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 300";//this filters it by price
        }elseif ($_GET['filter'] == "apple") {
        $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Apple'";//this filters it by Brand
        }elseif ($_GET['filter'] == "Samsung") {
        $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Samsung' ";//this filters it by Brand
        }elseif ($_GET['filter'] == "Sony") {
            $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Sony'";//this filters it by Brand
        }elseif ($_GET['filter'] == "Nokia") {
            $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Nokia'";//this filters it by Brand
        }
        elseif ($_GET['filter'] == "black") {
            $sqlQuery = " SELECT * FROM phones WHERE Color = 'Black'";//this filters it by color
        }
        elseif ($_GET['filter'] == "white") {
            $sqlQuery = " SELECT * FROM phones WHERE Color = 'White'";//this filters it by color
        }
        elseif ($_GET['filter'] == "blue") {
            $sqlQuery = " SELECT * FROM phones WHERE Color = 'Blue'";//this filters it by color
        }
        elseif ($_GET['filter'] == "grey") {
            $sqlQuery = " SELECT * FROM phones WHERE Color = 'Grey'";//this filters it by color
        }




        else{
            $sqlQuery = 'SELECT * FROM phones';                   // else display all product rows in table
        }

        $statement = $this->_dbHandle->prepare($sqlQuery);        // prepares statment
        $statement->execute();                                    // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {                      // while loop  to fethc each individual row
            $dataSet[] = new ProductsData($row);
        }
        return $dataSet;                                          // returns the table query
    }
}

