<?php
// try {
  session_start();
  if (isset($_SESSION["uid"])){
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
//   $cookievalue = []; // Assuming you have an array of values to set as the cookie value
//   setcookie("cart", json_encode($cookievalue), time() + (86400 * 7));

//   if (isset($_POST['reorder'])) {
//     extract($_POST);
//     //$cookievalue = []; // Initialize $cookievalue as an empty array
//     if (isset($_COOKIE['cart'])) {
//       $previousdetails = (array) json_decode($_COOKIE['cart'], true);
//       foreach ($previousdetails as $details) {
//         $cookievalue[] = $details;
//       }
//     }
//     foreach ($p as $product => $productName) {
//       $proId = $productName;
//       $details['productId'] = $proId;
//       $cookievalue[] = $details;
//     }
//     //setcookie("cart", json_encode($cookievalue), time()+(86400*7));
//     header("Location:cart.php?bid=".$bid);
//   }
// } //end try (try tag at the beginning on the page)
// catch (PDOException $e) {
//   echo "Failed";
// }
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
                                <a class="nav-link" href="orderstatus.php?bid=<?php echo $bid; ?>">Orders</a>
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



  <div class="container-fluid">

    <!-- <h1>Your Orders</h1> -->

    <div class="mt-5">
      <div class="container">

      <center><h2>My Orders</h2></center>
      <table class="table table-sm"style="margin:4rem">
      <thead>
        <tr>
          <th></th>
          <th>Item</th>
          <th>Quantity</th>
          <th>Status</th>
          <th>Date/Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
             try {
               require('../connection.php');
               $sql = "SELECT * FROM orders WHERE uid=".$_SESSION['uid']." AND bid=$bid";
               $sql1 = $db->prepare("SELECT * FROM order_items WHERE uid=".$_SESSION['uid']."");
               $sql1->execute();
               $r = $sql1->fetch();
               if ($r>0){
               $id = $r['pid'];
               //echo $id;
               $sql2  = $db->prepare("SELECT * FROM products WHERE pid =$id");
               $sql2->execute();
               $rs = $sql2->fetch();
             }
               $row = $db->query($sql);
               $c=0;
               while ($rows = $row->fetch(PDO::FETCH_ASSOC)){
                  ++$c;
                 if ($c>0){
               ?>
        <tr>
          <td>#<?php echo $c; ?></td>
          <td> <ul>
            <li><?php echo $rs['pname']; ?></li>
          </ul> </td>
          <td> <ul>
            <li><?php echo $r['quantity'];  ?></li>
          </ul> </td>
          <td><?php echo $rows['ostatus']; ?></td>
          <td><?php echo $rows['time']; ?></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: left; padding-left:4rem;font-weight:bold">Total</td>
          <td style="font-weight:bold"><?php echo $rows['total']."BHD"; ?></td>
        </tr>
      <?php }
      else {echo "<center><h1>You have no order yet!</h1></center>";}
    }
 }
    catch (PDOException $e) {
          die ("Error occured: ".$e->getMessage());
        }
    ?>
      </tbody>
    </table>
  </div>
    </div>
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
<?php }?>
