<?php
session_start();
unset($_SESSION['shoppingcart'][$_GET['productID']]);
$productID = $_GET['productID'];
try {
  require('../connection.php');
  $sql  = "DELETE FROM cart_items WHERE cid=$productID";
  $row = $db->exec($sql);
  if ($row == 1){
    echo "DELETED";
  }

} catch (PDOException $e) {
  die("Error occured:".$e->getMessage());
}

header('location:cart.php');
?>
