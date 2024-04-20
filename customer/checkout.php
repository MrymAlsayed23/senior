<?php

    include '../connection.php';
    session_start();

    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
    }
    else{
        $uid = '';
        //header('location:login.php');
    };

    if(isset($_POST['order'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $method = $_POST['method'];
        $method = filter_var($method, FILTER_SANITIZE_STRING);
        $address = ' '. $_POST['area'] .', '. $_POST['block'] .', '. $_POST['street'] .', '. $_POST['house'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $total_products = $_POST['total_products'];
        $total_price = $_POST['total_price'];

        $check_cart = $db->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $check_cart->execute([$user_id]);

        if($check_cart->rowCount() > 0){

            $insert_order = $db->prepare("INSERT INTO `orders`(uid, total, ostatus, time) VALUES(?,?,?,?)");
            $insert_order->execute([$uid, $total, $ostatus, $time]);

            $delete_cart = $db->prepare("DELETE FROM `cart` WHERE uid = ?");
            $delete_cart->execute([$uid]);

            $message[] = 'order placed successfully!';
    }
    else{
        $message[] = 'your cart is empty';
    }

    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Checkout</title>
    </head>
    <body>

        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>

        
        <section class="checkout-orders">
            
            <form action="" method="POST">
                
                <h3>your orders</h3>
                <div class="display-orders">

                    <?php
                        $grand_total = 0;
                        $cart_items[] = '';
                        $select_cart = $db->prepare("SELECT * FROM `cart` WHERE uid = ?");
                        $select_cart->execute([$uid]);
                        if($select_cart->rowCount() > 0){
                            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                                $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                                $total_products = implode($cart_items);
                                $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                    ?>
                    
                    <p> <?= $fetch_cart['name']; ?> <span>(<?= 'BHD'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
                    
                    <?php
                            }
                        }else{
                            echo '<p class="empty">your cart is empty!</p>';
                        }
                    ?>
                        <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                        <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
                        <div class="grand-total">grand total : <span>BHD<?= $grand_total; ?></span></div>
                    </div>

                <h3>place your orders</h3>

                <div class="flex">
                    <div class="inputBox">
                        <span>Your Name: </span>
                        <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" required>
                    </div>
                    <div class="inputBox">
                        <span>Your Phone Number: </span>
                        <input type="number" name="number" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
                    </div>
                    <div class="inputBox">
                        <span>Your Email: </span>
                        <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Payment Method :</span>
                        <select name="method" class="box" required>
                            <option value="cash on delivery">cash on delivery</option>
                            <option value="credit card">credit card</option>
                            <option value="BenefitPay">BenefitPay</option>
                            <option value="paypal">ApplePay</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>Area :</span>
                        <input type="text" name="area" placeholder="Manama" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Block :</span>
                        <input type="text" name="block" placeholder="777" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Street :</span>
                        <input type="text" name="street" placeholder="4444" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>House :</span>
                        <input type="text" name="house" placeholder="2222" class="box" maxlength="50" required>
                    </div>
                </div>

                <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">
            
            </form>
        </section>

        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>