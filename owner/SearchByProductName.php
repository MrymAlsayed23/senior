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
            <?php echo $image ?>
          </td>
          <td>
            <?php echo $pname ?>
          </td>
          <td>
            <?php echo $category ?>
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