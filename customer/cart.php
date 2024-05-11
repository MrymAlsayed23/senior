<?php
    // session_start();
    $bid = $_GET['bid'];  
    if (!(isset($_SESSION['shoppingcart'])) || empty($_SESSION['shoppingcart'])) {
        ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Cart</title>
    </head>
    <body>
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
        <!-- nav  -->
        <?php //include ("../customer/customerNavBar.php"); ?>

        <div class="container">

            <div class="text-center" style="margin-top:13.7rem;margin-bottom:14.5rem;">
                <h3>Your cart is empty</h3>
                <h5>
                    <a href="menu.php?bid=<?php echo $bid;?>">Back to Menu</a>
                </h5>
            </div>

        </div>

        <?php
        } //end if 
        
        else {
            
            try {
                require ('../connection.php');
                ?>

            <!-- Nav Bar  -->

            <div class="container" style="margin-bottom: 9rem;">
                <h3 text-align="center">Your Shopping Cart</h3><br />
                <br />
                <br>
                <div class="table-responsive" text-align="center" style="width:100%;">
                    <table style="text-align:center;" width="90%">
                        <tr>
                            <th class='itempiccart' width="23%"></th>
                            <th width="27%">Product</th>
                            <th width="18%">Quantity</th>
                            <th width="20%">Price</th>
                        </tr>
                        <form method='GET' action='checkout.php'>
                            <?php
                            $total = 0;
                            foreach ($_SESSION['shoppingcart'] as $productid => $productQuantity) {
                                // Prepare the SQL query to select specific columns from the products table
                                $sql = "SELECT pid, pname, sellPrice, pquantity, bid, image FROM products WHERE pid = :productid";

                                // Prepare the SQL statement
                                $stmt = $db->prepare($sql);

                                // Bind the product ID parameter
                                $stmt->bindParam(':productid', $productid, PDO::PARAM_INT);

                                // Execute the statement
                                $stmt->execute();

                                // Fetch the product details
                                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                                // Check if product details were retrieved
                                if ($product) {
                                    // Extract product details
                                    extract($product);

                                    // Convert image data to base64-encoded string
                                    $imageData = base64_encode($image);
                                    // Create the image source path
                                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;

                                    // Output product information
                                    echo "<tr>";
                                    echo "<td><img class='cartpic p-2' src='" . $imageSrc . "' width='150rem' height='150rem' /></td>";
                                    echo "<td>" . $pname . "</td>";
                                    echo "<td><input type='number' name='qtyitem[]' value='" . $productQuantity . "' min='0' max='100'></td>";
                                    echo "<td>" . floatval($sellPrice) . "</td>";
                                    echo "<input type='hidden' name='PriceItem[]' value='" . $sellPrice . "' />";
                                    echo "<input type='hidden' name='ItemID[]' value='" . $pid . "' />";
                                    echo "<input type='hidden' name='bid' value='" . $bid . "' />";
                                    echo "<td><a style='color:#0d9523; font-weight:bold' href='removefromcart.php?productID=" . $pid . "'>Remove</a></td></tr>";
                                    $total += floatval($sellPrice * $productQuantity);
                                }

                            }
                            ?>
                    </table>
                    <hr>

                    <table width="80%">
                        <tr>
                            <th style="text-align: left; padding-left:4rem;">Total</th>
                            <td></td>
                            <td></td>
                            <th><?php echo floatval($total) . " BHD"; ?></th>
                        </tr>

                        </tr>

                    </table>

                    <br><br>
                    <input type="hidden" name="total" value="<?php echo $total; ?>"> <?php //echo $total; ?>
                    <input class="btn btn-light" type='submit' name='checkout' value='Checkout' />

                    </form>
                </div>
            </div>

            <?php
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

    <!-- footer  -->
    <?php include ("../customer/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>
