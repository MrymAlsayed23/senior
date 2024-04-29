<?php
  try{
    session_start();
    if(isset($_SESSION['message'])){
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
    
    if(isset($_POST['reorder'])){
                extract($_POST);
                //$cookievalue = []; // Initialize $cookievalue as an empty array
                if (isset($_COOKIE['cart'])){
                $previousdetails=(array)json_decode($_COOKIE['cart'],true);
                foreach($previousdetails as $details){
                    $cookievalue[]=$details;
                }
              }
              //setcookie("cart", json_encode($cookievalue), time()+(86400*7));
              header("Location:cart.php");
            } 
          } //end try (try tag at the beginning on the page)
          catch(PDOException $e){
            echo "Failed";
          }
        ?>
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Order Status</title>
    </head>
    <body>
        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>
          
        <h1 text-align='center'>Your Orders</h1>
        <button>
          <a href="checkout.php">Checkout</a>
        </button>
        <?php
         try {
          require("../connection.php");
          $id=$_SESSION['id'];
          $data=$db->query("select * from orders")->fetchAll();
          if($data)
          {
            foreach($data as $row)
            {
              $u='';
              $pnames="";
              echo"<table align='center' border='1' width='500'>";
              echo"<tr>";
              echo"<th>Ordered By</th>";
              echo"<th>Time</th>";
              echo"<th>Order Contents</th>";
              echo"<th>Total Cost</th>";
              echo"<th>Order Status</th>";
              echo"<th>Reorder</th>";
              echo"</tr>";
              echo"<tr>";
              $uid=$row[1];
              $users=$db->query("select username from users WHERE uid='$id'")->fetchAll();
              foreach($users as $r)
              {
                $u=$r[0];
              }
              echo"<td>".$u."</td>";
              echo"<td>".$row[2]."</td>";
              $p=explode(",",$row[3]);
              foreach($p as $product=>$pname)
              {
                $products=$db->query("select pname from products WHERE pid='$pname'")->fetchAll();
                foreach($products as $p)
                {
                  if($pnames==="")
                  {
                    $pnames=$p[0];
                  }
                  else{
                  $pnames.=", ".$p[0];
                }
                }
              }
              echo"<td>".$pnames."</td>";
              echo"<td>".$row[5]."</td>";
              echo"<td>".$row[4]."</td>";
              echo"<td align='center'>";
              ?>
              <form method="POST">
                <input type='hidden' name='ordercontents' value="<?php echo $row[3]; ?>"/>
                <input type='submit' name='reorder' value='Reorder' placeholder='hi'/>
              </form>
              <?php
              echo"</td>";
              echo"</tr>";
            }
            echo"</table>";
          }
        }
        catch(PDOException $e){
            echo "Failed";
        }
        ?>

        <!-- footer  -->
        <?php include("../customer/footer.php"); ?>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
