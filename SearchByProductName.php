<?php
  require("../connection.php");
  try {

    if (isset($_POST["input"])) {
        $input = $_POST["input"];
        $sql = "SELECT * FROM PRODUCTS WHERE pname LIKE '$input%'";
        $r = $db->query($sql);
        while ($details = $r->fetch(PDO::FETCH_ASSOC)) {
          extract($details);

          ?>
          <tr>
          <th scope="row" class="pid">
            <?php echo $pid ?>
          </th>
          <td>
            <?php //echo $image ?>
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
       <?php }
        
}

catch (Exception $e) {
    die($e->getMessage());
  }
?>



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
<script src="js/updateProduct.js"></script>
<script src="js/ShowProductsButton.js"></script>
<script src="deleteProduct.js"></script>