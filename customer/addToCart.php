<?php
  session_start();
  date_default_timezone_set("Asia/Bahrain");

  //modified
  $pid = $_POST['pid'];
  $productqty = $_POST['productqty'];
  $bid = $_POST['bid'];  

  if ($productqty > 0) {
    $productQuantity = $productqty;
  } else {
    $productQuantity = 1;
  }
  $_SESSION['shoppingcart'][$pid] = $productQuantity;
  header("location:menu.php?bid=<?php echo $bid;?>"); 
?>
