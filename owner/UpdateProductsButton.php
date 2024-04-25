<?php

if (isset($_POST["click_Update_btn"])) {  

    $pid = $_POST["pid"];
    $arr = [];
    try {
        $sql = "SELECT * FROM products WHERE pid = '$pid'";
        $products = $db->query($sql);
        $db=null;
        while ($details = $products->fetch(PDO::FETCH_ASSOC)){
            extract ($details);
            array_push($arr, $details);
            header("content-type: application/json");
            echo json_encode($arr);
            
        }
       }
       catch(PDOException $e) {
        die($e->getMessage());
       }



 }





?>