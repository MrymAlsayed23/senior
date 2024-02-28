<?php
// ob_start();
// session_start();
// date_default_timezone_set("Asia/Bahrain");
// if (!isset($_SESSION['username'])) {
// header("Location:login.php");
// exit(0);
// }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cart</title>
    </head>
    <body>

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
                $cookieValue=NULL;
                $previousdetails=(array)json_decode($_COOKIE['cart'],true);
                if(count($previousdetails)==1)
                {
                setcookie("Cart", json_encode($cookieValue), time()+(86400*7));
                }
                else{
                foreach($previousdetails as $details){
                    if($c==$removeitem)
                    {
                    $c++;
                    }
                    else{
                    $cookieValue[]=$details;
                    $c++;
                    }
                }
                if($cookieValue)
                    setcookie("Cart", json_encode($cookieValue), time()+(86400*7));
                }
                header('location:cart.php');
            }

        try{
        require("connection.php");
        if (isset($_COOKIE['cart'])) {
            $count=1;
            $total=0;
            $cookiedetails =(array)json_decode($_COOKIE['cart'],true);
            foreach($cookiedetails as $detail => $info) {
            $mealid=$cookiedetails[$detail]['pid'];
            $rsp=$db->query("select * from products where pid ='$pid'")->fetchAll();
            foreach($rsp as $row)
            {
                echo"<table border='1' align='center' width='300'>";
                {
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
            }
        }
        if($total!=0){
        $total = number_format($total, 2);
        echo"<br />Total Price: ".$total." BD.";
        ?>
        <form method=POST action='orders.php'>
            <input type='submit' id='orders' name='orders' value="Orders"/>
        </form>
        <?php
        }
        
        echo"<br /><a href='products.php'>Go back to products page.</a>";
        }
        else{
            echo"No Item in your cart.<br/>";
            }
        }
        catch(PDOException $e){
            echo "Failed";
        }
        ob_end_flush();
        ?>
        </div>
    </body>
</html>