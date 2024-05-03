<?php

require_once ('Models/Database.php');
require_once ('Models/ProductspageData.php');

class ProductspageDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function countProducts() {
        $sqlQuery = 'SELECT * FROM phones';

        $statement = $this->_dbHandle->prepare($sqlQuery);           // prepares query
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {                        // while loop to loop through rows
            $dataSet[] = new ProductspageData($row);
        }
        return count($dataSet);
    }

    public function fetchAllProducts($start_from, $num_per_page) {
        $sqlQuery = "SELECT * FROM phones LIMIT " . $start_from . ", " . $num_per_page . "";
        if(isset($_GET['sort']) || isset($_GET['filter'])) {
            if ($_GET['sort'] == "lowToHigh") {
                $sqlQuery .= " ORDER BY Price ASC";
            } elseif ($_GET['sort'] == "highToLow") {
                $sqlQuery .= " ORDER BY Price DESC";
            } elseif ($_GET['sort'] == "name(A-Z") {
                $sqlQuery .= " ORDER BY Title ASC"; //this filters it by name descending
            } elseif ($_GET['filter'] == "lessThan50") {
                $sqlQuery = " SELECT * FROM phones WHERE Price  BETWEEN 0 AND 50 ORDER BY Price DESC"; //this filters it by price
            } elseif ($_GET['filter'] == "lessThan100") {
                $sqlQuery = " SELECT * FROM phones WHERE Price  BETWEEN 0 AND 100 ORDER BY Price DESC";//this filters it by price
            } elseif ($_GET['filter'] == "lessThan150") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 150 ORDER BY Price DESC";//this filters it by price
            } elseif ($_GET['filter'] == "lessThan200") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 200 ORDER BY Price DESC";//this filters it by price
            } elseif ($_GET['filter'] == "lessThan350") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 350 ORDER BY Price DESC";//this filters it by price
            } elseif ($_GET['filter'] == "lessThan500") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 500 ORDER BY Price DESC";//this filters it by price
            } elseif ($_GET['filter'] == "lessThan600") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 600 ORDER BY Price DESC";//this filters it by price
            } elseif ($_GET['filter'] == "apple") {
                $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Apple'";//this filters it by Brand
            } elseif ($_GET['filter'] == "Samsung") {
                $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Samsung' ";//this filters it by Brand
            } elseif ($_GET['filter'] == "Sony") {
                $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Sony'";//this filters it by Brand
            } elseif ($_GET['filter'] == "Nokia") {
                $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Nokia'";//this filters it by Brand
            } elseif ($_GET['filter'] == "black") {
                $sqlQuery = " SELECT * FROM phones WHERE Color = 'Black'";//this filters it by color
            } elseif ($_GET['filter'] == "white") {
                $sqlQuery = " SELECT * FROM phones WHERE Color = 'White'";//this filters it by color
            } elseif ($_GET['filter'] == "blue") {
                $sqlQuery = " SELECT * FROM phones WHERE Color = 'Blue'";//this filters it by color
            } elseif ($_GET['filter'] == "grey") {
                $sqlQuery = " SELECT * FROM phones WHERE Color = 'Grey'";//this filters it by color
            } elseif ($_GET['sort'] == "highToLow") {
                $sqlQuery .= " ORDER BY Price DESC"; //this filters it by price descending
            } else {
                $sqlQuery = 'SELECT * FROM phones';                      // else display all phones from table
            }
        }
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ProductspageData($row);
        }
        return $dataSet;
    }
    
    public function searchProducts($search) {
        $sqlQuery = "SELECT * from phones where phones.Title like '%" .  $search . "%'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ProductspageData($row);
        }
        return $dataSet;
    }

    public function fetchAjaxHintID($ajaxid) {
        $sqlQuery = "SELECT * FROM phones where id = '$ajaxid'";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ProductspageData($row);
        }
        return $dataSet;
    }

    public function searchtextforAjax($searchtext) {

        $sqlQuery = "SELECT * from phones where phones.Title like '%" .  $searchtext . "%'";


        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ProductspageData($row);
        }
        return $dataSet;
    }
}

