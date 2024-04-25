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
    

  <div class="modal fade" id="staticBackdropShow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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



    <!-----updateProductsModal------->


<div class="modal fade" id="staticBackdropUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropUpdateLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="UpdateProductsButton.php" method="post">
      <div class="modal-body">
      <div class="mb-3">
  <label for="" class="form-label">Product Name</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
</div>
<div class="mb-3">
  <label for="" class="form-label">Brand Name</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
</div>
<div class="mb-3">
  <label for="" class="form-label">Details</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
</div>
<div class="mb-3">
  <label for="" class="form-label">Sell Price</label>
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
</div>
<div class="mb-3">
  <label for="" class="form-label">Quantity</label>
  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
</div>
<div class="mb-3">
  <label for="" class="form-label">Category</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
</div>
         
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="updateProsuctsBut" class="btn btn-primary">Apply Changes</button>
      </div>
    </div>
    </form>

    </div>

</div>




<div class="container">


<?php
 try {
  require('../connection.php');
  $sql = "SELECT * FROM products";
  $products = $db->query($sql);
  $db=null;
 }
 catch(PDOException $e) {
  die($e->getMessage());
 }
?>
  <table class="table caption-top table-sm table-display-products table-hover">
  <caption class="display-products-caption"><h3>Products </h3>
  <span class="display-products-span-caption-p">
    <p>100 Products Found</p></span>
</caption>
  <thead>
    <tr>
    <th><a href="">Add New Products</a></th>
    </tr>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Price <button class="orderingButton"><i class="fa-solid fa-up-down"></i></button></th>
      <th scope="col">Quantity <button class="orderingButton"><i class="fa-solid fa-up-down"></i></button></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
    <tr>
        <th></th><th></th>
        <th>
            <input type="text" id="live_search" autocomplete="off" placeholder="Search Name ...">
        </th>
        <th>
        <select class="form-select form-select-sm" aria-label="Small select example">
  <option selected>Select Category ..</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
        </th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
  </thead>
  <tbody>
    <?php while ($details = $products->fetch(PDO::FETCH_ASSOC)){
      extract ($details); 

     ?>
    <tr>
      <th scope="row" class="pid"><?php echo $pid?></th>
      <td> <?php echo $image?>  </td>
      <td><?php echo $pname?></td>
      <td><?php echo $category?></td>
      <td><?php echo $sellPrice?></td>
      <td><?php echo $pquantity?></td>
      <td><a class="ShowProductsButton">
      <i class="fa-solid fa-square-caret-down"></i>
    </a></td>
    <td><a class="updateProductsButton">
      <i class="fa-solid fa-pen-to-square"></i>
    </a</td>

    </tr>
<?php }?>
    <tr>
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
    </a</td>

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
    </a</td>
    </tr>
  </tbody>
</table>





    


    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   
    <script src="ShowProductsButton.js"></script>
    <script src="updateProductsButton.js"></script>
  </body>
</html>