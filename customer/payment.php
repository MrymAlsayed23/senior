<?php
    session_start();
    if (isset($_GET['cid'])) {
        $cid = $_GET['cid'];
     }
     else {
        // Handle the case where 'cid' is not set in the GET request
        die("Error: 'cid' parameter is not set.");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Payment</title>
    </head>
    <body>
        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>
        
        <div class="container" style="margin-bottom:17.5rem;margin-top:14rem">
        
            <?php if (!isset($_GET['btn'])){ ?>
                <div class="">
                    <h2>Payment Method</h2>
                </div>
                
                <form class="" method="GET">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Debit/Credit Card" checked>
                        <label class="form-check-label" for="flexRadioDefault1">Debit/Credit Card</label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Cash">
                        <label class="form-check-label" for="flexRadioDefault2">Cash</label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="submit" name="btn" value="Confirm">
                    </div>
                </form>
                
                <?php
                }
                else if(isset($_GET['btn'])){
                    $method = $_GET['flexRadioDefault'];
                    if ($method == 'Debit/Credit Card'){
                        ?>
                        
                        <form class="" action="completePayment.php" method="GET">
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
                                    } //end while
                                } //end try
                                
                                catch (PDOException $e) {
                                    die("Error occured:".$e->getMessage());
                                }

                                    ?>
                                    
                                <form class="row g-3 needs-validation" novalidate>
                                    <div class="col-md-4">
                                            <label for="validationCustom01">Payment Method</label>
                                            <input type="text" class="form-control" name="paym" id="validationCustom01" value="<?php echo $method; ?>"disabled>
                                            <input type="hidden" name="de" value="<?php echo $method; ?>">
                                    </div>
                                        
                                    <div class="col-md-4">
                                        <label for="validationCustom02" class="form-label">Amount</label>
                                        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $total." BHD"; ?>" disabled>
                                    </div>
                                        
                                    <div class="col-md-4">
                                            <label for="validationCustom03">Card Number</label>
                                            <input type="text" class="form-control" name="cardno" id="validationCustom03" required>
                                            <div class="valid-feedback">Looks good!</div>
                                            <input type="hidden" name="payType" value="<?php echo $method; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom04">Cardholder Name</label>
                                            <input type="text" class="form-control" id="validationCustom04" value="" required>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">Expiration Date</label>
                                            <input type="month" name="" value="" id="validationCustom03" class="form-control" required>
                                            <div class="invalid-feedback" >
                                                Please select a valid Expiration Date.
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">CCV</label>
                                            <input type="text" class="form-control" id="validationCustom05" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid CCV.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <input type="hidden" name="payType" value="<?php echo $method; ?>">
                                        <div class="col-md-12" text-align="center">
                                            <input type="submit" class="btn btn-light" id="paying" name="pbtn" value="Pay">
                                            <input type="reset" class="btn btn-light" id="" name="" value="Clear">
                                            <a href='showcart.php' class="btn btn-light">Cancel</a>
                                        </div>
                                    </div>
                                </form>

                            </form>
                            
                            <?php
                            }
                            else if($method == 'Cash'){
                                ?>
                                
                                <form class="" action="completePayment.php" method="GET">
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
                                        }
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
                                            <a href='showcart.php' class="btn btn-light">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                                    <?php
                                    } //end else if
                                }
                                    ?>
                        </div> <!--end div container-->
        <!-- footer  -->
        <?php include("../customer/footer.php"); ?>
        <script scr="pay.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
