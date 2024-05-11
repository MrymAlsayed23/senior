<?php
session_start();
if (isset($_SESSION['uid'])) {
  if (isset($_POST['pbtn'])) { //these information will came from payment form in payment page
    $type = $_POST['payType'];
    //echo $type;
    $total = $_POST['amount'];
    //echo $total;
    $card = $_POST['cardno']; //cardno is card number from the form in payment page
    //echo $card;
    $cid = $_POST['cid'];
    //echo $cid;
    $bid = $_POST['bid'];
    //echo $bid;
    try {
      require ('../connection.php');
      $db->beginTransaction();
      $sql = "INSERT INTO orders VALUES(NULL,'" . $_SESSION['uid'] . "',NULL,$cid,$total,'Pending',NOW())";
      $rows = $db->exec($sql);
      if ($rows == 1) {
        $oid = $db->lastInsertId();
        $sql = "INSERT INTO payment VALUES(NULL,'" . $_SESSION['uid'] . "',$oid,$cid,$bid,NOW(),$total,$card)";
        $row = $db->exec($sql);
        $db->commit();
      }
      $db = null;
    } catch (PDOException $e) {
      //$db->rollBack();
      die("Error occured" . $e->getMessage());
    }
  } else if (isset($_POST['placebtn'])) {
    $type = $_POST['payType'];
    $total = $_POST['amount'];
    $cid = $_POST['cid'];
    $bid = $_POST['bid'];
    //$cart = $_GET['cid'];
    try {
      require ('../connection.php');
      $db->beginTransaction();
      $sql = "INSERT INTO orders VALUES(NULL,'" . $_SESSION['uid'] . "',$bid,$cid,$total,'Pending',NOW())";
      $rows = $db->exec($sql);
      if ($rows == 1) {
        $oid = $db->lastInsertId();
        $sql = "INSERT INTO payment VALUES(NULL,'" . $_SESSION['uid'] . "',$oid,$cid,$bid,NOW(),$total,1)";
        $row = $db->exec($sql);
        $db->commit();
      }
      $db = null;
    } catch (PDOException $e) {
      //$db->rollBack();
      die("Error occured" . $e->getMessage());
    }

  }
  if (isset($_POST['cbtn'])) {
    header('location:cart.php?cid='.$cid.'&bid='.$bid);
  }
  unset($_SESSION['shoppingcart']);
}
?>
