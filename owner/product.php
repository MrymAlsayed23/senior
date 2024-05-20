<?php 
session_start();
if (!(isset($_SESSION['owner'])))
{
  header('location: ownerHome.php');
}
$bid = $_GET['bid'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <title>New Product</title>
        <link rel="stylesheet" href="o.css">
    </head>
    <style>
       
    </style>
    <body>

    <?php 
     require('../connection.php');
     $sql00 = "SELECT * FROM business WHERE bid='$bid'";
     $r00 = $db->query($sql00);
     while ($d00 = $r00->fetch(PDO::FETCH_ASSOC)){
      extract($d00);
     
   ?>


        <!-- nav  -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top pb-2">
      <div class="container-fluid">
      <a class="navbar-brand" href="#"><?php echo $d00['bname'];?></a> <?php }?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="sidebar-item px-1">
              <a href="OwnerPanel.php?bid=<?php echo $bid;?>" class="sidebar-link">
              <i class="fa-solid fa-house"></i>
              <span>Dashboard</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayProducts.php?bid=<?php echo $bid?>" class="sidebar-link">
              <i class="fa-solid fa-box"></i>
              <span>Products</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayOrders.php?bid=<?php echo $bid?>" class="sidebar-link">
              <i class="fa-solid fa-boxes-packing"></i>
              <span>Orders</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayCustomers.php?bid=<?php echo $bid?>" class="sidebar-link">
              <i class="fa-solid fa-users"></i>
              <span>Customers</span>
              </a>
          </li>

          <!-- <li class="sidebar-item px-1">
              <a href="" class="sidebar-link">
              <i class="fa-solid fa-palette"></i>
              <span>Edit Layout</span>
              </a>
          </li> -->

          <!-- <li class="sidebar-item px-1">
              <a href="" class="sidebar-link">
              <i class="fa-solid fa-comment-dots"></i>
              <span>Messages</span>
              </a>
          </li> -->
          <li class="sidebar-item px-1">
            <a href="ownerlogout.php" class="sidebar-link">
              <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
            </a>
        </li>

          </ul>
        </div>
      </div>
    </nav>

        <div class="container">
            
            <form method="POST" name="Form" action="product.php?bid=<?php echo $bid;?>" enctype="multipart/form-data">
            <input type="number" name="bid" value="<?php echo $bid;?>" hidden>
                
                <h2>New Product</h2>
                <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="pname" class="form-label">Product Name</label>
                        <input type="text" name="pname" class="form-control" id="pname" pattern="[a-zA-Z0-9!@#$%^&*_\-.,\s]{5,250}" title="Product Name Must not be empty and not short" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="pquantity" class="form-label">Quantity</label>
                        <input type="number" name="pquantity" class="form-control" id="pquantity" min="1" required>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="Details" class="form-label">Details</label>
                        <textarea name="Details" id="" cols="3" rows="3" placeholder="Details" class="form-control" id="Details" pattern="[a-zA-Z0-9!@#$%^&*_\-.,\s]{10,}" title="Details Must not be empty and not short" required></textarea>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="pType" class="form-label">Product Type</label>
                        <input type="text" name="pType" class="form-control" id="pType" pattern="[a-zA-Z]{1,100}" title="Product Type Must not be empty" required>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image"
                        required>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="sellPrice" class="form-label">Sell Price</label>
                        <input type="number" name="sellPrice" class="form-control" id="sellPrice" step="any" required>
                    </div>
                    </div>
                    <div class="row text-center">
                    <div class="col mb-3">
                        <button type="submit" class="btn save" name="save"
                        style="background-color: #cc7fa9;border-color:#cc7fa9;padding:10px 60px;
                        font-size:3vh;font-weight:700;">Add Product</button>
                    </div>
                    </div>
                    </div>
                
                    <!-- <tr>
                        <td>

                            <input type="submit" name="save" id="" value="Save">
                            <input type="submit" name="saveAnother" id="" value="Save and Add Another">

                        </td>
                    </tr> -->
            </form>

        </div>
        
        <?php
        require('../connection.php');
         if (isset($_POST['save'])){
            $pname = $_POST['pname'];
            $Details = $_POST['Details'];
            $sellPrice = $_POST['sellPrice'];
            $ptype = $_POST['pType'];
            $pquantity = $_POST['pquantity'];
            $bid = $_POST['bid'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $content = file_get_contents($_FILES['image']["tmp_name"]);
             //$imgContent = file_get_contents($image);
            //echo $fileName;
            try{
                $addpro = $db->prepare('INSERT INTO products (pname,Details,sellPrice, pquantity,imagename,
                imagesize,image, bid ,pType)
                 VALUES (:pname,:Details,:sellPrice, :pquantity,:imagename,:imagesize,:image,:bid,:pType)');
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
                
                if ($addpro>0){
                    $_SESSION['status'] = 'Sucess';
                    
            }
               
            }
              
            catch(Exception $e){
                die($e->getMessage());
            }
         }
           
        ?>



        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <?php if (isset($_SESSION['status'])) { ?>
        <script>
            Swal.fire({
                        text: "The Product Added Successfuly",
                        icon: "success",
                        showConfirmButton: false,
                      });
        </script>
        <?php } unset($_SESSION['status']); ?>
    </body>
</html>
