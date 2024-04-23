<?php
session_start();
require_once('Models/watchlistDataSet.php');
$watchlistDataSet = new watchlistDataSet();

$user = $_SESSION['email'];

if(isset($_GET['id'])) {
    $watchlist_id = $_GET["id"]; // advert id
}
if(isset($_POST["add_to_list"]))
{
    if(isset($_SESSION["watch_list"]))   // if watch list session is already set
    {
        $item_array_id = array_column($_SESSION["watch_list"], "item_id");

        if(!in_array($_GET["id"], $item_array_id))
        {
            $watchlistDataSet->addPhoneIntoWatchList($watchlist_id, $user, $_POST["hidden_name"]);

            $count = count($_SESSION["watch_list"]);
            $item_array = array(
                'item_id'       =>     $_GET["id"],
                'item_name'     =>     $_POST["hidden_name"],
                'item_price'    =>     $_POST["hidden_price"],
                'item_quantity' =>     $_POST["quantity"]
            );
            $_SESSION["watch_list"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="watchlist.php"</script>';
        }
    }
    else {
        $item_array = array(
            'item_id'             =>     $_GET["id"],
            'item_name'           =>     $_POST["hidden_name"],
            'item_price'          =>     $_POST["hidden_price"],
            'item_quantity'       =>     $_POST["quantity"]
        );
        $_SESSION["watch_list"][0] = $item_array;
    }
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")     // if 'action' equals delete then continue...
    {
        foreach($_SESSION["watch_list"] as $keys => $values)  // ... uses a foreach loop statement and grabs the watch list session
            // uses the key array to loop through each item id/advertid from the session
        {
            if(isset($_GET["id"])) {
                if ($values["item_id"] == $_GET["id"]) {
                    $watchlistDataSet->deletefrom($watchlist_id);                      // deletes selected id from database table
                    unset($_SESSION["watch_list"][$keys]);                     // if item id == advert id then remove and unset current item key session selected
                    echo '<script>alert("Item Removed")</script>';
                    echo '<script>window.location="watchlist.php"</script>';
                }
            }
        }
    }
}

if(isset($_POST['adverts'])) {
    echo '<script>window.location="productspage.php"</script>';
}

require_once('Views/watchlist.phtml');

