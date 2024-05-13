<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign Up As Owner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="multiform.css">
  <link rel="stylesheet" href="../home/css/home.css">
</head>
<body>

<header class="header">
    <div class="headercontainer">
        <div class="row align-items-center justify-content-between">
            <div class="logo">
               <a href="#"><img src="../home/logo/logo.png" alt="Logo"></a>
            </div>
            <button type="button" class="nav-toggler">
               <span></span>
            </button>
            <nav class="nav">
               <ul>
                  <li><a href="../home/home.php">home</a></li>
                  <li><a href="#">Company</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Contact</a></li>
                  <li><a href="../owner/ownerlogin.php" class="active">Login</a></li>
               </ul>
            </nav>
        </div>
    </div>
 </header>


<div id="page" class="site">
    <div class="container">
        <div class="form-box">
            <div class="progress">
                <div class="logo"><a href=""><span>Automated</span> Business</a></div>
                <ul class="progress-steps">
                    <li class="step active">
                        <span>1</span>
                        <p>Sign Up<br><span style="display:flex;">Owner</span></p>
                    </li>
                    <li class="step">
                        <span>2</span>
                        <p>Select Category<br><span></span></p>
                    </li>
                    <li class="step">
                        <span>3</span>
                        <p>Business Details<br><span>Welcome!</span></p>
                    </li>
                    <li class="step">
                        <span>4</span>
                        <p>Add Products<br><span>Get In!</span></p>
                    </li>
                </ul>
            </div>
            <form method="post" id="myForm">
                <div class="form-one form-step active">
                    <div class="bg-svg"></div>
                    <h2>Personal Information</h2>
                    <p>Make Sure to Enter Your Personal Information Correctly</p>
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" required>
                    </div>
                    <div>
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" required>
                    </div>
                    <div>
                        <label for="username">User Name</label>
                        <input type="text" name="username" required>
                    </div>
                    <div>
                        <label for="ps">Password</label>
                        <input type="password" name="ps" required>
                    </div>
                    <div>
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>
                    </div>
                    <div class="form-two form-step">
                    <div class="bg-svg"></div>
                    <h2>Select Your Category</h2>
                    <!-- <p>Make Sure to Enter Your Personal Information Correctly</p> -->
                    <div>
                        <label for="bcat">Category</label>
                        <select name="bcat" id="" placeholder="Select .." required >
                            <option value="Book">Book</option>
                             <option value="Accessories">Accessories</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-three form-step">
                      <div class="bg-svg"></div>
                      <h2>Your Business Information</h2>  
                    <div>
                        <label for="bname">Your Business Name</label>
                        <input type="text" name="bname" required >
                    </div>
                    <!-- <div>
                        <label for="">Your Business Category</label>
                        <input type="text" disabled value="bcat">
                    </div> -->
                    <div>
                        <label for="det">More Details About Your Business</label>
                        <input type="text" name="det" required >
                    </div>
                    </div>
                    <div class="form-four form-step">
                    <div class="bg-svg"></div>
                      <h2>Add Your Products</h2>  
                      <p>You can start your business with one product only, but
                        its quantity should not be less than 10 units.
                      </p>
                    <div>
                    <label for="pname">Product Name</label>
                    <input type="text" name="pname" required >
                    </div>
                    <div>
                    <label for="pquantity">Quantity</label>
                    <input type="number" name="pquantity" min=10 required >
                    </div>
                    <div>
                    <label for="Details">Details</label>
                    <textarea name="Details" id="" cols="30" rows="5" placeholder="Details" required></textarea>
                    </div>
                    <div>
                    <label for="sellPrice">Sell Price</label>
                    <input type="number" name="sellPrice" id="" required>
                    </div>
                    <div>
                        <label for="ptype">Product Type</label>
                        <input type="text" name="ptype" id="" required>
                    </div>
                    </div>
                    <div class="btn-group">
                        <!-- <button type="button" class="btn-pre">Next</button> -->
                        <button type="button" class="btn-nex">Next</button>
                        <button type="submit" class="btn-sub" name="sub" disabled>Submit</button>
                    </div>
                

            </form>
        </div>
    </div>
</div>

<footer class="footer">
   <div class="footercontainer">
      <div class="row">
         <div class="footer-col">
            <h4>company</h4>
            <ul>
               <li><a href="#">about us</a></li>
               <li><a href="#">our services</a></li>
               <li><a href="#">privacy policy</a></li>
            </ul>
         </div>
         <div class="footer-col">
            <h4>get help</h4>
            <ul>
               <li><a href="#">FAQ</a></li>
               <li><a href="#">shipping</a></li>
               <li><a href="#">payment options</a></li>
            </ul>
         </div>
         <div class="footer-col">
            <h4>follow us</h4>
            <div class="social-links">
               <a href="#"><i class="fab fa-facebook-f"></i></a>
               <a href="#"><i class="fab fa-twitter"></i></a>
               <a href="#"><i class="fab fa-instagram"></i></a>
               <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
         </div>
      </div>
   </div>
</footer>


<?php 

require("../connection.php");
if (isset($_POST["sub"])) {
    // user table
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username  = $_POST['username']; 
    $ps=  $_POST['ps'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    // business table
    $bcat = $_POST['bcat']; 
    $bname = $_POST['bname'];
    $det = $_POST['det'];
    // product table 
    $pname = $_POST['pname'];
    $pquantity = $_POST['pquantity'];
    $Details = $_POST['Details'];
    $sellPrice = $_POST['sellPrice'];
    $ptype = $_POST['ptype'];
    $hpass = md5($ps);
    $t = 'Owner';
    try{
        $db->beginTransaction();
        $adduser = $db->prepare('INSERT INTO users (fname,lname,username, password, phone,type,email )
        VALUES (:fname, :lname, :username, :password, :phone, :type, :email)');
    $adduser->execute([
        'fname' => $fname,
        'lname'=> $lname,
        'username'=> $username,
        'password'=> $hpass,
        'phone'=> $phone,
        'type' =>$t,
        'email'=> $email
    ]);
     $uid = $db->lastInsertId();
     $addbusiness = $db->prepare('INSERT INTO business (bname,bdetail,category,bownerid)
        VALUES (:bname, :bdetail,:category,:bownerid)');
    $addbusiness->execute([
        'bname' => $bname,
        'bdetail'=> $det,
        'category' => $bcat,
        'bownerid'=> $uid,
    ]);
    $bid = $db->lastInsertId();
  
    $addpro = $db->prepare('INSERT INTO products (pname,Details,sellPrice, pquantity, bid ,pType)
        VALUES (:pname,:Details,:sellPrice, :pquantity, :bid ,:pType)');
    $addpro->execute([
        'pname' => $pname,
        'Details'=> $Details,
        'sellPrice'=> $sellPrice,
        'pquantity'=> $pquantity,
        'bid'=> $bid,
        'pType' =>$ptype,
    ]);
$db->commit();

    }
    
    catch(PDOException $e){
        die($e->getMessage());
    }
    
}


?>


<script src="multiForm.js"></script>
</body>
</html>
