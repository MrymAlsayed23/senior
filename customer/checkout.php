<?php
    session_start();
   if (isset($_POST['checkout'])) {

        if (!(isset($_SESSION["uid"]))){
            // Redirect to login page if user is not logged in
            // header('location:login.php');
            // exit;
        } else {
            try {
                require('../connection.php');
                $db->beginTransaction();
                $sql1 = "INSERT INTO cart VALUES(NULL, '".$_SESSION['uid']."',NULL ,'".$_POST['total']."')";
                $row = $db->exec($sql1);
                
                if ($row == 1){
                    $cid = $db->lastInsertId();
                    $sql2 = "INSERT INTO cart_items VALUES($cid,'".$_SESSION['uid']."',?,?)";
                    $stmt = $db->prepare($sql2);
                    for ($i=0;$i<count($pid);$i++) {
                        $stmt->execute(array($pid[$i],$sellPrice[$i],$pquantity[$i]));
                    }
                }
                $db->commit();
            } catch (PDOException $e) {
                $db->rollback();
                die ("Error occured:".$e->getMessage());
            }
            header ('location:payment.php?cid='.$cid.'');
           
        }
    } //end if
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Checkout</title>
    </head>
    <body>
        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>

    <!-- Checkout form -->
    <div class="container">
        <h1>Checkout</h1>
        <form action="payment.php" method="POST">
            <!-- Customer information -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            
            <!-- Payment information -->
            <div class="mb-3">
                <label for="card_number" class="form-label">Credit Card Number</label>
                <input type="text" class="form-control" id="card_number" name="card_number" required>
            </div>
            <div class="mb-3">
                <label for="expiry_date" class="form-label">Expiry Date</label>
                <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YYYY" required>
            </div>
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
