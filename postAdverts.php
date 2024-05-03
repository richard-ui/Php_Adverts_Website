<?php
session_start();
$view = new stdClass();
require_once('Models/postAdvertsDataSet.php');

$postAdvertsDataSet = new postAdvertsDataSet();

$advertidError = "";
$titleError = "";
$priceError = "";
$colourError = "";
$brandnameError = "";

$filemessage = "";
$postedAdvert = "";

if (isset($_POST['postad'])) {
    $advertid=$_POST['advertid'];
    $title=$_POST['title'];
    $pic=($_FILES['userfile']['name']);
    $price=$_POST['price'];
    $color=$_POST['colour'];
    $brandname=$_POST['brandname'];
    $result = $postAdvertsDataSet->getPhoneId($advertid);

    $errors = array();

    $uploaddir = 'images/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        $filemessage = "File is valid, and was successfully uploaded.\n";
    } else {
        $filemessage = "Possible file upload attack!\n";
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
        $postedAdvert = "Advert Posted!";
        $postAdvertsDataSet->postAdvert1($advertid, $title, $pic, $price, $color, $brandname);
    }
    else {
        $postedAdvert = "Id must be inique!";
    }

}

require_once('Views/postAdverts.phtml');