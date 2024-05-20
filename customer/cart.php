<?php
    session_start();
    $bid = $_GET['bid'];  
    
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

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">

                            <?php
                                require('../connection.php');
                                $bid = $_GET['bid']; 
                                $sql = "SELECT blogo FROM business WHERE bid = :bid";
                                $stmt = $db->prepare($sql);
                                $stmt->bindValue(':bid', $bid, PDO::PARAM_INT);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                                if ($result) {
                                    $imageData = base64_encode($result['blogo']);
                                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                                    echo '<img src="' . $imageSrc . '" alt="Logo" width="90" height="70">';
                                }
                            ?>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 870px;">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="customerHome.php">Home</a>
                                </li>

                                <li class="nav-item dropdown">
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
                                </li> 


                                <li class="nav-item">
                                    <a class="nav-link" href="menu.php?bid=<?php echo $bid;?>">Menu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="cart.php?bid=<?php echo $bid;?>">Cart</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="orderstatus.php?bid=<?php echo $bid;?>">Order Status</a>
                                </li>

                            
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="profile.php?bid=<?php echo $bid;?>">Profile</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                
        <?php if (!(isset($_SESSION['shoppingcart'])) || empty($_SESSION['shoppingcart'])) { ?>

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
                <form method='GET' action='checkout.php'>
                    <table style="text-align:center;" width="90%">
                        <tr>
                            <th class='itempiccart' width="23%"></th>
                            <th width="27%">Product</th>
                            <th width="18%">Quantity</th>
                            <th width="20%">Price</th>
                        </tr>
                        
                            <?php
                            $total = 0;
                            foreach ($_SESSION['shoppingcart'] as $pid => $productQuantity) {
                                // Prepare the SQL query to select specific columns from the products table
                                $sql = "SELECT * FROM products WHERE pid = $pid";

                                // Prepare the SQL statement
                                $stmt = $db->prepare($sql);

                                // Bind the product ID parameter
                                //$stmt->bindParam(':pid', $pid, PDO::PARAM_INT);

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
                                    echo "<td><a style='color:#0d9523; font-weight:bold' href='removefromcart.php?productID=$pid&bid=$bid'>Remove</a></td></tr>";
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
