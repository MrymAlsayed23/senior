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
            $imageData = base64_encode($image);
            $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            echo "<h5 style=font-weight:bold;>".$pname."</h5>";
            echo "<img src=".$imageSrc." style=width:30%;height:30%;>";
            // echo "<h6> Product ID ".$pid."</h6>";
            // echo "<h6> Brand Name ".$BrandName."</h6>";
            echo "<p style=font-weight:300;margin-top:0.5rem;>".$Details."</p>";
        }
       }
       catch(PDOException $e) {
        die($e->getMessage());
       }


}



?>