<?php 
if (!(isset($_SESSION['owner'])))
{
  header('location: ownerHome.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="owner.css">
  </head>
  <body>
    
  
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top pb-2">
      <div class="container-fluid">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="sidebar-item px-1">
              <a href="OwnerPanel.php?bid='<?php echo $bid;?>'" class="sidebar-link">
              <i class="fa-solid fa-house"></i>
              <span>Dashboard</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayProducts.php?bid='<?php echo $bid?>'" class="sidebar-link">
              <i class="fa-solid fa-box"></i>
              <span>Products</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayOrders.php?bid='<?php echo $bid?>'" class="sidebar-link">
              <i class="fa-solid fa-boxes-packing"></i>
              <span>Orders</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="displayCustomers.php?bid='<?php echo $bid?>'" class="sidebar-link">
              <i class="fa-solid fa-users"></i>
              <span>Customers</span>
              </a>
          </li>

          <li class="sidebar-item px-1">
              <a href="" class="sidebar-link">
              <i class="fa-solid fa-palette"></i>
              <span>Edit Layout</span>
              </a>
          </li>

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



    <script src= "sidebarToggle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
  </body>
</html>