<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'Watch List';

require_once('Models/watchlistDataSet.php');

$watchlistDataSet = new watchlistDataSet();

$user = $_SESSION['LoginName'];

if(isset($_COOKIE['watchlist'])){
    $watchlist = $_COOKIE['watchlist']; // retrieve value into variable
}

if(isset($_GET['id'])) {
    $watchlist_id = $_GET["id"]; // advert id
}
$title = $_SESSION['title'];
if(isset($_POST["add_to_list"]))   // if list button is pressed
{
    if(isset($_SESSION["watch_list"]))   // if watch list session is already set
    {
        $item_array_id = array_column($_SESSION["watch_list"], "item_id"); // puts watch list session and
        // new item_id into same variable

        if(!in_array($_GET["id"], $item_array_id))                      // if advert id and item id not already in array list
        {
         // $watchlistDataSet->insertinto();

            $watchlistDataSet->products_FK($watchlist_id, $user, $title); // posts the id of a selected adver into the database

            $count = count($_SESSION["watch_list"]);
            $item_array = array(
                'item_id'               =>     $_GET["id"],             // ... then an array is created to post the advert details that are passed
                'item_name'               =>     $_POST["hidden_name"], // ...into a key array to match the item id, name etc
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"]
            );
            $_SESSION["watch_list"][$count] = $item_array;              // counts current 'watch_list' session
        }
        else
        {
            echo '<script>alert("Item Already Added")</script>';       // user is alerted with an error message if they have already added that advert
            echo '<script>window.location="watchlist.php"</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'               =>     $_GET["id"],
            'item_name'               =>     $_POST["hidden_name"],
            'item_price'          =>     $_POST["hidden_price"],
            'item_quantity'          =>     $_POST["quantity"]
        );
        $_SESSION["watch_list"][0] = $item_array;                       // else array holds '0' value
    }
}

if(isset($_GET["action"]))      // if 'action' querystring already set
{
    if($_GET["action"] == "delete")     // if 'action' equals delete then continue...
    {
        foreach($_SESSION["watch_list"] as $keys => $values)  // ... uses a foreach loop statement and grabs the watch list session
            // uses the key array to loop through each item id/advertid from the session
        {
            if(isset($_GET["id"])) {
                if ($values["item_id"] == $_GET["id"]) {
                    $watchlistDataSet->deletefrom($watchlist_id);                         // deletes selected id from database table
                    unset($_SESSION["watch_list"][$keys]);                     // if item id == advert id then remove and unset current item key session selected
                    echo '<script>alert("Item Removed")</script>';
                    echo '<script>window.location="watchlist.php"</script>';
                }
            }
        }
    }
}

if(isset($_POST['adverts'])) {                               // if clicked go locate back to products page
    echo '<script>window.location="productspage.php"</script>';
}


if (isset($_POST['logout'])) {
    echo '<script>window.location="login.php"</script>';
    unset($_SESSION["watch_list"]);                          // when user decides to logout the watch list session will be unset
}

if (isset($_SESSION["watch_list"])) {
    foreach ($_SESSION["watch_list"] as $keys => $values) {       // foreach loop
        $watchlist = $_SESSION["watch_list"][$keys];
        if(isset($_COOKIE['watchlist'])) {// puts watchlist into variable
            setcookie('watchlist', $watchlist, time() + 86400 * 14); // set cookie time limit advert expiry 2 weeks
        }
    }
}


require_once('Views/watchlist.phtml');

