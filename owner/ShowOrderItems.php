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
        <form action="ShowOrderItems.php" method="post" id="stsForm">
            <table class="table align-middle">
                
                <thead>
                    <tr class="text-center">
                        <th scope="col">Item ID</th>
                        <th scope="col"></th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Item Total Price</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    <?php
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $imageData = base64_encode($result['image']);
                        $imageSrc = 'data:image/jpeg;base64,' . $imageData;
                    ?>

                        <tr style="border-bottom:transparent;">
                            <th scope="row" class="text-center"><?php echo $result["pid"]; ?></th>
                            <td></td>
                            <td class="text-center"><?php echo $result["pname"]; ?></td>
                            <td class="text-center"><?php echo $result["quantity"]; ?></td>
                            <td class="text-center"><?php echo $result["quantity"] * $result["sellPrice"]; ?></td>
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

                        <tr>
                            <th colspan="2" style="border-bottom:transparent;">Order Status</th>

                            <td style="border-bottom:transparent;">
                                <?php if ($s1["ostatus"] == "Completed") { ?>
                                    <select disabled class="form-select form-select-sm" aria-label="Small select example">
                                        <option selected value="<?php echo $s1["ostatus"]; ?>"><?php echo $s1["ostatus"]; ?></option>
                                    </select>
                                <?php } else { ?>

                                    <input hidden type="number" name="oid" value="<?php echo $s1["oid"]; ?>" form="stsForm">
                                    <select class="form-select form-select-sm" aria-label="Small select example" name="status" form="stsForm">
                                        <option selected value="<?php echo $s1["ostatus"]; ?>"><?php echo $s1["ostatus"]; ?></option>
                                        <?php if ($s1["ostatus"] == "Pending") { ?>
                                            <option value="Dispatch">Dispatch</option> <?php } ?>
                                        <?php if ($s1["ostatus"] == "Dispatch") { ?>
                                            <option value="Completed">Completed</option> <?php } ?>
                                    </select>
                            </td>
                            <td colspan="3" style="border-bottom:transparent;"><button type="submit" class="btn btn-secondary" name="updatestatus" form="stsForm">Update Order Status</button>

                            </td>
                        </tr>
                        <!-- <tr style="text-align:right;"> -->
                        <!-- <td style="border-bottom:transparent;"></td><td style="border-bottom:transparent;"></td> -->
                        <!-- <td><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></td> -->

                        <!-- </tr> -->
                <?php }
                            } ?>
                </tfoot>
            </table>
            </form>
        </div>

<?php
  } catch (PDOException $e) {
    die($e->getMessage());
}
}
require("../connection.php");
if (isset($_POST["updatestatus"])){

    $sts = $_POST["status"];
    $oid = $_POST["oid"];
    $sql = "UPDATE orders SET ostatus = '$sts' WHERE oid = $oid";
    $st = $db->exec($sql);
    if ($st>0){
        header("location: displayOrders.php");   

    }
    $db = null;
}
?>