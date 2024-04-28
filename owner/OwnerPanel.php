<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="owner.css">
  <body>
   <!--nav --> 
   
<?php 
    //include "nav.php";
 
 ?> 



<div class="container">
 <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->

 <div class="first">

 <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
<?php 
try {
  require ('../connection.php');
  $sql = "SELECT COUNT(*) AS total FROM orders";
  $orders = $db->prepare($sql);
  $orders->execute();
  $sql2 = "SELECT COUNT(*) AS total FROM orders WHERE ostatus='Completed'";
  $ordersCom = $db->prepare($sql2);
  $ordersCom->execute();
  $sql3 = "SELECT COUNT(*) AS total FROM users WHERE type='Customer'";
  $customers = $db->prepare($sql3);
  $customers->execute();
  $sql4 = "SELECT SUM(total) AS total FROM orders";
  $revenues = $db->prepare($sql4);
  $revenues->execute();
  ?>
    <div class="card">
  <div class="card-body">
  <div class="card-icon">
  <i class="fa-solid fa-sack-dollar fa-2xl"></i>
  </div>
  <?php 
    
    $d1 = $revenues->fetch(PDO::FETCH_ASSOC); 
    if ($d1) {
    ?>
    <h5 class="card-title"><?php echo $d1["total"]; } ?> BHD</h5>
    <p class="card-text">Total Revenue</p>
  </div>
</div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card">
  <div class="card-body">
  <div class="card-icon">
  <i class="fa-solid fa-boxes-packing fa-2xl"></i>
  </div>
  <?php 
    
    $details = $orders->fetch(PDO::FETCH_ASSOC); 
    if ($details) {
    ?>
  <h5 class="card-title"> <?php echo $details["total"]; } ?> </h5>
    <p class="card-text">Total Orders</p>
    
  </div>
</div>
    </div>


    <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card">
  <div class="card-body">
  <div class="card-icon">
  <i class="fa-solid fa-check fa-2xl"></i>
  </div>
  <?php 
    
    
    $det2 = $ordersCom->fetch(PDO::FETCH_ASSOC); 
    if ($det2) {
    ?>
    <h5 class="card-title"><?php echo $det2["total"]; }
?></h5>

    <p class="card-text">Completed Orders</p>
  </div>
</div>
    </div>

    
    <div class="col-lg-3 col-md-6 col-sm-6">

    <div class="card">
  <div class="card-body">
  <div class="card-icon">
  <i class="fa-solid fa-users fa-2xl"></i>
  </div>
  <?php 
    $det3 = $customers->fetch(PDO::FETCH_ASSOC); 
    if ($det2) {
    ?>
    <h5 class="card-title"><?php echo $det3["total"]; }?></h5>
    <p class="card-text">Total Customers</p>
  <?php  
  }
    catch (PDOException $e) {
    die($e->getMessage());
    }?>
  </div>
</div>
    </div>
  </div>
 </div>


 



  <!-- Stack the columns on mobile by making one full-width and the other half-width -->

  <div class="second">

  <div class="row">
    <div class="col-md-8">.col-md-8</div>
    <div class="col-sm-6 col-md-4">.col-6 .col-md-4</div>
  </div>


  </div>









  

    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="third">
    <div class="row">
    <div class="col-lg-8 col-12">
      <div class="mb-sm-1 ml-1 p-4" style="background-color: #eaeaec; border-radius: 12px";>
    <table class="table caption-top table-hover">
    <caption class="recent-orders">Recent Orders</caption>
  <thead>
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Price</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  <?php 
      try {
        $x = 0;
        require ('../connection.php');
        $sql = "SELECT * FROM orders WHERE ostatus = 'Pending'";
        $orders = $db->query($sql);
        
        while ($details = $orders->fetch()) {
          extract($details);
        ?>
    <tr>
      <th scope="row"><?php echo $details["oid"]; ?></th>
      <td>
      <?php 
          $sql2 = "SELECT uid, fname, lname FROM USERS";
          $r= $db->query($sql2);
          while ($det = $r->fetch()) {
          //echo $uid;
          if($details["uid"] == $det["uid"]) {
          echo $det["fname"]. " " .$det["lname"];}} //echo $uid;?>
      </td>
      <td><?php echo $details["total"]; ?></td>
      <td><?php echo $details["time"]; ?></td>
      <td><?php echo $details["ostatus"]; ?></td>
    </tr>
<?php }
$db = null;
}
catch (PDOException $e) {
die($e->getMessage());
}?>
    <!-- <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>Pending</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
      <td>Pending</td>
    </tr> -->
  </tbody>
</table>
    </div>
    </div>





    <div class="col-lg-4 col-12">
      
 <div class="mt-sm-1 mr-1 p-4" style="background-color: #eaeaec; border-radius: 12px";>
  <table class="table caption-top table-hover">
  <caption class="top-products">Top Products</caption>
  <tbody>
    <tr>
      <td><img src="1.jpg" alt=""></td>
      <td><h6 class="product-name">Product Name</h6><span class="product-span">Price $221</span></td>
      <td><p  class="borded-p">345 Sales</p></td>
    </tr>
    <tr>
      <td><img src="2.jpg" alt=""></td>
      <td><h6 class="product-name">Product Name</h6><span class="product-span">Price $200</span></td>
      <td><p  class="borded-p">345 Sales</p></td>
    </tr>
    </tbody>
    
  </table>
</div>
</div>


  </div>


  
    


  
</div>

</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>