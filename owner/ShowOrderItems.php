<?php
require("../connection.php");
if (isset($_POST["click_show_btn"])) {
    $oid = $_POST["oid"];
    try {
        $sql = "SELECT order_items.pid, products.pname, products.sellPrice, products.image,
            order_items.quantity
            FROM order_items
            INNER JOIN products ON order_items.pid = products.pid
            INNER JOIN orders ON order_items.oid = orders.oid
            WHERE order_items.oid = $oid";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $sql2 = "SELECT * FROM orders WHERE oid = $oid";
        $status = $db->query($sql2);

?>
        <div class="container">
            <table class="table align-middle">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Item ID</th>
                        <th scope="col">Item Image</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Item Total Price</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    <?php
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                        <tr>
                            <th scope="row" class="text-center"><?php echo $result["pid"]; ?></th>
                            <td><?php //echo $result["image"]; 
                                ?></td>
                            <td><?php echo $result["pname"]; ?></td>
                            <td class="text-center"><?php echo $result["quantity"]; ?></td>
                            <td class="text-center" ><?php echo $result["quantity"] * $result["sellPrice"]; ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
                <tfoot>
                    <?php while ($s1 = $status->fetch(PDO::FETCH_ASSOC)) {
                        extract($s1);
                    ?>
                        <tr>
                            <th colspan="3">Total Price</th>
                            <td colspan="2"><?php echo $s1["total"] . " BHD"; ?></td>
                        </tr>
                        <form action="updateOrderStatus.php" method="POST">
                        <tr>
                            <th colspan="2">Order Status</th>

                            <td colspan="3">
                                <?php if ($s1["ostatus"] == "Completed") { ?>
                                    <select disabled class="form-select form-select-sm" aria-label="Small select example">
                                        <option selected value="<?php echo $s1["ostatus"]; ?>"><?php echo $s1["ostatus"]; ?></option>
                                    </select>
                                <?php } else { ?>
                                    
                                        <input hidden type="number" name="oid" value="<?php echo $s1["oid"]; ?>">
                                    <select class="form-select form-select-sm" aria-label="Small select example" name="status">
                                        <option selected value="<?php echo $s1["ostatus"]; ?>"><?php echo $s1["ostatus"]; ?></option>
                                        <?php if ($s1["ostatus"] == "Pending") { ?>
                                            <option value="Dispatch">Dispatch</option> <?php } ?>
                                        <?php if ($s1["ostatus"] == "Dispatch") { ?>
                                            <option value="Completed">Completed</option> <?php } ?>
                                    </select>
                                    </td>
                                    </tr>
        <tr style="text-align:right">
            <td></td><td></td>
        <!-- <td><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></td> -->
        <td colspan="3"><button type="button" class="btn btn-primary" name="updatestatus">Update Order Status</button></td>
        </form>
        </tr>
        
                <?php }
                            } ?>
                </tfoot>

            </table>
        </div>
        
<?php
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>

