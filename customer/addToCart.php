<?php
if (isset($_POST["add"])) {
  session_start();
  date_default_timezone_set("Asia/Bahrain");

  //modified
  $pid = $_POST['pid'];
  $pquantity = $_POST['pquantity'];
  $bid = $_POST['bid'];  

  if ($pquantity > 0) {
    $productQuantity = $pquantity;
  } else {
    $productQuantity = 1;
  }
  $_SESSION['shoppingcart'][$pid] = $productQuantity;
  header("location:menu.php?bid=".$bid); 
  //echo $productQuantity ." + ". $pid;
}
?>
