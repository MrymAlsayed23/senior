<?php
  session_start();
  if (isset($_SESSION['uid'])){
    if (isset($_GET['pbtn'])){
      $type = $_GET['payType'];
      //echo $type;
      $total = $_GET['amount'];
      //echo $total;
      $card = $_GET['cardno'];
      //echo $card;
      $cart = $_GET['cid'];
      //echo $cart;
      try {
        require('../connection.php');
        $db->beginTransaction();
        $sql = "INSERT INTO orders VALUES(NULL,'".$_SESSION['uid']."',NULL,$cart,$total,'Pending',NOW())";
        $rows = $db->exec($sql);
        if ($rows == 1){
          $oid = $db->lastInsertId();
          $sql = "INSERT INTO payment VALUES(NULL,'".$_SESSION['uid']."',NULL,$cart,NULL,NOW(),$total,$card)";
          $row = $db->exec($sql);
          $db->commit();
        }
        $db = null;
      } catch (PDOException $e) {
          //$db->rollBack();
        die ("Error occured".$e->getMessage());
      }
    }
    else if (isset($_GET['placebtn'])){
      $type  = $_GET['payType'];
      $total = $_GET['amount'];
      $cart = $_GET['cid'];
      try {
      require('../connection.php');
      $db->beginTransaction();
      $sql = "INSERT INTO orders VALUES(NULL,'".$_SESSION['userid']."',NULL,$cart,$total,'Pending',NOW())";
      $rows = $db->exec($sql);
      if ($rows == 1){
        $oid = $db->lastInsertId();
        $sql = "INSERT INTO payment VALUES(NULL,'".$_SESSION['uid']."',$oid,NULL,$cart,NULL,NOW(),$total,0)";
        $row = $db->exec($sql);
        $db->commit();
      }
      $db = null;
    } catch (PDOException $e) {
      //$db->rollBack();
        die ("Error occured".$e->getMessage());
    }
    }
    if(isset($_GET['cbtn'])){
      header('location:cart.php');
    }
    unset($_SESSION['shoppingcart']);
  }
?>
