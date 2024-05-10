<?php
session_start();

// modified
if (isset($_GET['checkout'])) {
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

            if (isset($_GET['pid'], $_GET['sellPrice'], $_GET['quantity']) && is_array($_GET['pid'])) {
                $sql2 = "INSERT INTO cart_items (cart_id, pid, sellPrice, quantity) VALUES (:cart_id, :pid, :sellPrice, :quantity)";
                $stmt2 = $db->prepare($sql2);
                $stmt2->bindParam(':cart_id', $cid, PDO::PARAM_INT);

                $numItems = count($_GET['pid']);
                for ($i = 0; $i < $numItems; $i++) {
                    $stmt2->bindParam(':pid', $_GET['pid'][$i], PDO::PARAM_INT);
                    $stmt2->bindParam(':sellPrice', $_GET['sellPrice'][$i], PDO::PARAM_STR);
                    $stmt2->bindParam(':quantity', $_GET['quantity'][$i], PDO::PARAM_INT);
                    $stmt2->execute();
                }
            }
        }
        $db->commit();
        header("location:payment.php?cid=" . $cid);
    } catch (PDOException $e) {
        $db->rollback();
        die("Error occurred: " . $e->getMessage());
    }
}
