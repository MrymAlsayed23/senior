<?php
require("../connection.php");
try{
if (isset($_POST["sts"]) && isset($_POST["oid"])){

    $sts = $_POST["status"];
    $oid = $_POST["oid"];
    $sql = "UPDATE orders SET ostatus = '$sts' WHERE oid = $oid";
    $st = $db->exec($sql);
    if ($st>0){
        header("location: displayOrders.php");   
?>
 <script> alert ("The Order Status Updated Successfully"); </script>
<?php

    }
    $db = null;
}
}catch(PDOException $e){  
    die($e->getMessage());
} 

?>