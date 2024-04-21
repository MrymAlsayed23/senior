<?php
    ob_start();
    session_start();
    date_default_timezone_set("Asia/Bahrain");
    if (!isset($_SESSION['username'])) {
    header("Location:../login.php");
    exit(0);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>shopping cart</title>
    </head>
    <body>

        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>
        
        <div class="container" style="text-align:center;">
        <div class="payment-bill">
            <?php
                echo"<h1 align='center'>Cart</h1>";
                echo"<html>";
                echo"<body>";
                date_default_timezone_set("Asia/Bahrain");

                if(isset($_POST['remove'])){
                    extract($_POST);
                    $c=1;
                    $cookievalue=NULL;
                    $previousdetails=(array)json_decode($_COOKIE['cart'],true);
                    if(count($previousdetails)==1){
                        setcookie("cart", json_encode($cookievalue), time()+(86400*7));
                    }
                    else{
                    foreach($previousdetails as $details){
                        if($c==$removeitem){
                            $c++;
                        }
                        else{
                            $cookievalue[]=$details;
                            $c++;
                        }
                    }
                    if($cookievalue)
                        setcookie("cart", json_encode($cookievalue), time()+(86400*7));
                    }
                    header('location:cart.php');
                }

                try{
                require("../connection.php");
                if (isset($_COOKIE['cart'])) {
                    $count=1;
                    $total=0;
                    $delivery=0.5;
                    $cookiedetails =(array)json_decode($_COOKIE['cart'],true);
                    foreach($cookiedetails as $detail => $info) {
                    $pid=$cookiedetails[$detail]['pid'];
                    $rsp=$db->query("select * from products where pid ='$pid'")->fetchAll();
                    foreach($rsp as $row){
                        echo"<table border='1' align='center' width='300'>";{
                            echo"<tr>";
                            echo "<td><img src=mealpics/".$row[4]." height='300' width='300'></td>";
                            echo "</tr>";
                            echo"<tr>";
                            echo "<td align='center'>".$row[1]."</td>";
                            echo "</tr>";
                            echo"<tr>";
                            echo "<td align='center'>".$row[3]."BD</td>";
                            echo "</tr>";
                            echo"<tr>";
                        ?>
                        <form method=POST>
                            <td text-align='center'>
                            <input type='hidden' name='removeitem' value="<?php echo $count; ?>"/>
                            <input type='submit' id='remove' name='remove' value="Remove"/></td>
                        </form>
                        <?php
                        echo"</tr>";
                        $total=$total+$row[3];
                    }
                    $count++;
                    echo'</table>';
                }//end table tag
            } //end foreach loop
                
                if($total!=0){
                    echo"Delivery Charges: ".$delivery;
                    $total=$total+$delivery;
                    $total = number_format($total, 2);
                    echo"<br />Total Price: ".$total." BD";
                ?>
                <form method=POST action='order.php'>
                    <input type='submit' id='order' name='order' value="Order"/>
                </form>

                <?php
                }
                echo"<br /><a href='menu.php'>Go back to menu</a>";
                }
                else{
                    echo"There's currently nothing in your cart.<br/>";
                    echo"<a href='menu.php'>Start Ordering Now!</a>";
                    }
                }//end try 
            catch(PDOException $e){
                echo "Failed";
            }   
            ob_end_flush();
            ?>
        </div>

         <!-- footer  -->
         <?php include("../customer/footer.php"); ?>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
