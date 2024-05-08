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
        <link rel="stylesheet" href="owner.css">
    </head>
    <style>
        
    </style>


    <body>

        <!-- nav  -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top pb-2">
      <div class="container-fluid">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
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

          <li class="sidebar-item px-1">
              <a href="" class="sidebar-link">
              <i class="fa-solid fa-comment-dots"></i>
              <span>Messages</span>
              </a>
          </li>
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
            <form method="POST" name="Form" action="">
                <h2>New Product</h2>
                
                    <div class="mb-3">
                        <label for="pname" class="form-label">Product Name</label>
                        <input type="email" name="pname" class="form-control" id="pname" required>
                    </div>
                    <div class="mb-3">
                        <label for="pquantity" class="form-label">Quantity</label>
                        <input type="number" name="pquantity" class="form-control" id="pquantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="Details" class="form-label">Details</label>
                        <textarea name="Details" id="" cols="3" rows="3" placeholder="Details" class="form-control" id="Details" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="pType" class="form-label">Product Type</label>
                        <input type="text" name="pType" class="form-control" id="pType" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image" required>
                    </div>

                    <div class="mb-3">
                        <label for="sellPrice" class="form-label">Sell Price</label>
                        <input type="number" name="sellPrice" class="form-control" id="sellPrice" required>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="save"
                        style="background-color: #cc7fa9;border-color:#cc7fa9;">Save</button>
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
        extract($_POST);

        if (isset($save) || isset($saveAnother)) {
            try {
                require('../connection.php');
                $db->beginTransaction();
                $stmt = $db->prepare("insert into products (pname, BrandName, Details, sellPrice, pquantity, image, pType) values (:pname, :BrandName, :Unit, :Details, :sellPrice, :pquantity, :image, :pType)");
            
                $stmt->bindParam(':pname', $pname);
                $stmt->bindParam(':BrandName', $BrandName);
                $stmt->bindParam(':Details', $Details);
                $stmt->bindParam(':sellPrice', $sellPrice);
                $stmt->bindParam(':pquantity', $pquantity);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':pType', $pType);


                $r = $stmt->execute();
                if ($r == 1) {
        ?>
                    <div class="alert a-cont " role="alert">
                        <div class="modal-body">
                            <script>
                                alert("New Product has been inserted successfully");
                            </script>                    
                        </div>
                    </div>

        <?php
                } else {
                    throw new PDOException("Error");
                }

                $db->commit();
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }
        ob_end_flush();
        ?>



        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
