<?php 
// session_start();
// if (isset($_SESSION['owner']))
// {

?>

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
   <div class="container" style="flex-direction:column;">
    <?php 
      include "nav.php";
    ?> 



  <div class="container mt-5 mb-5">
    
 <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->

 <div class="first">

 <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
<?php 
try {
  $five_star_review = 0;
        $four_star_review = 0;
        $three_star_review = 0;
        $two_star_review = 0;
        $one_star_review = 0;
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
  $sql5 = "SELECT p.pid, p.pname,p.sellPrice, SUM(oi.quantity) AS TotalSales
  FROM products p
  INNER JOIN order_items oi ON p.pid = oi.pid
  GROUP BY p.pid
  ORDER BY TotalSales DESC
  LIMIT 2";
  $topSales = $db->prepare($sql5);
  $topSales->execute();

  $sql6 = "SELECT COUNT(*) AS total FROM rating";
  $dataSql6 = $db->prepare($sql6);
  $dataSql6->execute();
  $dTotal = $dataSql6->fetch(PDO::FETCH_ASSOC);
  $sql7 = "SELECT SUM(urating) AS totalRating FROM rating";
  $datasql7 = $db->prepare($sql7);
  $datasql7->execute();
  $dSUM = $datasql7->fetch(PDO::FETCH_ASSOC);
  $sql8 = "SELECT * FROM rating";
  $datasql8 = $db->query($sql8);


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
  
  </div>
</div>
    </div>
  </div>
 </div>


 



  <!-- Stack the columns on mobile by making one full-width and the other half-width -->

  <div class="second">
  <div class="row">

    <div class="col-md-8">
       <div class="mb-sm-1 ml-1 p-4" style="background-color: #eaeaec; border-radius: 12px";>

       </div>
    </div>
    

    <!-- <div class="row"> -->

    <div class="col-sm-12 col-md-4">
     <div class="mb-sm-1 ml-1 p-4" style="background-color: #eaeaec; border-radius: 12px";>
     <!-- <div class="container"> -->
      <h1 class="mt-1 mb-4">Customers Review</h1>
      <div class="card">
        <div class="card-header">
          <div class="card-body">
            <div class="col">
              <div class="col text-center">
                <h1 class="text-warning mt-1 mb-2">
                  <?php if($dTotal){?>
                  <b><span id="average_rating"><?php if ($dSUM){
                    if ($dSUM['totalRating'] == 0 ){ echo "0"; }
                    else {
                     echo round($dSUM['totalRating']/$dTotal['total'], 2); //total is the number of customers
                                                                 // totalRating is the sum of rating
                     }?>                                        
                </span>/5</b>
                </h1>
                <div class="mb-3">
                  <!-- <div class="str">
                    <div class="rating">
                      <div class="rating-stars">
                        <div class="grey-stars"></div>
                        <div class="filled-stars" style="width:70%"></div>
                      </div>
                    </div>
                  </div> -->
                <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                </div>
                <h6>
                  <span id="total_review"><?php
                  if ($dTotal["total"] == 0) {echo "No ";}
                  else { 
                  echo $dTotal["total"]; }?></span> Reviews
                </h6>
              </div>
              <div class="col">

<?php while ($d10 = $datasql8->fetch(PDO::FETCH_ASSOC)) {
          extract($d10);
          if ($d10["urating"] == 5){
            $five_star_review ++;
          }
          if ($d10["urating"] == 4){
            $four_star_review ++;
          }
          if ($d10["urating"] == 3){
            $three_star_review ++;
          }
          if ($d10["urating"] == 2){
            $two_star_review ++;
          }
          if ($d10["urating"] == 1){
            $one_star_review ++;
          }
}?>
              <p>
      <div class="progress-label-left float-start px-2"><b>5</b><i class="fa-solid fa-star px-1" style="color: #FFD43B;"></i>
      </div>

      <div class="progress-label-right float-end px-2">
      (<span id="total-five-star-review"><?php echo $five_star_review; ?></span>)</div>
      
      <div class="p-1">
      <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" id=five_star_progress style="width:<?php
        echo ($five_star_review/$dSUM['totalRating'])*100; ?>%;">
        
        
      </div>
      
      </div></div>
      
    </p>
                <p>
                <div class="progress-label-left float-start px-2"><b>4</b><i class="fa-solid fa-star px-1" style="color: #FFD43B;"></i>
      </div>

      <div class="progress-label-right float-end px-2">
      (<span id="total-four-star-review"><?php echo $four_star_review; ?></span>)</div>
      
      <div class="p-1">
      <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" id=four_star_progress
        style="width:<?php
        echo ($four_star_review/$dSUM['totalRating'])*100; ?>%;">
        
        
      </div>
      
      </div></div>
                </p>
                <p>
                <div class="progress-label-left float-start px-2"><b>3</b><i class="fa-solid fa-star px-1" style="color: #FFD43B;"></i>
      </div>

      <div class="progress-label-right float-end px-2">
      (<span id="total-three-star-review"><?php echo $three_star_review; ?></span>)</div>
      
      <div class="p-1">
      <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" id=three_star_progress
        style="width:<?php
        echo ($three_star_review/$dSUM['totalRating'])*100; ?>%;">
        
        
      </div>
      
      </div></div>
                </p>
                <p>
                <div class="progress-label-left float-start px-2"><b>2</b><i class="fa-solid fa-star px-1" style="color: #FFD43B;"></i>
      </div>

      <div class="progress-label-right float-end px-2">
      (<span id="total-two-star-review"><?php echo $two_star_review; ?></span>)</div>
      
      <div class="p-1">
      <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" id=two_star_progress
        style="width:<?php
        echo ($two_star_review/$dSUM['totalRating'])*100; ?>%;">
        
        
      </div>
      
      </div></div>
                <p>
                <div class="progress-label-left float-start px-2"><b>1</b><i class="fa-solid fa-star px-1" style="color: #FFD43B;"></i>
      </div>

      <div class="progress-label-right float-end px-2">
      (<span id="total-one-star-review"><?php echo $one_star_review; ?></span>)</div>
      
      <div class="p-1">
      <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" id=one_star_progress
        style="width:<?php
        echo ($one_star_review/$dSUM['totalRating'])*100; ?>%;">
        
        
      </div>
      
      </div></div>
                </p>
                <?php }}?>
              </div>

            </div>
          </div>
        </div>
      </div>
      </div>
     <!-- </div> -->
    </div>
    <!-- </div> -->






  
  </div>

  </div>







  

    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="third">
    <div class="row">
    <div class="col-lg-8 col-12">
      <div class="mb-sm-1 ml-1 mt-2 p-4" style="background-color: #eaeaec; border-radius: 12px";>
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
    <?php
    while ($top = $topSales->fetch()){; 
      extract($top); ?>
    <tr>
      <td><img src="" alt=""></td>
      <td><h6 class="product-name"><?php echo $top["pname"];?></h6>
      <span class="product-span"><?php echo "Price ".$top["sellPrice"]. " BHD";?></span></td>
      <td><p  class="borded-p"><?php echo $top["TotalSales"]. " Sales";?></p></td>
    </tr>
    <?php }?>
    <!-- <tr>
      <td><img src="2.jpg" alt=""></td>
      <td><h6 class="product-name">Product Name</h6><span class="product-span">Price $200</span></td>
      <td><p  class="borded-p">345 Sales</p></td>
    </tr> -->
    </tbody>
    
  </table>
</div>
</div>


  </div>
  <?php  
  }
    catch (PDOException $e) {
    die($e->getMessage());
    }?>
</div>









</div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </body>
</html>
<?php //}?>