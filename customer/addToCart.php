<?php
session_start();
date_default_timezone_set("Asia/Bahrain");

//modified
$productid = $_POST['productid'];
$productqty = $_POST['productqty'];
$businessId = $_POST['businessId'];
if ($productqty > 0) {
  $productQuantity = $productqty;
} else {
  $productQuantity = 1;
}
$_SESSION['shoppingcart'][$productid] = $productQuantity;
$_SESSION['shoppingcart'][$businessId] = $businessId;
header('location:menu.php'); 
