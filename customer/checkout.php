<?php
session_start();
$bid = $_GET['bid'];  
// modified
if (isset($_GET['checkout'])) {
    $pid = $_GET['ItemID'];
    $sellPrice = $_GET['PriceItem'];
    $quantity = $_GET['qtyitem'];

    if (!isset($_SESSION["uid"]) || !isset($_GET['bid']) || !isset($_GET['total'])) {
        header('location:login.php');
        exit;
    }

    try {
        require ('../connection.php');
        $db->beginTransaction();

        $sql1 = "INSERT INTO cart (uid, bid, total) VALUES (:uid, :bid, :total)";
        $stmt1 = $db->prepare($sql1);
        $stmt1->bindParam(':uid', $_SESSION['uid'], PDO::PARAM_INT);
        $stmt1->bindParam(':bid', $_GET['bid'], PDO::PARAM_INT);
        $stmt1->bindParam(':total', $_GET['total'], PDO::PARAM_STR);
        $stmt1->execute();

        if ($stmt1->rowCount() == 1) {
            $cid = $db->lastInsertId();
                $sql2 = "INSERT INTO cart_items VALUES ($cid,'".$_SESSION['uid']."',?,?,?)";
                $stmt2 = $db->prepare($sql2);
                $numItems = count($_GET['ItemID']);
                for ($i=0;$i<$numItems;$i++) {
                    $stmt2->execute(array($pid[$i],$sellPrice[$i],$quantity[$i]));
                 }
        }
        $db->commit();
        header("location:payment.php?cid=$cid&bid=$bid");
    } catch (PDOException $e) {
        $db->rollback();
        die("Error occurred: " . $e->getMessage());
    }
}
