<?php
session_start();
$view = new stdClass();
$view->pageTitle = 'querystring';



// store session into variable

$watchlist = $_COOKIE['watchlist']; // retrieve value into variable



if (isset($_GET['id'])) {  // if list button is pressed

    if(isset($_SESSION["query"]))   // if watch list session is already set
    {
        $item_array_id = array_column($_SESSION["query"], "Locid"); // puts watch list session and
        // new item_id into same variable

        if(!in_array($_GET["id"], $item_array_id))                      // if advert id and item id not already in array list
        {

            //$watchlistDataSet->insertinto();                                   // posts the id of a selected adver into the database

            $count = count($_SESSION["query"]);
            $item_array = array(
                'Locid'               =>     $_GET["id"],             // ... then an array is created to post the advert details that are passed
                'LocTitle'            =>     $_GET["Title"], // ...into a key array to match the item id, name etc
                'LocImage'            =>     $_GET["Image"],
                'LocName'            =>     $_GET["Location"]
            );
            $_SESSION["query"][$count] = $item_array;              // counts current 'watch_list' session
        }

    }
    else
    {
        $item_array = array(
            'Locid'               =>     $_GET["id"],
            'LocTitle'            =>     $_GET["Title"],
            'LocImage'            =>     $_GET["Image"],
            'LocName'            =>     $_GET["Location"]

        );
        $_SESSION["query"][0] = $item_array;                       // else array holds '0' value
    }
}




if(isset($_GET["action"]))      // if 'action' querystring already set
{
    if($_GET["action"] == "delete")     // if 'action' equals delete then continue...
    {
        foreach($_SESSION["query"] as $keys => $values)  // ... uses a foreach loop statement and grabs the watch list session
            // uses the key array to loop through each item id/advertid from the session
        {
            if($values["Locid"] == $_GET["id"])
            {

                unset($_SESSION["query"][$keys]);                     // if item id == advert id then remove and unset current item key session selected
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="querystring.php"</script>';
            }
        }
    }
}

require_once('Views/querystring.phtml');

