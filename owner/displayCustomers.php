<?php 
session_start();
if (!(isset($_SESSION['owner'])))
{
  header('location:../home/home.php');
}
$bid = $_GET['bid'];
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Customers</title>
  <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="o.css">

<body>


<div class="modal fade" id="staticBackdropShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropShowLabel">More Details ..</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="showMessage">
          <form action="messageModal.php" method="post">
          <div class="modal-body">
            <div class="mb-3">
              <input type="hidden" class="form-control" id="pid" name="pid">
            </div>
            <div class="mb-3">
              <label for="" class="form-label" style="font-weight:bold;">Type Your Message</label><br>
              <textarea name="msg" id="" cols="30" rows="5" placeholder="Your Message ..."></textarea>
            </div>
            <div class="modal-footer">
            <button type="submit" name="sendmsg" class="btn btn-primary" style="background-color:#d61b6c;border-color:#d61b6c;">Send</button>
          </div>
          </div>
          </form>

          </div>

        </div>
      </div>
    </div>
  </div>




  <?php 
     require('../connection.php');
     $sql00 = "SELECT * FROM business WHERE bid='$bid'";
     $r00 = $db->query($sql00);
     while ($d00 = $r00->fetch(PDO::FETCH_ASSOC)){
      extract($d00);
     
   ?>



  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top pb-2">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><?php echo $d00['bname'];?></a> <?php }?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="sidebar-item px-1">
              <a href="OwnerPanel.php?bid=<?php echo $bid;?>" class="sidebar-link">
              <i class="fa-solid fa-house"></i>
              <span>Dashboard</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayProducts.php?bid=<?php echo $bid?>" class="sidebar-link">
              <i class="fa-solid fa-box"></i>
              <span>Products</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayOrders.php?bid=<?php echo $bid?>" class="sidebar-link">
              <i class="fa-solid fa-boxes-packing"></i>
              <span>Orders</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayCustomers.php" class="sidebar-link">
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

          <li class="sidebar-item px-1">
              <a href="" class="sidebar-link">
              <i class="fa-solid fa-comment-dots"></i>
              <span>Messages</span>
              </a>
          </li>
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
 
<div class="container-fluid">
  <div class="container mt-5">
    <div class="container">

    <?php
    try {
      require ('../connection.php');
      $sql ="SELECT * 
      FROM users
      INNER JOIN orders ON users.uid = orders.uid
      WHERE users.type = 'Customer' AND orders.bid = $bid";
      $customers = $db->query($sql);
      $sql1 = "SELECT COUNT(*) AS total 
      FROM users
      INNER JOIN orders ON users.uid = orders.uid
      WHERE users.type = 'customer' AND orders.bid = $bid";
  $custotal = $db->prepare($sql1);
  $custotal->execute();
        
      $db = null;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
    ?>
<div class="container">
    <table class="table caption-top table-sm table-display-products table-hover" id="myTable">
    
      <caption class="display-products-caption">
        <h3>Customers </h3>
        <span class="display-products-span-caption-p">
          <?php $cus = $custotal->fetch(PDO::FETCH_ASSOC); 
    if ($cus) {?>
          <p><?php echo $cus["total"]; }?> Customers Found</p>
        </span>
      </caption>
      <thead>
        <tr>
        <th>
        <input type="text" id="live_search" autocomplete="off" placeholder="Search Name ...">
        </th>
        </tr>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">User Name</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="showData">
      <!-- <tr id="SearchResult"></tr> -->
        <?php while ($details = $customers->fetch(PDO::FETCH_ASSOC)) {
          extract($details);
          ?>
        <tr id="noFilter">
          <th class="uid">
            <?php echo $uid ?>
          </th>
          <td>
            <?php echo $Fname." ".$Lname ?>
          </td>
          <td>
            <?php echo $username ?>
          </td>
          <td><a class="ShowMessageModal">
          <i class="fa-solid fa-message"></i>
            </a></td>

        </tr>
        <?php } ?>
        <!-- <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
          <td>@mdo</td>
          <td>@mdo</td>
          <td><a class="ShowProductsButton">
              <i class="fa-solid fa-square-caret-down"></i>
            </a></td>
          <td><a class="updateProductsButton">
              <i class="fa-solid fa-pen-to-square"></i>
            </a> </td>

        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
          <td>@mdo</td>
          <td>@mdo</td>
          <td><a class="ShowProductsButton">
              <i class="fa-solid fa-square-caret-down"></i>
            </a></td>
          <td><a class="updateProductsButton">
              <i class="fa-solid fa-pen-to-square"></i>
            </a> </td>
        </tr> -->
      </tbody>
      
    </table>
    </div>

    </div>
  </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="js/SearchByCustomerName.js"></script>
  <script src="js/messageModal.js"></script>






</body>

</html>