<?php
session_start();
if (isset($_GET['cid'])) {
    $cid = htmlspecialchars($_GET['cid']); // Sanitizing the input for safe output
    echo $cid;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Payment</title>
</head>
<body>
    <!-- nav -->
    <?php include ("../customer/customerNavBar.php"); ?>


    <!-- modified -->
    <div class="container" style="margin-bottom:17.5rem; margin-top:14rem">
        <?php
        if (!isset($_GET['btn'])) {
            ?>
            <div class="">
                <h2>Payment Method</h2>
            </div>

            <form method="GET">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                        value="Debit/Credit Card" checked>
                    <label class="form-check-label" for="flexRadioDefault1">Debit/Credit Card</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                        value="Cash">
                    <label class="form-check-label" for="flexRadioDefault2">Cash</label>
                </div>
                <input class="btn btn-primary" type="submit" name="btn" value="Confirm">
                <input type="hidden" name="cid" value="<?php echo $cid; ?>"> <!-- Maintain the cart ID through the transaction -->
            </form>
            <?php
        } elseif (isset($_GET['btn'])) {
            $method = $_GET['flexRadioDefault'];
            require ('../connection.php');

            try {
                // Use prepared statement to prevent SQL injection
                $stmt = $db->prepare("SELECT * FROM cart WHERE cid = ?");
                $stmt->execute([$cid]); // Safe parameter binding
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($method == 'Debit/Credit Card') {
                    ?>
                    <form action="completePayment.php" method="GET">
                        <input type="hidden" name="amount" value="<?php echo $rows['total']; ?>">
                        <input type="hidden" name="cid" value="<?php echo $rows['cid']; ?>">
                        <!-- Additional form fields for card details would go here -->
                        <input type="submit" class="btn btn-primary" value="Proceed to Payment">
                    </form>
                    <?php
                } else {
                    // Similar handling for cash payment
                }
            } catch (PDOException $e) {
                die("Error occurred:" . $e->getMessage());
            }
        }
        ?>
    </div>
    <!-- footer -->
    <?php include ("../customer/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>
