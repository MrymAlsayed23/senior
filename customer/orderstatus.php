<?php
try {
  session_start();
  $bid = $_GET['bid'];  
  if (isset($_SESSION['message'])) {
    echo '<script type="text/javascript">';
    echo ' alert("Your order has been issued!")';
    echo '</script>';
    unset($_SESSION['message']);
  }
  date_default_timezone_set("Asia/Bahrain");
  // if (!isset($_SESSION['username'])) {
  //   header("Location:login.php");
  //   exit(0);
  // }
  // Set the "cart" cookie
  $cookievalue = []; // Assuming you have an array of values to set as the cookie value
  setcookie("cart", json_encode($cookievalue), time() + (86400 * 7));

  if (isset($_POST['reorder'])) {
    extract($_POST);
    //$cookievalue = []; // Initialize $cookievalue as an empty array
    if (isset($_COOKIE['cart'])) {
      $previousdetails = (array) json_decode($_COOKIE['cart'], true);
      foreach ($previousdetails as $details) {
        $cookievalue[] = $details;
      }
    }
    foreach ($p as $product => $productName) {
      $proId = $productName;
      $details['productId'] = $proId;
      $cookievalue[] = $details;
    }
    //setcookie("cart", json_encode($cookievalue), time()+(86400*7));
    header("Location:cart.php");
  }
} //end try (try tag at the beginning on the page)
catch (PDOException $e) {
  echo "Failed";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Order Status</title>
</head>
<style>
  .container-fluid {
    text-align: center;
  }
</style>

<body>
 
  <!-- Nav Bar  -->

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


                            <li class="nav-item">
                                <a class="nav-link" href="menu.php?bid<?php echo $bid; ?>">Menu</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="order.php?bid<?php echo $bid; ?>">Your Order</a>
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


                    </div>
            </nav>



  <div class="container-fluid">

    <h1>Your Orders</h1>

    <?php
    try {
      require ("../connection.php");
      $data = $db->query("select * from orders")->fetchAll();
      if ($data) {
        foreach ($data as $row) {
          $u = '';
          $productNames = "";
          echo "<table text-align='center' border='1' width='500'>";
          echo "<tr>";
          echo "<th>Ordered By</th>";
          echo "<th>Time</th>";
          echo "<th>Order Contents</th>";
          echo "<th>Total Cost</th>";
          echo "<th>Order Status</th>";
          echo "<th>Reorder</th>";
          echo "</tr>";
          echo "<tr>";
          $id = $row[1];
          //fixed here
          $users = $db->query("select username from users WHERE uid='".$_SESSION['uid']."'")->fetchAll();
          foreach ($users as $r) {
            $u = $r[0];
          }
          echo "<td>" . $u . "</td>";
          echo "<td>" . $row[2] . "</td>";
          $p = explode(",", $row[3]);
          foreach ($p as $product => $productName) {
            $products = $db->query("select pname from products WHERE pid='$productName'")->fetchAll();
            foreach ($products as $p) {
              if ($productNames === "") {
                $productNames = $p[0];
              } else {
                $productNames .= ", " . $p[0];
              }
            }
          }
          echo "<td>" . $productNames . "</td>";
          echo "<td>" . $row[5] . "</td>";
          echo "<td>" . $row[4] . "</td>";
          echo "<td align='center'>";
          ?>
          <form method="POST">
            <input type='hidden' name='ordercontents' value="<?php echo $row[3]; ?>" />
            <input type='submit' name='reorder' value='Reorder' placeholder='hi' />
          </form>
          <?php
          echo "</td>";
          echo "</tr>";
        }
        echo "</table>";
      }
    } catch (PDOException $e) {
      echo "Failed";
    }
    ?>
  </div>
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
