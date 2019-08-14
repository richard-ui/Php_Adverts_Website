<?php
$view = new stdClass();
$view->pageTitle = 'Post Adverts';

require_once('Models/postAdvertsDataSet.php');


$postAdvertsDataSet = new postAdvertsDataSet();    // gathers new dataset class

$advertidError = "";
$titleError = "";                // errors
$priceError = "";
$colourError = "";
$brandnameError = "";


$filemessage = "";
$postedAdvert = "";

 // name of file and stores image file into this folder

if (isset($_POST['postad'])) {  // when the post advert button is clicked

    $advertid=$_POST['advertid'];

    $title=$_POST['title'];

    $pic=($_FILES['userfile']['name']);

    $price=$_POST['price'];

    $color=$_POST['colour'];

    $brandname=$_POST['brandname'];

    $result = $postAdvertsDataSet->userId($advertid);        // gathers the 'userId' function

    $errors = array(); // declares an array for errors

    $uploaddir = 'images/'; // variable to hold images folder
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {    // validates image and moves to 'images/' location
        $filemessage = "File is valid, and was successfully uploaded.\n";  //  if successful image upload
    } else {
        $filemessage = "Possible file upload attack!\n";            //  if unsuccessful image upload
    }


    if (empty($_POST["advertid"])) {
        array_push($errors, 1);
        $advertidError = "Advert id is required";
    }

    if (empty($_POST["title"])) {
        array_push($errors, 2);
        $titleError = "Title is required";
    }

    if (empty($_POST["price"])) {
        array_push($errors, 4);
        $priceError = "Price is required";
    }

    if (empty($_POST["colour"])) {
        array_push($errors, 1);
        $colourError = "Colour is required";
    }

    if (empty($_POST["brandname"])) {
        array_push($errors, 1);
        $brandnameError = "BrandName is required";
    }

    if(empty($errors) && $_POST['advertid'] != $result['id'])
        {
        $postedAdvert = "Advert Posted!";   // when upload button is clicked then should store info in the database table
        $postAdvertsDataSet->postAdvert1($advertid, $title, $pic, $price, $color, $brandname);
        //$postAdvertsDataSet->postAdvert(); // function used to store user advert will run
    }
    else {

        $postedAdvert = "Id must be inique!"; // run id error
    }

}

require_once('Views/postAdverts.phtml');