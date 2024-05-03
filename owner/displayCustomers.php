<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="owner.css">

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










 
<div class="container">
  <div class="container mt-5">
    <div class="container">

    <?php
    try {
      require ('../connection.php');
      $sql = "SELECT * FROM users WHERE type='Customer'";
      $customers = $db->query($sql);
      $sql1 = "SELECT COUNT(*) AS total FROM users WHERE type='Customer'";
  $custotal = $db->prepare($sql1);
  $custotal->execute();
        
      $db = null;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
    ?>
    <div class="containr">
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
          <!-- <th><a href="product.php">Add New Products</a></th> -->
        </tr>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">User Name</th>
          <th scope="col"></th>
        </tr>
        <tr>
          <th></th>
          <th>
          <input type="text" id="live_search" autocomplete="off" placeholder="Search Name ...">
          </th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody id="showData">
      <!-- <tr id="SearchResult"></tr> -->
        <?php while ($details = $customers->fetch(PDO::FETCH_ASSOC)) {
          extract($details);
          ?>
        <tr id="noFilter">
          <th scope="row" class="uid">
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