<?php
  ob_start();
  session_start();
  date_default_timezone_set("Asia/Bahrain");
 
  if(isset($_SESSION['uid']) || isset($_SESSION['userId'])){
    $uid = $_SESSION['uid'];
    $userId = $_SESSION['userId'];
  }
else{
    $uid = '';
    //header('location:login.php');
};
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
      .payment-bill{
        width:70%;
        min-height:80%;
        height:auto;
        display: flex;
        flex-direction: column;
        box-shadow: 0px 0px 10px darkgrey;
        margin-left: auto;
        margin-right: auto;
        margin-top:3%;
        margin-bottom:3%;
        padding:3%;
      }
      .order-card{
        width: 90%;
        min-height: 70px;
        background-color: rgba(0, 0, 0, 0.02);
        margin-right: auto;
        margin-left: auto;
        margin-top:2%;
        padding:2px;
        display: flex;
        justify-content: flex-start;
      }
      .order-pic{
        max-height: 90%;
        width: 15%;
      }
      .order-pic img{
        height:100%;
        width:100%;
        object-fit: cover;
      }
      .order-title{
        min-height: 10%;
        max-height: 90%;
        min-width: 30%;
        max-width:40%;
        margin-left: 5%;
        margin-right:30%;
        display: flex;
      }
      .order-title h5{
        align-items: center;
        margin:auto;
      }
      .order-price{
        min-height: 10%;
        max-height: 90%;
        min-width: 20%;
        max-width:30%;
        display: flex;
      }
      .order-price h5{
        align-items: center;
        margin:auto;
      }
      .phpInput{
        font-weight:bold;
        font-style: normal;
      }
    </style>

    <body>

        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>

        <div class="container" style="text-align:center;">

          <div class="payment-bill">
            <h2 style="color:rgba(0, 0, 0, 0.9)" class="mb-2">Order Summary</h2>

            <?php
            try {
              require("../connection.php");
              $total=0;
              $delivery=0.5;
              if (isset($_COOKIE['cart'])) {
                $cookiedetails=(array)json_decode($_COOKIE['cart'],true);
                foreach ($cookiedetails as $detail => $info) {
                  $productid=$cookiedetails[$detail]['productid'];
                  $rsp=$db->query("select * from products where pid ='$productid'")->fetchAll();
                  foreach ($rsp as $row) {
                    ?>
                    <div class="order-card">
                      <div class="order-pic">
                        <img src="<?php echo $row[4] ?>" alt="">
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
                </i> including delivery fees of <i class="phpInput">
                  <?php echo $delivery; ?></i>
                making the total of the order = <i class="phpInput"><?php echo $total+$delivery; ?></i> BD. <br>
              Delivery location: <i class="phpInput"><?php echo $value['address']; ?></i><br>
              Telephone Number: <i class="phpInput"><?php echo $value['phone']; ?></i> </p>
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
              $sqlStatement="insert into orders (total, ostatus, time) values (:total, :ostatus, :time)";
              $stmt= $db->prepare($sqlStatement);
              $stmt->bindParam(':total',$totalDB);
              $stmt->bindParam(':ostatus',$ostatus);
              $stmt->bindParam(':time',$timeDB);

              $timeDB= date("Y-m-d h:i:sa");
              $ostatus="issued";
              $totalDB=$total+$delivery;
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

         <!-- footer  -->
         <?php include("../customer/footer.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
