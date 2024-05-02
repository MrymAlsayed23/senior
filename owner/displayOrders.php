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

<!-- show Modal (for orders_item) (more Details about Orders) -->


  <div class="modal fade" id="staticBackdropShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Order Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="showData">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Update Order Status</button>
      </div>
    </div>
</div>
</div>

  


<div class="container">
<div class="container mt-5">
  <div class="container">
  <table class="table caption-top table-display-products table-hover">
  <caption class="display-products-caption"><h3>Orders</h3>
  <span class="display-products-span-caption-p">
    <?php 
      try {
        $x = 0;
        require ('../connection.php');
        $sql = "SELECT * FROM orders";
        $orders = $db->query($sql);
        $sql1 = "SELECT COUNT(*) AS total FROM orders";
  $orders1 = $db->prepare($sql1);
  $orders1->execute();
        $details1 = $orders1->fetch(PDO::FETCH_ASSOC); 
    if ($details1) {
    ?>
    <p><?php echo $details1["total"]; } ?> Orders Found</p></span>

<div class="container mt-5" style="color: azure";>
    <div class="row">
      <div class="col">
        <button class="filter-orders" id="filter-all">All Orders</button>
      </div>

      <div class="col">
        <button class="filter-orders" id="filter-pen">Pending</button>
      </div>

      <div class="col">
        <button class="filter-orders" id="filter-dis">Dispatch</button>
      </div>

      <div class="col">
        <button class="filter-orders" id="filter-com">Completed</button>
      </div>


        
          <div class="col">
          <form action="">
          <input type="date" class="filter-orders-date" id = "date1">
          </div>
          <div class="col">
          <input type="date" class="filter-orders-date" id = "date2">
          </form>
          </div>
          
          <!-- <div class="col mx-0">
            <p>to</p>
            </div>
        
        <div class="col">
          
        </div> -->
        
    </div>
    </div>
</caption>




  <thead>
    <tr>
    <!--<th><a href="">Add New Products</a></th>-->
    </tr>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Total Price</th>
      <th scope="col">Time</th>
      <th scope="col">Status <!--<button class="orderingButton"><i class="fa-solid fa-up-down"></i></button>--></th>
      <!--<th scope="col">Quantity<button class="orderingButton"><i class="fa-solid fa-up-down"></i></button></th>-->
      <th scope="col"></th>
      <!--<th scope="col"></th>-->
    </tr>
    <!-- <tr>
        <th></th><th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr> -->
  </thead>
  <tbody id="FilterData">
    
    <?php 
     while ($details = $orders->fetch()) {
      extract($details);
    ?>
    <tr>
    <div class="container mt-5">
      <th scope="row" class="oid"><?php echo $details["oid"]; ?></th>
      <td><?php 
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
    <td><button class="ShowProductsButton">
      <i class="fa-solid fa-square-caret-down"></i>
    </button></td>
    <!--<td><button class="updateProductsButton"
      data-bs-toggle="modal" data-bs-target="#staticBackdropUpdate">
      <i class="fa-solid fa-pen-to-square"></i>
    </button></td>-->
    </div>
    </tr>
    <?php }
       
    $db = null;
          }
     catch (PDOException $e) {
     die($e->getMessage());
   }
      
  
     ?>
    <!-- <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>@mdo</td>
    <td><button class="ShowProductsButton" 
      data-bs-toggle="modal" data-bs-target="#staticBackdropShow">
      <i class="fa-solid fa-square-caret-down"></i>
    </button></td> -->
   <!-- <td><button class="updateProductsButton"
      data-bs-toggle="modal" data-bs-target="#staticBackdropUpdate">
      <i class="fa-solid fa-pen-to-square"></i>
    </button></td>-->

    <!-- </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
      <td>@mdo</td>
    <td><button class="ShowProductsButton"
      data-bs-toggle="modal" data-bs-target="#staticBackdropShow">
      <i class="fa-solid fa-square-caret-down"></i>
    </button></td> -->
    <!--<td><button class="updateProductsButton"
      data-bs-toggle="modal" data-bs-target="#staticBackdropUpdate">
      <i class="fa-solid fa-pen-to-square"></i>
    </button></td>-->
    <!-- </tr> -->
   
  </tbody>

</table>
</div>
</div>
</div>















    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/FilterOrdersByStatus.js"></script>
    <script src="js/FilterOrdersByDate.js"></script>
    <script src="js/ShowOrderItems.js"></script>
  </body>
</html>