<?php
require('../connection.php');

if (isset($_POST['click_show_btn'])) {
    $pid = $_POST['pid'];
    /*echo $pid;*/
    try {
        $sql = "SELECT * FROM products WHERE pid = '$pid'";
        $products = $db->query($sql);
        $db=null;
        while ($details = $products->fetch(PDO::FETCH_ASSOC)){
            extract ($details);
            echo "<h6> Product ID ".$pid."</h6>";
            echo "<h6> Product Name ".$pname."</h6>";
            echo "<h6> Brand Name ".$BrandName."</h6>";
            echo "<h6>Details ".$Details."</h6>";
        }
       }
       catch(PDOException $e) {
        die($e->getMessage());
       }


}


?>