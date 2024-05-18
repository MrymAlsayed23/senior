<?php
session_start();
$bid = $_GET['bid'];
ob_start();
date_default_timezone_set("Asia/Bahrain");
if (isset($_SESSION['uid'])) {
  $uid = $_SESSION['uid'];
  $oid =  $_GET['oid'];
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Order</title>
  </head>

  <style media="screen">
    .payment-bill {
      width: 70%;
      min-height: 80%;
      height: auto;
      display: flex;
      flex-direction: column;
      box-shadow: 0px 0px 10px darkgrey;
      margin-left: auto;
      margin-right: auto;
      margin-top: 3%;
      margin-bottom: 3%;
      padding: 3%;
    }

    .order-card {
      width: 90%;
      min-height: 70px;
      background-color: rgba(0, 0, 0, 0.02);
      margin-right: auto;
      margin-left: auto;
      margin-top: 2%;
      padding: 2px;
      display: flex;
      justify-content: flex-start;
    }

    .order-pic {
      max-height: 90%;
      width: 15%;
    }

    .order-pic img {
      height: 100%;
      width: 100%;
      object-fit: cover;
    }

    .order-title {
      min-height: 10%;
      max-height: 90%;
      min-width: 30%;
      max-width: 40%;
      margin-left: 5%;
      margin-right: 30%;
      display: flex;
    }

    .order-title h5 {
      align-items: center;
      margin: auto;
    }

    .order-price {
      min-height: 10%;
      max-height: 90%;
      min-width: 20%;
      max-width: 30%;
      display: flex;
    }

    .order-price h5 {
      align-items: center;
      margin: auto;
    }

    .phpInput {
      font-weight: bold;
      font-style: normal;
    }
  </style>

  <body>

    <!-- Nav Bar  -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="customerHome.php">
          <img src="../Images/Logo.jpg" alt="Logo" width="230" height="70">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                    try {
                      require('../connection.php');
                      $sql = "SELECT bname, bid FROM business";
                      $stmt = $db->query($sql);
                      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      foreach ($results as $row) {
                        echo "<li><a class='dropdown-item' href ='customerHome.php?bid=" . $row['bid'] . "'>" . $row['bname'] . "</a></li>";
                      }
                    } catch (PDOException $e) {
                      echo "Error: " . $e->getMessage();
                    }
                    ?>
                  </a>
                </li>
              </ul>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="menu.php?bid=<?php echo $bid; ?>">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php?bid=<?php echo $bid; ?>">Cart</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="orderstatus.php?bid=<?php echo $bid; ?>">Order Status</a>
            </li>


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profile
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">

      <div class="mt-5">
        <div class="container">

          <div class="payment-bill">
            <h2 style="color:rgba(0, 0, 0, 0.9)" class="mb-2">Order Summary</h2>

            <table>
              <thead>
                <tr>
                  <th>Product Picture</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th colspan="2">Total Price</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <?php
              try {
                  $sql = "SELECT * FROM orders WHERE uid = $uid AND bid = $bid AND oid = $oid";
                  $stmt_orders = $db->prepare($sql);
                  $stmt_orders->execute();
                  $order = $stmt_orders->fetch(PDO::FETCH_ASSOC);
              
                  if ($order) {
                      $sql1 = "SELECT * FROM order_items WHERE oid = $oid";
                      $stmt_order_items = $db->prepare($sql1);
                      $stmt_order_items->execute();
              
                      // Iterate over order items
                      while ($r = $stmt_order_items->fetch(PDO::FETCH_ASSOC)) {
                          $pid = $r['pid'];
                          $sql2 = "SELECT * FROM products WHERE pid = $pid";
                          $stmt_products = $db->prepare($sql2);
                          $stmt_products->execute();
                          $rs = $stmt_products->fetch(PDO::FETCH_ASSOC);
              
                          // Display product and order item information
              ?>
                          <tr>
                              <td><img src="data:image/jpeg;base64,<?php echo base64_encode($rs['image']); ?>" alt="" style="width:30%;"></td>
                              <td>
                                  <ul>
                                      <li><?php echo $rs['pname']; ?></li>
                                  </ul>
                              </td>
                              <td>
                                  <ul>
                                      <li><?php echo $r['quantity']; ?></li>
                                  </ul>
                              </td>
                              <td colspan="2">
                                  <ul>
                                      <li><?php echo $r['quantity'] * $rs['sellPrice']; ?></li>
                                  </ul>
                              </td>
                          </tr>
              <?php
                      } // End of while loop
              
                      // Calculate and display total price
                      $totalPrice = $order['total'];
              ?>
                      <tr>
                          <td colspan="2" style="text-align: left; padding-left:4rem;font-weight:bold">Total</td>
                          <td colspan="3" style="font-weight:bold"><?php echo $totalPrice . " BHD"; ?></td>
                      </tr>
              <?php
                  } else {
                      // No order found
                      echo "<center><h1>You have no order yet!</h1></center>";
                  }
              } catch (PDOException $e) {
                  echo $e->getMessage();
              }
              ?>

            </table>
          </div>
        </div>
      </div>

      <!-- footer  -->
      <?php include("../customer/footer.php"); ?>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>

  </html>
<?php
} //end if statement in the beginnign of the page 
?>
