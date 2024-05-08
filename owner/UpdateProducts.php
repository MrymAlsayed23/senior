<?php
require('../connection.php');
if (isset($_POST["click_Update_btn"])) {

    $pid = $_POST["pid"];
    $arr = [];
    try {
       
        $sql1 = "SELECT * FROM products WHERE pid = '$pid'";
        $products = $db->query($sql1);
        header("Content-Type: application/json");
        $row = $products->fetchAll(PDO::FETCH_ASSOC); 
        foreach ($row as $r) {
            //extract($r);
             $r['sellPrice'] = (int)$r['sellPrice'];
             $r['pquantity'] = (int)$r['pquantity'];
             $arr[] =  $r;
             echo json_encode($arr);
         }
        //echo "F ds";
        // while ($row = $products->fetch(PDO::FETCH_ASSOC)) {
            
            // $row['sellPrice'] = (int)$row['sellPrice'];
            // $row['pquantity'] = (int)$row['pquantity'];
            //header("Content-Type: text/html");
            //header("Content-Type: text/html");
            


        //}
        $db = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

if (isset($_POST["updateProductsBut"])) {  
    $pid = $_POST["pid"];
    $name = $_POST["pname"];
    $details = $_POST["Details"];
    $price = $_POST["SellPrice"];
    $qty = $_POST["pqunatity"];
    $category = $_POST["category"];

    $sql = "UPDATE products SET pname = '$name', Details= '$details' ,
    SellPrice = '$price' , pquantity =  '$qty' ,  pType = '$category' WHERE pid = '$pid'";
    $r = $db->exec($sql);
    if ($r>0){
       // $_SESSION['status'] = 'Update Success';
        header("location: displayProducts.php");   
    }
    $db = null;


} 

// header("Content-Type: text/html");



?>