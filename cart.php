<?php
session_start();
require_once('Models/loginDataSet.php');
$loginDataSet = new LoginDataSet();

$user = $_SESSION['email'];

if(isset($_GET['id'])) {
    $userId = $loginDataSet->getUserId($user);
}

if(isset($_POST['adverts'])) {
    echo '<script>window.location="productspage.php"</script>';
}

if(isset($_POST["add_to_cart"])) {
    if(isset($_SESSION["cart"])) {
        $session_array_id = array_column($_SESSION["cart"], "id");
        if(!in_array($_GET["id"], $session_array_id)) {
            $session_array = [
                "item_id"       => intval($_GET["id"]),
                "item_name"     => $_POST["name"],
                "item_price"    => $_POST["price"],
                "item_quantity" => intval($_POST["quantity"])
            ];

            $_SESSION["cart"][] = $session_array;
        }
    } else {
        $session_array = [
            "item_id"       => intval($_GET["id"]),
            "item_name"     => $_POST["name"],
            "item_price"    => $_POST["price"],
            "item_quantity" => intval($_POST["quantity"])
        ];

        $_SESSION["cart"][] = $session_array;
    }
}

if(isset($_GET["action"])) {
    if($_GET["action"] == "delete") {
        foreach($_SESSION["cart"] as $key => $value) {
            if(isset($_GET["id"])) {
                if ($value["item_id"] == $_GET["id"]) {
                    unset($_SESSION["cart"][$key]);
                    echo '<script>alert("Item Removed")</script>';
                    echo '<script>window.location="cart.php"</script>';
                }
            }
        }
    }
}

require_once('Views/cart.phtml');