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
        $getFilters = $this->getFilters($sqlQuery);
        $sqlQuery = $getFilters[0];

        if (isset($_POST['search'])) {
            $searchtext = $_POST['searchtext'];
            $sqlQuery = $this->searchProductsInput($searchtext);
            // var_dump($sqlQuery);
        }

        if(isset($_GET['suggestionId'])){
            $ajaxid = $_GET['suggestionId'];
            $sqlQuery = $this->fetchAjaxHintID($ajaxid);
        }
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ProductspageData($row);
        }
        // var_dump(count($dataSet));
        return count($dataSet);
    }

    public function fetchAllProducts($start_from, $num_per_page) {
        $sqlQuery = 'SELECT * FROM phones';
        $queryString = "";
        $getFilters = $this->getFilters($sqlQuery, $queryString);
        $sqlQuery = $getFilters[0];

        if (isset($_POST['search'])) {
            $searchtext = $_POST['searchtext'];
            $sqlQuery = $this->searchProductsInput($searchtext);
        }

        if(isset($_GET['suggestionId'])){
            $ajaxid = $_GET['suggestionId'];
            $sqlQuery = $this->fetchAjaxHintID($ajaxid);
        }
        $sqlQuery .= " LIMIT " . $start_from . ", " . $num_per_page . "";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ProductspageData($row);
        }
        return [$dataSet, $getFilters[1]];
    }

    public function searchProductsInput($search) {
        $sqlQuery = "SELECT * from phones where phones.Title like '%" .  $search . "%'";
        return $sqlQuery;
    }
    
    public function searchProducts($search) {
        $sqlQuery = "SELECT * from phones where phones.Title like '%" .  $search . "%'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new ProductspageData($row);
        }
        return [$dataSet];
    }

    public function fetchAjaxHintID($ajaxid) {
        $sqlQuery = "SELECT * FROM phones where id = '$ajaxid'";
        return $sqlQuery;
    }

    public function getFilters($sqlQuery, $queryString = "") {
        if(isset($_GET['sort']) || isset($_GET['filter'])) {
            if ($_GET['sort'] == "lowToHigh") {
                $sqlQuery .= " ORDER BY Price ASC";
                $queryString = "&sort=lowToHigh";
            } elseif ($_GET['sort'] == "highToLow") {
                $sqlQuery .= " ORDER BY Price DESC";
                $queryString = "&sort=highToLow";
            } elseif ($_GET['sort'] == "name(A-Z") {
                $sqlQuery .= " ORDER BY Title ASC";
                $queryString = "&sort=name(A-Z";
            } elseif ($_GET['filter'] == "lessThan50") {
                $sqlQuery = " SELECT * FROM phones WHERE Price  BETWEEN 0 AND 50 ORDER BY Price DESC";
                $queryString = "&filter=lessThan50";
            } elseif ($_GET['filter'] == "lessThan100") {
                $sqlQuery = " SELECT * FROM phones WHERE Price  BETWEEN 0 AND 100 ORDER BY Price DESC";
                $queryString = "&filter=lessThan100";
            } elseif ($_GET['filter'] == "lessThan150") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 150 ORDER BY Price DESC";
                $queryString = "&filter=lessThan150";
            } elseif ($_GET['filter'] == "lessThan200") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 200 ORDER BY Price DESC";
                $queryString = "&filter=lessThan200";
            } elseif ($_GET['filter'] == "lessThan350") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 350 ORDER BY Price DESC";
                $queryString = "&filter=lessThan350";
            } elseif ($_GET['filter'] == "lessThan500") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 500 ORDER BY Price DESC";
                $queryString = "&filter=lessThan500";
            } elseif ($_GET['filter'] == "lessThan600") {
                $sqlQuery = " SELECT * FROM phones WHERE Price BETWEEN 0 AND 600 ORDER BY Price DESC";
                $queryString = "&filter=lessThan600";
            } elseif ($_GET['filter'] == "apple") {
                $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Apple'";
                $queryString = "&filter=apple";
            } elseif ($_GET['filter'] == "Samsung") {
                $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Samsung' ";
                $queryString = "&filter=Samsung";
            } elseif ($_GET['filter'] == "Sony") {
                $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Sony'";
                $queryString = "&filter=Sony";
            } elseif ($_GET['filter'] == "Nokia") {
                $sqlQuery = " SELECT * FROM phones WHERE BrandName = 'Nokia'";
                $queryString = "&filter=Nokia";
            } elseif ($_GET['filter'] == "black") {
                $sqlQuery = " SELECT * FROM phones WHERE Color = 'Black'";
                $queryString = "&filter=black";
            } elseif ($_GET['filter'] == "white") {
                $sqlQuery = " SELECT * FROM phones WHERE Color = 'White'";
                $queryString = "&filter=white";
            } elseif ($_GET['filter'] == "blue") {
                $sqlQuery = " SELECT * FROM phones WHERE Color = 'Blue'";
                $queryString = "&filter=blue";
            } elseif ($_GET['filter'] == "grey") {
                $sqlQuery = " SELECT * FROM phones WHERE Color = 'Grey'";
                $queryString = "&filter=grey";
            } elseif ($_GET['sort'] == "highToLow") {
                $sqlQuery .= " ORDER BY Price DESC";
                $queryString = "&sort=highToLow";
            } else {
                $sqlQuery = 'SELECT * FROM phones';
            }
        }
        return [$sqlQuery, $queryString];
    }

}