<?php 
session_start();
if (!(isset($_SESSION['owner'])))
{
  header('location:../home/home.php');
}
$bid = $_GET['bid'];
//echo $bid;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="o.css">
  <body>
   <!--nav --> 
   <?php 
     require('../connection.php');
     $sql00 = "SELECT * FROM business WHERE bid='$bid'";
     $r00 = $db->query($sql00);
     while ($d00 = $r00->fetch(PDO::FETCH_ASSOC)){
      extract($d00);
      $imageData = base64_encode($d00['blogo']);
      $imageSrc = 'data:image/jpg;base64,' . $imageData;
     
   ?>
   <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top pb-2">
      <div class="container-fluid">
      <img src="<?php echo $imageSrc; ?>" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        <a class="navbar-brand" href="ownerPanel.php?bid=<?php echo $bid;?>" >
          <?php echo $d00['bname']; ?>
      </a> <?php }?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="sidebar-item px-1">
              <a href="OwnerPanel.php?bid=<?php echo $bid; ?>" class="sidebar-link">
              <i class="fa-solid fa-house"></i>
              <span>Dashboard</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayProducts.php?bid=<?php echo $bid; ?>" class="sidebar-link">
              <i class="fa-solid fa-box"></i>
              <span>Products</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayOrders.php?bid=<?php echo $bid; ?>" class="sidebar-link">
              <i class="fa-solid fa-boxes-packing"></i>
              <span>Orders</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayCustomers.php?bid=<?php echo $bid; ?>" class="sidebar-link">
              <i class="fa-solid fa-users"></i>
              <span>Customers</span>
              </a>
          </li>

          <!-- <li class="sidebar-item px-1">
              <a href="" class="sidebar-link">
              <i class="fa-solid fa-palette"></i>
              <span>Edit Layout</span>
              </a>
          </li> -->

          <!-- <li class="sidebar-item px-1">
              <a href="" class="sidebar-link">
              <i class="fa-solid fa-comment-dots"></i>
              <span>Messages</span>
              </a>
          </li> -->
          <li class="sidebar-item px-1">
            <a href="ownerlogout.php" class="sidebar-link">
              <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
            </a>
        </li>

          </ul>
        </div>
      </div>
    </nav>








    </div>
    <div class="container">
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
  $sql = "SELECT COUNT(*) AS total FROM orders WHERE bid='$bid'";
  $orders = $db->prepare($sql);
  $orders->execute();
  $sql2 = "SELECT COUNT(*) AS total FROM orders WHERE ostatus='Completed' AND bid='$bid'";
  $ordersCom = $db->prepare($sql2);
  $ordersCom->execute();
  $sql3 ="SELECT COUNT(DISTINCT users.uid) AS total 
  FROM users
  INNER JOIN orders ON users.uid = orders.uid
  WHERE users.type = 'customer' AND orders.bid = $bid";
  $customers = $db->prepare($sql3);
  $customers->execute();
  $sql4 = "SELECT SUM(total) AS total FROM orders WHERE bid='$bid' AND ostatus='Completed'";
  $revenues = $db->prepare($sql4);
  $revenues->execute();
  $sql5 = "SELECT p.pid, p.pname,p.sellPrice,p.image, SUM(oi.quantity) AS TotalSales
  FROM products p
  INNER JOIN order_items oi ON p.pid = oi.pid
  INNER JOIN orders o ON oi.oid = o.oid
  WHERE o.bid=$bid AND o.ostatus = 'Completed'
  GROUP BY p.pid
  ORDER BY TotalSales DESC
  LIMIT 2";
  $topSales = $db->prepare($sql5);
  $topSales->execute();

  $sql6 = "SELECT COUNT(*) AS total FROM rating WHERE bid='$bid'";
  $dataSql6 = $db->prepare($sql6);
  $dataSql6->execute();
  $dTotal = $dataSql6->fetch(PDO::FETCH_ASSOC);
  $sql7 = "SELECT SUM(urating) AS totalRating FROM rating WHERE bid='$bid'";
  $datasql7 = $db->prepare($sql7);
  $datasql7->execute();
  $dSUM = $datasql7->fetch(PDO::FETCH_ASSOC);
  $sql8 = "SELECT * FROM rating WHERE bid='$bid'";
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
       <h1 class="mb-5">Orders Over Months</h1>
       <div>

        <canvas id="myChart"></canvas>
          </div>
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
                  <?php if ($dSUM['totalRating'] == 0 ) {?>

                  <i class="fa-solid fa-star mr-1 main_star"  style="color:#adb2bd;"></i>
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>


              <?php } if ($dSUM['totalRating'] > 0 ) { 
                if (round($dSUM['totalRating']/$dTotal['total'], 3) >= 1 
                 && round($dSUM['totalRating']/$dTotal['total'], 3)  < 2)  { ?>
                  
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                  <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                  <?php }
              if (round($dSUM['totalRating']/$dTotal['total'],3 ) >= 2 
              && round($dSUM['totalRating']/$dTotal['total'], 3)  < 3)  { ?>
                  
                    <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                    <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                    <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                    <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                    <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                    <?php }
             if (round($dSUM['totalRating']/$dTotal['total'], 3) >= 3
             &&  round($dSUM['totalRating']/$dTotal['total'], 3) < 4)  { ?>
                  
                <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                <?php }
                if (round($dSUM['totalRating']/$dTotal['total'], 3) >= 4 
                &&  round($dSUM['totalRating']/$dTotal['total'], 3) < 5)  { ?>
                     
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #adb2bd;"></i>
                   <?php }
                 
                if (round($dSUM['totalRating']/$dTotal['total'], 3) == 5  
                ||  round($dSUM['totalRating']/$dTotal['total'], 3) > 5)  { ?>
                     
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <i class="fa-solid fa-star mr-1 main_star " style="color: #FFD43B;"></i>
                   <?php }   
                
              }}?>
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
}
?>
              <p>
      <div class="progress-label-left float-start px-2"><b>5</b><i class="fa-solid fa-star px-1" style="color: #FFD43B;"></i>
      </div>

      <div class="progress-label-right float-end px-2">
      (<span id="total-five-star-review"><?php echo $five_star_review; ?></span>)</div>
      
      <div class="p-1">
      <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" id=five_star_progress style="width:<?php
        if ($dSUM['totalRating'] == 0){echo '0';}
        else {
        echo ($five_star_review/$dSUM['totalRating'])*100; }?>%;">
        
        
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
        if ($dSUM['totalRating'] == 0){echo '0';}
        else {
        echo ($four_star_review/$dSUM['totalRating'])*100; }?>%;">
        
        
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
        if ($dSUM['totalRating'] == 0){echo '0';}
        else {
        echo ($three_star_review/$dSUM['totalRating'])*100; }?>%;">
        
        
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
        if ($dSUM['totalRating'] == 0){echo '0';}
        else {
        echo ($two_star_review/$dSUM['totalRating'])*100; }?>%;">
        
        
      </div>
      
      </div></div>
      </p>
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
        if ($dSUM['totalRating'] == 0){echo '0';}
        else{
        echo ($one_star_review/$dSUM['totalRating'])*100; }?>%;">
        
      </div>
      
      </div></div>
                </p>

             <?php  
             }?>
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
        $sql = "SELECT * FROM orders WHERE ostatus = 'Pending' AND bid=$bid";
        $orders = $db->query($sql);
        if ($orders){
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
        }
 
//$db = null;
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
    if ($topSales){
    while ($top = $topSales->fetch()){
      extract($top); 
      $imageData = base64_encode($top['image']);
      $imageSrc = 'data:image/jpeg;base64,' . $imageData;
      ?>
    <tr>
      <td><img src="<?php echo $imageSrc ;?>" alt=""></td>
      <td><h6 class="product-name"><?php echo $top["pname"];?></h6>
      <span class="product-span"><?php echo "Price ".$top["sellPrice"]. " BHD";?></span></td>
      <td><p  class="borded-p"><?php echo $top["TotalSales"]. " Sales";?></p></td>
    </tr>
    <?php 
    }}?>
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

<?php }
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
<script>
<?php 
            $sqlcan = "SELECT COUNT(*) AS order_count, MONTH(time) AS order_month
            FROM orders
            WHERE bid = $bid
            GROUP BY MONTH(time)";
$stmtcan = $db->prepare($sqlcan);
$stmtcan->execute();
$results = $stmtcan->fetchAll(PDO::FETCH_ASSOC);
$labels = ['January','February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
          'October', 'November', 'December'];
$data = array_fill(0, 12, 0); // Initialize data array with zeros
foreach($results as $row) {
    $monthIndex = $row['order_month'] - 1; // Adjust month index to start from 0
    $data[$monthIndex] = $row['order_count'];
}
?>
// === include 'setup' then 'config' above ===
const ctx = document.getElementById('myChart');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?php 
      echo json_encode($labels); 
      ?>,
    datasets: [{
      label: 'Orders Count',
      data: <?php 
        echo json_encode($data);
      ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 205, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 205, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(153, 102, 255, 1)',
        
      ],
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>

  </body>
</html>