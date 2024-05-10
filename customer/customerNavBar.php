<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Customer NavBar</title>
    </head>

    <style>
        ul{
            display: flex;
            gap: 1rem;
            list-style: none;
        }
        ul li{
            display: grid;
            margin: 0;
        }
        .nav-item::before{
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            transform: scaleX(0);
            transition: all .5s ease;
            bottom: 0;
            left: 0;
        }
    </style>
    <body>

        <div class="container-fluid">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="customerHome.php">
                    <img src="../Images/Logo.jpg" alt="Logo" width="230" height="70">
                </a>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
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


                            <!-- <li class="nav-item">
                                <a class="nav-link" href="menu.php">Menu</a>
                            </li> -->


                            <li class="nav-item">
                                <a class="nav-link" href="orderstatus.php">Order Status</a>
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

                <div class="header-item item-right">
                    <?php
                    try{
                        require('../connection.php');
                        $count_wishlist_items = $db->prepare("SELECT * FROM `wish_list` WHERE uid = ?");
                        //$count_wishlist_items->execute([$user_id]);
                        $total_wishlist_counts = $count_wishlist_items->rowCount();
            
                        $count_cart_items = $db->prepare("SELECT * FROM `cart` WHERE uid = ?");
                        //$count_cart_items->execute([$uid]);
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


                    </div>
            </nav>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
