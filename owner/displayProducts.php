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
  <title>Products</title>
  <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="o.css">

<body>
 <!-----updateProductsModal------->


 <div class="modal fade" id="update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id=update">Update Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="UpdateProducts.php" method="post">
          <div class="modal-body">
            <div class="mb-3">
              <input type="hidden" class="form-control" id="mpid" name="pid">
              <input type="hidden" class="form-control" id="mbid" name="bid" value="<?php echo $bid;?>">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="mname" name="pname" value="" placeholder="">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Details</label>
              <textarea class="form-control" id="mdetails" name="Details" rows="2"></textarea>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Sell Price</label>
              <input type="number" min="" class="form-control" id="mprice" name="SellPrice" placeholder="">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Quantity</label>
              <input type="number" class="form-control" id="mqunatity" name="pqunatity" placeholder="">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Category</label>
              <input type="text" class="form-control" id="mcategory" name="category" placeholder="">
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="updateProductsBut" class="btn" style="background-color: #cc7fa9;"
            >Apply Changes</button>
          </div>
          </form>
      </div>
      

    </div>

  </div>
  

  <div class="modal fade" id="staticBackdropShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropShowLabel">More Details ..</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="showProducts">

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!--<button type="button" class="btn btn-primary">Understood</button>-->
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deletLabel">Delete a Product</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="showMsg">

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
              <a href="displayProducts.php?bid=<?php echo $bid;?>" class="sidebar-link">
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
              <a href="displayCustomers.php?bid=<?php echo $bid?>" class="sidebar-link">
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

<div class="container-fluid">
  <div class="container mt-5">
    <div class="container">

    <?php
    try {
      require ('../connection.php');
      $sql = "SELECT * FROM products WHERE bid='$bid'";
      $products = $db->query($sql);
      $sqlcat = "SELECT distinct pType FROM products WHERE bid='$bid' order by pType";
      $cat = $db->query($sqlcat);
      $sql1 = "SELECT COUNT(*) AS total FROM products WHERE bid='$bid'";
  $pro1 = $db->prepare($sql1);
  $pro1->execute();
        
      $db = null;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
    ?>
    <div class="container">
    <table class="table caption-top table-sm table-display-products table-hover" id="myTable">
      <caption class="display-products-caption">
        <h3>Products </h3>
        <span class="display-products-span-caption-p">
          <?php $pro = $pro1->fetch(PDO::FETCH_ASSOC); 
    if ($pro) {?>
          <p><?php echo $pro["total"]; }?> Products Found</p>
        </span>
      </caption>
      <thead>
        <tr>
          <th><a href="product.php?bid=<?php echo $bid?>">Add New Products</a></th>
        </tr>
        <tr>
          <th scope="col">ID</th>
          <th scope="col"></th>
          <th scope="col">Name</th>
          <th scope="col">Category</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
          <th scope="col"></th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
        <tr>
          <th></th>
          <th></th>
          <th>
            <input type="text" id="live_search" autocomplete="off" placeholder="Search Name ...">
          </th>
          <th>
            <select class="form-select form-select-sm" aria-label="Small select example" id="FilterByCategory">
              <option selected value="">Select Category ..</option> 
              <?php 
               while ($det = $cat->fetch(PDO::FETCH_ASSOC)) {
                extract($det);      
              ?>
              <option value="<?php echo $pType?>"><?php echo $pType?></option>
            <?php }?>
            </select>
          </th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody id="showData">
      <!-- <tr id="SearchResult"></tr> -->
        <?php while ($details = $products->fetch(PDO::FETCH_ASSOC)) {
          extract($details);
          ?>
        <tr id="noFilter">
          <th scope="row" class="pid">
            <!-- It's always better to save record Ids in a hidden input or in hidden object that's
            invisible from user. because HTML and JavaScript are not immutable -->
          <input type="hidden" id="pid<?php echo $pid?>" value="<?php echo $pid?>" />
            <?php echo $pid ?>
          </th>
          <td>
            <!-- <img src="../<?php //echo $image?>" alt="<?php //echo $pname?> Image" 
            class="img-responsive img-thumbnail" width="150"> -->
            <?php // echo $image ?>
          </td>
          <td>
            <?php echo $pname ?>
          </td>
          <td>
            <?php echo $pType ?>
          </td>
          <td>
            <?php echo $sellPrice ?>
          </td>
          <td>
            <?php echo $pquantity ?>
          </td>
          <td><a class="ShowProductsButton">
              <i class="fa-solid fa-square-caret-down"></i>
            </a></td>
          <td><a class="updateProductsButton">
              <i class="fa-solid fa-pen-to-square"></i>
            </a> </td>
            <td><a class="DeleteProductButton">
            <i class="fa-solid fa-trash-can mb-1"></i>
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
  <script src="js/ShowProductsButton.js"></script>
  <script src="js/updateProduct.js"></script>
  <script src="js/SearchByProductName.js"></script>
  <script src="js/FilterByCategory.js"></script>
  <script src="deleteProduct.js"></script>







</body>

</html>