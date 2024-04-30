<?php
    include '../connection.php';
    session_start();

    // if(isset($_SESSION['uid'])){
    //     $uid = $_SESSION['uid'];
    // }
    // else{
    //     $uid = '';
    // };
    include 'wishlist-cart.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>View</title>
    </head>
    <style>
        :root{
            --main-color:#60d1a7;
            --orange:#555555;
            --red:#60d1a7;
            --black:#333;
            --white:#fff;
            --light-color:#666;
            --light-bg:#eee;
            --border:.2rem solid var(--black);
            --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
        }

        *{
            font-family: 'Nunito', sans-serif;
            margin:0; padding:0;
            box-sizing: border-box;
            outline: none; border:none;
            text-decoration: none;
        }

        *::selection{
            background-color: var(--main-color);
            color:var(--white);
        }

        section{
            padding:2rem;
            max-width: 1200px;
            margin:0 auto;
        }

        .heading{
            font-size: 4rem;
            color:var(--black);
            margin-bottom: 2rem;
            text-align: center;
            text-transform: uppercase;
        }

        .btn,
        .delete-btn,
        .option-btn{
            display: block;
            width: 100%;
            margin-top: 1rem;
            border-radius: .5rem;
            padding:1rem 3rem;
            font-size: 1.7rem;
            text-transform: capitalize;
            color:var(--white);
            cursor: pointer;
            text-align: center;
        }

        .btn:hover,
        .delete-btn:hover,
        .option-btn:hover{
            background-color: var(--black);
        }

        .btn{
            background-color: var(--main-color);
        }

        .option-btn{
            background-color: var(--orange);
        }

        .delete-btn{
            background-color: var(--red);
        }

        .flex-btn{
            display: flex;
            gap:1rem;
        }

        .empty{
            padding:1.5rem;
            background-color: var(--white);
            border: var(--border);
            box-shadow: var(--box-shadow);
            text-align: center;
            color:var(--red);
            border-radius: .5rem;
            font-size: 2rem;
            text-transform: capitalize;
        }
        .view form{
            padding:2rem;
            border-radius: .5rem;
            border:var(--border);
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            margin-top: 1rem;
        }

        .view form .row{
            display: flex;
            align-items: center;
            gap:1.5rem;
            flex-wrap: wrap;
        }

        .view form .row .image-container{
            margin-bottom: 2rem;
            flex:1 1 40rem;
        }

        .view form .row .image-container img{
            height: 30rem;
            width: 100%;
            object-fit: contain;
        }

        .view form .row .image-container{
            display: flex;
            gap:1.5rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .view form .row .image-container img{
            height: 7rem;
            width: 10rem;
            object-fit: contain;
            padding:.5rem;
            border:var(--border);
            cursor: pointer;
            transition: .2s linear;
        }

        .view form .flex .image-container img:hover{
            transform: scale(1.1);
        }

        .view form img{
            width: 100%;
            height: 20rem;
            object-fit: contain;
            margin-bottom: 2rem;
        }

        .view form .row .content{
            flex:1 1 40rem;
        }

        .view form .row .content .pname{
            font-size: 2rem;
            color:var(--black);
        }

        .view form .row .flex{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap:1rem;
            margin:1rem 0;
        }

        .view form .row .flex .quantity{
            width: 7rem;
            padding:1rem;
            border:var(--border);
            font-size: 1.8rem;
            color:var(--black);
            border-radius: .5rem;
        }

        .view form .row .flex .sellPrice{
            font-size: 2rem;
            color:var(--red);
        }

        .view form .row .content .details{
            font-size: 1.6rem;
            color:var(--light-color);
            line-height: 2;
        }
    </style>
    <body>

        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>

        <section class="view">

            <h1 class="heading">View in Details</h1>

            <?php
                $pid = $_GET['pid'];
                $select_products = $db->prepare("SELECT * FROM `products` WHERE pid = ?");
                // $select_products->execute([$pid]);
                if($select_products->rowCount() > 0){
                while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="POST" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_product['pid']; ?>">
                <input type="hidden" name="pname" value="<?= $fetch_product['pname']; ?>">
                <input type="hidden" name="sellPrice" value="<?= $fetch_product['sellPrice']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
                <div class="row">
                    <div class="image-container">
                        <img src="<?= $fetch_product['image']; ?>" alt="">
                    </div>
                    <div class="content">
                        <div class="pname">
                            <?= $fetch_product['pname']; ?>
                        </div>
                        <div class="flex">
                            <div class="sellPrice">
                                <span>BD</span><?= $fetch_product['sellPrice']; ?><span></span>
                            </div>
                            <input type="number" name="quantity" class="quantity" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                        </div>
                        <div class="details">
                            <?= $fetch_product['details']; ?>
                        </div>
                        <div class="flex-btn">
                            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                            <input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist">
                        </div>
                    </div>
                </div>
            </form>

            <?php
                }
            }else{
                echo '<p class="empty">No Products Added Yet!</p>';
            }
            ?>

        </section>


        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
