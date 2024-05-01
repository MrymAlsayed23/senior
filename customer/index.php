<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Menu</title>
    </head>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            flex: 0 0 18rem;
            margin: 10px;
        }
    </style>
    <body>
        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>

        <div class="card-container">

            <?php
            date_default_timezone_set("Asia/Bahrain");
            try {
                require('../connection.php');
                $sql = "SELECT * FROM products";
                $stmt = $db->query($sql); 
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $row) {
                    extract($row);
                    $imageData = base64_encode($image);
                    $imageSrc = 'data:image/jpeg;base64,' . $imageData;
            ?>
            <div class="card" style="width: 18rem;">
                <a class="" name="add_to_wishlist">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                    </svg>
                </a>
                <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="..."> <!-- Product Image -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo $pname; ?></h5> <!-- Product Name -->
                    <p class="card-text"><?php echo $Details; ?>.</p><!-- Product Details -->
                    <h6><?php echo $sellPrice." BD"; ?></h6>

                    <form method="POST" action="addToCart.php">
                        <input type="number"  name="productqty" min="0" max="100">
                        <input type="hidden" name="productid" id="" value='<?php echo $pid; ?>' />
                        <button class="btn btn-primary" name="add" onclick="addToCart()">Add to Cart</button>                    
                    </form>

                </div>
            </div>

            <?php
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
</div>
    <script>
        function addToCart() {
            alert("Successfully added to cart");
        }
        </script>

        <!-- footer  -->
        <?php include("../customer/footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
