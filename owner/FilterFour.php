<?php
try {
require ('../connection.php');
if (isset($_POST["com_btn"])) {
  $bid = $_POST["bid"];
    $sql = "SELECT * FROM orders WHERE ostatus = 'Completed'";
    $orders = $db->query($sql);
    while ($details = $orders->fetch()) {
        extract($details);
        $poid = $details['oid'];
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
      <td><?php 
         $query = "SELECT * FROM payment WHERE oid= $poid";
         $stmt = $db->prepare($query);
         $stmt->execute();
         if ($stmt > 0 ){
          echo "Card";
         }
         else {
          echo "Cash";
         }
      ?>
      </td>
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
<script src="js/FilterOrdersByStatus.js"></script>
    <script src="js/FilterOrdersByDate.js"></script>
    <script src="js/ShowOrderItems.js"></script>