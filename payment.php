<?php
session_start();
require('Views/template/header.phtml');
require_once('Models/ProductspageDataSet.php');
$view = new stdClass();
$productspageDataSet = new ProductspageDataSet();
$view->ProductspageDataSet = $productspageDataSet->fetchAllProducts();

?>
    <h3> Stripe Payment Page </h3>
    <body>
        <form method="post" action="checkout.php">

            <p>T-Shirt</p>
            <p><strong>GBP £20.00</strong></p>

            <button>Pay</button>

        </form>
        
    </body>
