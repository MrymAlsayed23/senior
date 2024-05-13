<?php
session_start();
$bid = $_GET['bid'];  
$cid = $_GET['cid'];  
// echo $bid;
// echo $cid;
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="customerHome.php">
                <img src="../Images/Logo.jpg" alt="Logo" width="230" height="70">
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="customerHome.php">Home</a>
                            </li>

                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Business
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <?php
                                                try{
                                                    require('../connection.php');
                                                    $sql = "SELECT bname, bid FROM business";
                                                    $stmt = $db->query($sql); 
                                                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($results as $row) {
                                                        echo "<li><a class='dropdown-item' href ='customerHome.php?bid=".$row['bid']."'>".$row['bname']."</a></li>";
                                                    }
                                                }
                                                catch (PDOException $e) {
                                                    echo "Error: " . $e->getMessage();
                                            }
                                            ?>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->


                            <li class="nav-item">
                                <a class="nav-link" href="menu.php?bid=<?php echo $bid;?>">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cart.php?bid=<?php echo $bid;?>">Cart</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="orderstatus.php?bid=<?php echo $bid; ?>">Order Status</a>
                            </li>

                            

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="login.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Login
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="register.php">Sign Up</a></li>
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>


                <div class="header-item item-right">
                    <?php
                    try{
                        require('../connection.php');
                        $count_wishlist_items = $db->prepare("SELECT * FROM `wish_list` WHERE uid = ?");
                        //$count_wishlist_items->execute([$user_id]);
                        $total_wishlist_counts = $count_wishlist_items->rowCount();
            
                        $count_cart_items = $db->prepare("SELECT * FROM `cart` WHERE uid = ?");
                        // $count_cart_items->execute([$uid]);
                        $total_cart_counts = $count_cart_items->rowCount();
                    }  
                    catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>

                            <a href="wishlist.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </a>

                            <a href="cart.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg> 
                            </a>
                                                   
                        </div>
            </nav>


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
                        <form class="" action="completePayment.php?cid=<?php echo $cid;?>&bid=<?php echo $bid;?>"
                         method="POST">
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
                            <form class="" action="completePayment.php?cid=<?php echo $cid;?>&bid=<?php echo $bid;?>" method="POST">
                               <input type="number" value="<?php echo $bid;?>" name="bid" hidden>
                               <input type="number" value="<?php echo $cid;?>" name="cid" hidden>
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
