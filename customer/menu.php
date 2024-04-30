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


        <a href="cart.php">Go to cart</a>
        <div class="card-container">

            
            <?php
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
                <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="..."> <!-- Product Image -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo $pname; ?></h5> <!-- Product Name -->
                    <p class="card-text"><?php echo $Details; ?>.</p><!-- Product Details -->
                    <h6><?php echo $sellPrice." BD"; ?></h6>
                    <form method="POST">
                        <input type="number" name="pquantity" id="" min="0" max="100">
                        <input type="hidden" name="pid" id="" value='<?php echo $pid; ?>' />
                        <button class="btn btn-primary" name="add" onclick="addToCart(<?php echo $productID; ?>)">Add to Cart</button>                    </form>
                </div>
            </div>

            <?php
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>

        <!-- <?php
            // date_default_timezone_set("Asia/Bahrain");
            // try{
            //   require("../connection.php");
            //   if(isset($_POST['add']))
            //   {
            //     extract($_POST);
            //     if (!isset($_SESSION['username'])) {
            //       echo"You cannot order without logging in! <br/>";
            //       echo"<a href='login.php'>Login Now</a>";
            //     }
            //     else{
            //       $data=$db->query("select pid from products where pname ='$pname'")->fetchAll();
            //       foreach($data as $row)
            //       {
            //         $id=$row[0];
            //       }
            //       if (isset($_COOKIE['cart'])){
            //         $previousdetails=(array)json_decode($_COOKIE['cart'],true);
            //         foreach($previousdetails as $details){
            //           $cookievalue[]=$details;
            //         }
            //       }
            //         $details['pid']=$id;
            //         $cookievalue[]=$details;
            //         setcookie("cart", json_encode($cookievalue), time()+(86400*7));
            //         echo"<br/>";
            //         echo'Successfully added to cart';
            //       }
            //       $db=null;
            //     }
            //   }
            // catch(PDOException $e){
            //     echo "Failed";
            // }
        ?> -->


</div>

    <script>
        function addToCart(pid) {
            // Send an AJAX request to add the item to the cart
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Successfully added to cart");
                }
            };
            xhr.open("POST", "cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("pid=" + pid);
        }
        </script>

        <!-- footer  -->
        <?php include("../customer/footer.php"); ?>
       
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>