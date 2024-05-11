<?php
session_start();
$bid = $_GET['bid'];  
$cid = $_GET['cid'];  
// if (isset($_GET['cid'])) {
//     $cid = htmlspecialchars($_GET['cid']); // Sanitizing the input for safe output
//     echo $cid;
// }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Payment</title>
    </head>
    <body>
        <!-- nav -->
        <?php include ("../customer/customerNavBar.php"); ?>


        <!-- modified -->
        <div class="container" style="margin-bottom:17.5rem; margin-top:14rem">
            <?php
            if (!isset($_POST['btn'])) {
                ?>
                <div class="">
                    <h2>Payment Method</h2>
                </div>

                <form method="POST">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                            value="Debit/Credit Card" checked>
                        <label class="form-check-label" for="flexRadioDefault1">Debit/Credit Card</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                            value="Cash">
                        <label class="form-check-label" for="flexRadioDefault2">Cash</label>
                    </div>
                    <input class="btn btn-primary" type="submit" name="btn" value="Confirm">
                    <input type="hidden" name="cid" value="<?php echo $cid; ?>"> <!-- Maintain the cart ID through the transaction -->
                </form>

                <?php
                } elseif (isset($_POST['btn'])) {
                    $method = $_POST['flexRadioDefault'];
                    if ($method == 'Debit/Credit Card'){
                        ?>
                        <form class="" action="completePayment.php?cid=$cid&bid=$bid" method="POST">
                            <?php
                            try {
                                require('../connection.php');
                                $stmt = "SELECT * FROM cart WHERE cid = $cid"; //ned to check if we need to add $cid insted of ?
                                // $stmt->execute([$cid]); // Safe parameter binding
                                $row = $db->query($stmt);

                                while ($rows = $row->fetch(PDO::FETCH_ASSOC)){
                                    extract($rows);
                                ?>

                                <input type="hidden" name="amount" value="<?php echo $rows['total']; ?>">
                                <input type="hidden" name="cid" value="<?php echo $rows['cid']; ?>">
                                <input type="hidden" name="bid" value="<?php echo $rows['bid']; ?>">
                                <!-- Additional form fields for card details would go here -->
                                <input type="submit" class="btn btn-primary" value="Proceed to Payment"> <!--need to check this button-->
                                
                                <?php
                            } //end while loop
                            } //end try

                            catch (PDOException $e) {
                                die("Error occured:".$e->getMessage());
                            }
                            ?>

                            <form class="needs-validation" novalidate>
                                <div class="form-row">

                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom07">Payment Method</label>
                                        <input type="text" class="form-control" name="paym" id="validationCustom07" value="<?php echo $method; ?>"disabled>
                                        <input type="hidden" name="de" value="<?php echo $method; ?>">
                                    </div>
                                
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom08">Amount</label>
                                        <input type="text" class="form-control" id="validationCustom08" value="<?php echo $total." BHD"; ?>" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Card Number</label>
                                        <input type="text" class="form-control" name="cardno" id="validationCustom01" required>
                                        <div class="valid-feedback">Looks good!</div>
                                            <input type="hidden" name="payType" value="<?php echo $method; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02">Cardholder Name</label>
                                            <input type="text" class="form-control" id="validationCustom02" value="" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom04">Expiration Date</label>
                                        <input type="month" name="" value="" class="form-control" required>
                                        <div class="invalid-feedback" >Please select a valid Expiration Date.</div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom05">CCV</label>
                                        <input type="text" class="form-control" id="validationCustom05" required>
                                        <div class="invalid-feedback">Please provide a valid CCV.</div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <input type="hidden" name="payType" value="<?php echo $method; ?>">
                                    <div class="col-md-12" text-align="center">
                                        <input type="submit" class="btn btn-light" id="paying" name="pbtn" value="Pay">
                                        <input type="reset" class="btn btn-light" id="" name="" value="Clear">
                                        <a href='cart.php?cid=$cid&bid=$bid' class="btn btn-light">Cancel</a>
                                    </div>
                                </div>
                                
                            </form>
                        </form>
            
                        <script scr="pay.js"></script>
                        
                        <?php
                        } //end if method debt / card

                        else if($method == 'Cash'){ 
                            ?>
                            <form class="" action="completePayment.php?cid=$cid&bid=$bid" method="POST">
                                <?php
                                    try {
                                        $cid = $_GET['cid'];
                                        require('../connection.php');
                                        $sql = "SELECT * FROM cart WHERE cid = $cid";
                                        $row = $db->query($sql);
                                        while ($rows = $row->fetch(PDO::FETCH_ASSOC)){
                                            extract($rows);
                                            ?>
                                            <input type="hidden" name="amount" value="<?php echo $rows['total']; ?>">
                                            <input type="hidden" name="cid" value="<?php echo $rows['cid']; ?>">
                                            <?php
                                        } //end while loop
                                    } //end try 
                                    catch (PDOException $e) {
                                        die("Error occured:".$e->getMessage());
                                    }
                                ?>
                                <div class="form-row">

                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom07">Payment Method</label>
                                        <input type="text" class="form-control" name="paym" id="validationCustom07" value="<?php echo $method; ?>"disabled>
                                        <input type="hidden" name="payType" value="<?php echo $method; ?>">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom08">Amount</label>
                                        <input type="text" class="form-control" id="validationCustom08" name="total" value="<?php echo $total." BHD"; ?>" disabled>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="col-md-12" text-align="center">
                                        <input type="submit" class="btn btn-light" id="paying" name="placebtn" value="Place Order">
                                        <a href='cart.php?cid=$cid&bid=$bid' class="btn btn-light">Cancel</a>
                                    </div>
                                </div>
                                
                            </form>
                            <?php
                                } //end else if method cash
                            } //end else id isset btn
                            ?>
        </div> <!--end div container-->

        <!-- footer -->
        <?php include ("../customer/footer.php"); ?>
    
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
