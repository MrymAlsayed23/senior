<?php
require("../connection.php");
  if (isset($_POST["click_show_btn"])) {
    $uid = $_POST["uid"];
      $sql = "select * from users WHERE uid= $uid";
      $stmt = $db->prepare($sql);
      $stmt->execute();
      while ($r=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($r);
        echo "<h5 style=font-weight:bold;>Customer Email: </h5>";
        echo "<h6>".$r['email']."</h6>";
      }  
  }
?>