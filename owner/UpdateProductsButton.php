<?php
require('../connection.php');
if (isset($_POST["click_Update_btn"])) {

    $pid = $_POST["pid"];
    $arr = [];
    try {
        $sql = "SELECT * FROM products WHERE pid = '$pid'";
        $products = $db->query($sql);
        $db = null;
        while ($details = $products->fetch(PDO::FETCH_ASSOC)) {
            extract($details);
            array_push($arr, $details);
            header("content-type: application/json");
            echo json_encode($arr);

        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }



}

if (isset($_POST["updateProsuctsBut"])) {  
    $pid = $_POST["pid"];
    $name = $_POST["pname"];
    $bname = $_POST["BrandName"];
    $details = $_POST["Details"];
    $price = $_POST["SellPrice"];
    $qty = $_POST["pqunatity"];
    $category = $_POST["category"];

    $sql = "UPDATE products SET pname = '$name', BrandName = '$bname' , Details= '$details' ,
    SellPrice = $price , pquantity =  $qty , category = '$category' WHERE pid = $pid";
    $r = $db->exec($sql);
    if ($r>0){
       // $_SESSION['status'] = 'Update Success';
        header("location: displayProducts.php");   
    }
    $db = null;


} 





?>