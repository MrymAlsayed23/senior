<?php
  session_start();
  if (isset($_SESSION['uid'])){
    if (isset($_POST['pbtn'])){
      $type = $_POST['payType'];
      //echo $type;
      $total = $_POST['amount'];
      //echo $total;
      $card = $_POST['cardno'];
      //echo $card;
      $cart = $_POST['cid'];
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
        $db->rollBack();
        die ("Error occured".$e->getMessage());
      }
    }
    else if (isset($_POST['placebtn'])){
      $type  = $_POST['payType'];
      $total = $_POST['amount'];
      $cart = $_POST['cid'];
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
      $db->rollBack();
        die ("Error occured".$e->getMessage());
    }
    }
    if(isset($_POST['cbtn'])){
      header('location:cart.php');
    }
    unset($_SESSION['shoppingcart']);
  }
?>
