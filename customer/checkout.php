<?php
    session_start();
    //Update cart...
    $productID = $_POST['productID'];
    $Price = $_POST['Price'];
    $qtyproduct = $_POST['qtyproduct'];
    $total = $_POST['total'];
    if(isset($_POST['updatebtn'])){
    for($i=0;$i<count($Quantity);$i++)
        $_SESSION['shoppingcart'][$productID[$i]]=$Quantity[$i];
        header('location:cart.php');
    }
    else if (isset($_POST['checkout'])){
?>

  <?php
    if (!(isset($_SESSION["uid"]))){
        header('location:login.php');
    }
    
    else {
        try {
        require('../connection.php');
            $db->beginTransaction();
            $sql1 = "INSERT INTO cart VALUES(NULL, '".$_SESSION['uid']."', '".$_POST['total']."')";
            $row = $db->exec($sql1);
            echo "Re";
            if ($row == 1){
                $cardId = $db->lastInsertId();
                $sql2 = "INSERT INTO c_items VALUES($cid,'".$_SESSION['uid']."',?,?,?)";
                $stmt = $db->prepare($sql2);
                for ($i=0;$i<count($productID);$i++) {
                $stmt->execute(array($productID[$i],$Price[$i],$Quantity[$i]));
                }
            }
            $db->commit();

        } 
        catch (PDOException $e) {
            $db->rollback();
            die ("Error occured:".$e->getMessage());
        }
        header ('location:payment.php?cid='.$cid.'');
        ?>
        <form class="" action="payment.php" method="POST">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <input type="hidden" name="cart" value="<?php echo $cid; ?>">
        </form>
        <?php
  }
}
?>