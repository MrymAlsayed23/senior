<?php
    session_start();
    date_default_timezone_set("Asia/Bahrain");
   $productid = $_POST['productid'];
   $productqty = $_POST['productqty'];
   if ($productqty>0){
     $productQuantity = $productqty;
   }
   else {
     $productQuantity = 1;
   }
   $_SESSION['shoppingcart'][$productid] = $productQuantity;
   header('location:menu.php');?>
