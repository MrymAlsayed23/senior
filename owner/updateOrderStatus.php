<?php
require("../connection.php");
if (isset($_POST["updatestatus"])){

    $sts = $_POST["status"];
    $oid = $_POST["oid"];
    
    $sql = "UPDATE orders SET ostatus = '$sts' WHERE oid = $oid";
    $st = $db->prepare($sql);
    $st->execute();
    if ($st>0){
?>
 <script> alert ("The Order Status Updated Successfully"); </script>
<?php

    }
}

?>