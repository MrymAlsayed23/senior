<?php

if (isset($_POST["click_delete_btn"])) {

    $pid = $_POST["pid"]; 
    $bid = $_POST["bid"];
    echo "<h6 class='text-center' style='font-weight:bold;'>Are You Sure that You Want to Delete the Product with ?</h6>";  
?>
<form action="deleteProductsButton.php" method="post">
<input type="text" hidden name="pid" value="<?php echo $pid;?>">
<input type="text" hidden name="bid" value="<?php echo $bid;?>">
<button type="submit" class="btn btn-danger" name="deleting" style="margin-left:200px;margin-top:10px;">
Delete</button>
</form>
<?php }?>
<?php 
require("../connection.php");
 if (isset($_POST["deleting"])) {
    $pid = $_POST["pid"];
    $bid = $_POST["bid"];
    try{
        $stmt = $db->prepare("DELETE FROM products WHERE pid=$pid");
        $stmt->execute();
        if ($stmt->rowCount() > 0){
            header('Location: displayProducts.php?bid='.$bid);
        }
    }
    catch(Exception $e){
        die($e->getMessage());
    }
 }
?>
