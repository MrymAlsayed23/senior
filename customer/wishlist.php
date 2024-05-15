<?php
    include '../connection.php';
    session_start();
    $bid = $_GET['bid']; 
    if(isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
    }
    else{
        $uid = '';
        header('location:login.php');
    };

    include 'wishlist-cart.php';

    if(isset($_POST['delete'])){
        $wishlist_id = $_POST['wishlist_id'];
        $delete_wishlist_item = $db->prepare("DELETE FROM `wish_list` WHERE id = ?");
        $delete_wishlist_item->execute([$wishlist_id]);
    }

    if(isset($_GET['delete_all'])){
        $delete_wishlist_item = $db->prepare("DELETE FROM `wish_list` WHERE uid = ?");
        $delete_wishlist_item->execute([$uid]);
        header('location:wishlist.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>wishlist</title>
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
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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
            font-size: 3rem;
            color:var(--black);
            margin-bottom: 2rem;
            text-align: center;
        }

        .btn,
        .delete-btn,
        .option-btn{
            display: block;
            width: 100%;
            margin-top: 1rem;
            border-radius: .5rem;
            padding:1rem 3rem;
            font-size: 1.3rem;
            text-decoration: none;
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
            font-size: 1.5rem;
        }

        .disabled{
            pointer-events: none;
            user-select: none;
            opacity: .5;
        }

        
        .products .box-container{
            display: grid;
            grid-template-columns: repeat(auto-fit, 33rem);
            gap:1.5rem;
            justify-content: center;
            align-items: flex-start;
        }

        .products .box-container .box{
            position: relative;
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            border-radius: .5rem;
            border:var(--border);
            padding:2rem;
            overflow: hidden;
        }

        .products .box-container .box img{
            height: 20rem;
            width: 100%;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .products .box-container .box .fa-heart,
        .products .box-container .box .fa-eye{
            position: absolute;
            top:1rem;
            height: 4.5rem;
            width: 4.5rem;
            line-height: 4.2rem;
            font-size: 2rem;
            background-color: var(--white);
            border:var(--border);
            border-radius: .5rem;
            text-align: center;
            color:var(--black);
            cursor: pointer;
            transition: .2s linear;
        }


        .products .box-container .box .pname{
            font-size: 2rem;
            color:var(--black);
        }

        .products .box-container .box .flex{
            display: flex;
            align-items: center;
            gap:1rem;
        }

        .products .box-container .box .flex .quantity{
            width: 7rem;
            padding:1rem;
            border:var(--border);
            font-size: 1.8rem;
            color:var(--black);
            border-radius: .5rem;
        }

        .products .box-container .box .flex .sellPrice{
            font-size: 2rem;
            color:var(--red);
            margin-right: auto;
        }

        
        .wishlist-total{
            max-width: 50rem;
            margin:0 auto;
            margin-top: 3rem;
            background-color: var(--white);
            border:var(--border);
            border-radius: .5rem;;
            padding:2rem;
            text-align: center;
        }

        .wishlist-total p{
            font-size: 2.5rem;
            color:var(--black);
            margin-bottom: 2rem;
        }

        .wishlist-total p span{
            color:var(--red);
        }
    </style>
    <body>

        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>
        
        <section class="products">
            <h3 class="heading">Your Wishlist</h3>
            <div class="box-container">

                <?php
                    $grand_total = 0;
                    $select_wishlist = $db->prepare("SELECT * FROM `wish_list` WHERE uid = ?");
                    // $select_wishlist->execute([$uid]);
                    if($select_wishlist->rowCount() > 0){
                        while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
                            $grand_total += $fetch_wishlist['sellPrice'];
                ?>

                <form action="" method="post" class="box">
                    <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
                    <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                    <input type="hidden" name="pname" value="<?= $fetch_wishlist['pname']; ?>">
                    <input type="hidden" name="sellPrice" value="<?= $fetch_wishlist['sellPrice']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">
                    <a href="view.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
                    <img src="<?= $fetch_wishlist['image']; ?>" alt="">
                    <div class="pname"><?= $fetch_wishlist['pname']; ?></div>
                        <div class="flex">
                            <div class="sellPrice"> BD<?= $fetch_wishlist['sellPrice']; ?></div>
                                <input type="number" name="quantity" class="quantity" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                            </div>
                            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                            <input type="submit" value="delete item" onclick="return confirm('delete this from wish_list?');" class="delete-btn" name="delete">
                    </form>

                <?php
                    }
                }else{
                    echo '<p class="empty">Your Wishlist is Empty</p>';
                }
                ?>
            </div>

            <div class="wishlist-total">
                <p>Grand total : <span>BD<?= $grand_total; ?></span></p>
                <a href="menu.php" class="option-btn">continue shopping</a>
                <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from wish_list?');">delete all item</a>
            </div>

        </section>


        <!-- footer  -->
        <?php include("../customer/footer.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
