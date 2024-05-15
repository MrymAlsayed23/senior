<?php
    session_start();
    $bid = $_GET['bid'];  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <title>Menu</title>
</head>
<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .card {
        flex: 0 0 18rem;
        margin: 10px;
    }
    
    .card-container .card .fa-heart{
        position: absolute;
        top:-1rem;
        height: 4.5rem;
        width: 4.5rem;
        line-height: 4.2rem;
        font-size: 2rem;
        background-color: var(--white);
        border:var(--border);
        border-radius: .5rem;
        text-align: center;
        color:var(--black);
        cursor: pointer;
        transition: .2s linear;
        /* right: -9rem; */
        background-color: var(--black);
        right: -1rem;
        color: red;

    }
</style>

<body>

        <!-- Nav Bar  -->


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
                                <a class="nav-link" href="orderstatus.php?bid=<?php echo $bid;?>">Order Status</a>
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

            </nav>


        <div class="card-container">

        
            <?php
            try {
                require('../connection.php');
                $sql = "SELECT * FROM products WHERE bid = $bid";
                $stmt = $db->query($sql); 
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $row) {
                    extract($row);
                    $imageData = base64_encode($image);
                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            
            ?>
            <div class="card" style="width: 18rem;">
                <!-- <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button> --> <!--heart icon for wishlist page-->
                
                <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="..."> <!-- Product Image -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo $pname; ?></h5> <!-- Product Name -->
                    <p class="card-text"><?php echo $Details; ?>.</p><!-- Product Details -->
                    <h6><?php echo $sellPrice." BD"; ?></h6>
                    
                    <form method="POST" action="addToCart.php?bid=<?php echo $bid;?>">
                        <input type="number" name="pquantity" id="" min="0" max="10">
                        <input type="hidden" name="pid" id="" value='<?php echo $pid;?>' />
                        <input type="hidden" name="bid" id="" value='<?php echo $bid;?>' />
                        <button type="submit" class="btn btn-primary" name="add" onclick="addToCart()">Add to Cart</button>                    
                    </form>
                </div>
            </div>

            <?php
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
    </div>

    <script>
        function addToCart() {
            alert("Successfully added to cart");
        }
    </script>

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
