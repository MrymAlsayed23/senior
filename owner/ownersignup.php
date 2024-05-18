<?php session_start(); ?>

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
            <form method="post" id="myForm" enctype="multipart/form-data">
                <div class="form-one form-step active">
                    <div class="bg-svg"></div>
                    <h2>Personal Information</h2>
                    <p>Make Sure to Enter Your Personal Information Correctly</p>
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" pattern="/([A-Z][a-Z]){2,12}/" required>
                    </div>
                    <div>
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" pattern="/([A-Z][a-Z]){2,12}/" required>
                    </div>
                    <div>
                        <label for="username">User Name</label>
                        <input type="text" name="username" pattern="/([a-ZA-Z0-9_.-]){4,15}/" required>
                    </div>
                    <div>
                        <label for="ps">Password</label>
                        <input type="password" name="ps" pattern="/([A-Z][a-z0-9]){3,19}[!@#$%^&*-._?]{1}/" required>
                    </div>
                    <div>
                        <label for="phone">Phone</label>
                        <input type="tel" name="phone" pattern="/((36)[0-9]{7})|((17)[0-9]{6})/" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" pattern="/[a-zA-Z0-9._-]+@[a-zA-Z0-9-+_.]+.[a-zA-Z]{2,5}/" required>
                    </div>
                    </div>
                    <div class="form-two form-step">
                    <div class="bg-svg"></div>
                    <h2>Select Your Category</h2>
                    <!-- <p>Make Sure to Enter Your Personal Information Correctly</p> -->
                    <div>
                        <label for="bcat">Category</label>
                        <select name="bcat" id="" placeholder="Select .." required >
                            <option value="Book">Books</option>
                            <option value="Book">Hand Made</option>
                            <option value="Book">Electronics</option>
                            <option value="Book">Clothes</option>
                            <option value="Book">Bags</option>
                            <option value="Accessories">Accessories</option>
                            <option value="Accessories">Sport Equipment and Apparel</option>
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
                    <div>
                        <label for="bname">Your Business Logo</label>
                        <input type="file" name="logo" required >
                    </div>
                    <!-- <div>
                        <label for="">Your Business Category</label>
                        <input type="text" disabled value="bcat">
                    </div> -->
                    <div>
                        <label for="det">More Details About Your Business</label>
                        <!-- <input type="text" name="det" required > -->
                        <textarea name="det" id="" cols="30" rows="5" placeholder="Details" required></textarea>

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
                    <label for="image" class="form-label">Image</label>
                        <input type="file" name="imagePro" class="form-control" id="image"
                        required>
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
                        <button type="button" class="btn-back" disabled>Back</button>
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
    $logoName = $_FILES['logo']['name'];
    $logoSize = $_FILES['logo']['size'];
    $contentlogo = file_get_contents($_FILES['image']["tmp_name"]);

    $fileName = $_FILES['imagePro']['name'];
    $fileSize = $_FILES['imagePro']['size'];
    $content = file_get_contents($_FILES['imagePro']["tmp_name"]);
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
     $addbusiness = $db->prepare('INSERT INTO business (bname,blogo,logoname,logosize,bdetail,category,bownerid)
        VALUES (:bname,:blogo,:logoname,:logosize,:bdetail,:category,:bownerid)');
    $addbusiness->execute([
        'bname' => $bname,
        'blogo' => $contentlogo,
        'logoname' =>$logoName,
        'logosize' => $logoSize,
        'bdetail'=> $det,
        'category' => $bcat,
        'bownerid'=> $uid,
    ]);
    $bid = $db->lastInsertId();
  
    $addpro = $db->prepare('INSERT INTO products ((pname,Details,sellPrice, pquantity,imagename,
    imagesize,image, bid ,pType)
        VALUES (:pname,:Details,:sellPrice,:pquantity,:imagename,:imagesize,:image,:bid,:pType)');
    $addpro->execute([
        'pname' => $pname,
                   'Details'=> $Details,
                   'sellPrice'=> $sellPrice,
                    'pquantity'=> $pquantity,
                    'imagename' =>$fileName,
                    'imagesize' => $fileSize,   
                     'image' => $content,
                   'bid'=> $bid,
                  'pType' =>$ptype,
    ]);
    if ($addpro> 0){  
        $_SESSION['status'] = 'add ';
       } 
     
$db->commit();

    }
    
    catch(PDOException $e){
        $db->rollBack();
        die($e->getMessage());
    }
    
}


?>


<script src="multiForm.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <?php if (isset($_SESSION['status'])) { ?>
        <script>
            Swal.fire({
                        text: "Done Successfuly",
                        icon: "success",
                        showConfirmButton: false,
                      });
        </script>
        <?php } unset($_SESSION['status']); ?>
</body>
</html>
