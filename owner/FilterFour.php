<?php
try {
require ('../connection.php');
if (isset($_POST["com_btn"])) {

    $sql = "SELECT * FROM orders WHERE ostatus = 'Completed'";
    $orders = $db->query($sql);
    while ($details = $orders->fetch()) {
        extract($details);
        ?>
        <tr>
    <div class="container mt-5">
      <th scope="row"><?php echo $details["oid"]; ?></th>
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
    <td><button class="ShowProductsButton"
      data-bs-toggle="modal" data-bs-target="#staticBackdropShow">
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
}


catch (PDOException $e) {
    die($e->getMessage());
  }

?>