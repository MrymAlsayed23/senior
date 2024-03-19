<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Bahrain");
if (!isset($_SESSION['username'])) {
header("Location:login.php");
exit(0);
}
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
    <body>

        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>

        <?php
        try {
          require("../connection.php");
          $total=0;
          $delivery=0.5;
          if (isset($_COOKIE['cart'])) {
            $cookiedetails=(array)json_decode($_COOKIE['cart'],true);
            foreach ($cookiedetails as $detail => $info) {
              $mealid=$cookiedetails[$detail]['mealid'];
              $rsp=$db->query("select * from product where pid ='$pid'")->fetchAll();
              foreach ($rsp as $row) {
                ?>
                <div class="order-card">
                  <div class="order-pic">
                    <img src="Images/Product/<?php echo $row[4] ?>" alt="">
                  </div>
                  <div class="order-title">
                    <h5><?php echo $row[1]; ?></h5>
                  </div>
                  <div class="order-price">
                    <h5><?php echo $row[3]; ?> BD</h5>

                  </div>

                </div>
              <?php
            $total+=$row[3]; }
            }
          }

        } catch (PDOException $e) {
          echo $e->getMessage();
        }
        try {
          $sql="select * from profile where userId=".$_SESSION['id'];
          $r=$db->query($sql);
          $db=null;
          $rs=$r->fetchAll(PDO::FETCH_ASSOC);
          foreach ($rs as $key => $value) {
        ?>
        <div class="order-card" style="text-align:left;">
          <p>Order was done by the user <i class="phpInput"> <?php echo $_SESSION['username']; ?></i>
            on <i class="phpInput"> <?php echo date("Y-m-d h:i:sa"); ?>
        </div>
        <h5 style="text-align:left;">Edit cart from <a href="cart.php">here</a> </h5>
        <form class="mt-3" method="post">
          <input type="submit" name="confirm" value="Confirm Order">

        </form>

      </div>
    <?php }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
    echo "</div>";
    extract($_POST);
    if (isset($confirm)) {
        try {
          $cookiearray=(array)null;
          setcookie("cart", json_encode($cookiearray), time()-(86400*7));
          require("../connection.php");
          $sqlStatement="insert into order (total,ostatus,time) values (:total, :ostatus, :time)";
          $stmt= $db->prepare($sqlStatement);
          $stmt->bindParam(':total',$totalDB);
          $stmt->bindParam(':ostatus',$ostatus);
          $stmt->bindParam(':time',$time);
          $dateDB= date("h:i:sa");
          $concatstring="";
          foreach ($cookiedetails as $key => $value) {
            $concatstring.= $value['pid'];
            $concatstring.=",";
          }
          $contentDB= rtrim($concatstring,",");

          // Status must be initiated by "issued" then, "cooking", then "on the way", then "received"
          $status="issued";
          $totalDB=$total;
          $stmt->execute();
          $db=null;
          $_SESSION['message']="true";
          header("Location:orderstatus.php");
          exit();
        }
      catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
    ob_end_flush();
    ?>
    </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>