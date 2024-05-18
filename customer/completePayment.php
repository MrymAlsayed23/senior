<?php
session_start();
if (isset($_SESSION['uid'])) {
  if (isset($_POST['pbtn'])) { //these information will came from payment form in payment page (this part for Credit method)
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
      $rows = $db->prepare($sql);
      $rows->execute();
      $oid = $db->lastInsertId();
      while ($row=$rows->fetch(PDO::FETCH_ASSOC)) { 
        extract($row);
        $sqlIN = "INSERT INTO order_items VALUES($oid, '" . $_SESSION['uid'] . "', $pid, $pquantity)";
        $rIN = $db->prepare($sqlIN);
        $rIN->execute();
      } 
      if ($rows->rowCount() == 1) {
        $oid = $db->lastInsertId();
        $sql = "INSERT INTO payment VALUES(NULL,'" . $_SESSION['uid'] . "',$oid,$cid,$bid,NOW(),$total,0)";
        // 0 for card method
        $row = $db->exec($sql);
        $db->commit();
        header('location:orderstatus.php?cid='.$cid.'&bid='.$bid);
      }
      $db = null;
    } catch (PDOException $e) {
      //$db->rollBack();
      die("Error occured" . $e->getMessage());
    }
  } else if (isset($_POST['placebtn'])) { //this part for cash method
    $type = $_POST['payType'];
    $total = $_POST['amount'];
    $cid = $_POST['cid'];
    $bid = $_POST['bid'];
    //$cart = $_GET['cid'];
    try {
      require ('../connection.php');
      $db->beginTransaction();
      $sql = "INSERT INTO orders VALUES(NULL,'" . $_SESSION['uid'] . "',$bid,$cid,$total,'Pending',NOW())";
      $rows = $db->prepare($sql);
      $rows->execute();
      $oid = $db->lastInsertId();
      while ($row=$rows->fetch(PDO::FETCH_ASSOC)) { 
        extract($row);
        $sqlIN = "INSERT INTO order_items VALUES($oid, '" . $_SESSION['uid'] . "', $pid, $pquantity)";
        $rIN = $db->prepare($sqlIN);
        $rIN->execute();
      } 
      if ($rows->rowCount() == 1) {
        $sql = "INSERT INTO payment VALUES(NULL,'" . $_SESSION['uid'] . "',$oid,$cid,$bid,NOW(),$total,1)";
        // 1 for cash method
        $row = $db->exec($sql);
        $db->commit();
        header('location:orderstatus.php?cid='.$cid.'&bid='.$bid);

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
