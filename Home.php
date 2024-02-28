<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <script src="https://kit.fontawesome.com/0c44593f2b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>

  <body>

     
    <div class="container">
      
      <nav class="navbar bg-body-tertiary">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="/Images/Logo.jpg" alt="The Logo" width="30" height="24">
          </a>
        </div>
      </nav>

          <h1>Lets Start</h1>
          <table>
            <form method="post" action="home.php">
              <tr>
                <td><label>Business Name:</label></td>
                <td><input type="text" name="businessName"/></td>
              </tr>

              <tr>
                <td><label>Type:</label></td>
                <td>
                    <select name="btype" id="btype">

                      <option value="Pharmacy">Pharmacy</option>
                      <option value="Grocery">Grocery</option>
                      <option value="Clothes">Clothes</option>
                      <option value="Furniture">Furniture</option>
                      <option value="Resturant">Resturant</option>
                      <option value="Books">Books</option>
                      <option value="Travel Service">Travel Service</option>
                      <option value="School">School</option>
                      <option value="College">College</option>
                      <option value="Gym and Fitness">Gym and Fitness</option>

                    </select>
                  
                </td>
              </tr>
        

            
          </table>
          <button>
                <input type="submit" name="gen" value="Generate Website">
            </button>      
      </div> <!--end of container-->
    
    
    <?php
      
      extract($_POST);
      
      if (isset($gen)) {
        try{
          
          require('connection.php');
          $db->beginTransaction();
          $stmt = $db->prepare("insert into business (bname, btype) values (:bname, :btype)");
          $type='customer';

          $stmt->bindParam(':bname', $businessName);
          $stmt->bindParam(':btype', $type);
          $stmt->execute();

          /*$row=$db->query("Select uid from users where uid=bid");
          foreach($row as $r)
          $uid=$r[0];*/

          $db->commit();
          header("Location:website.php");


        } catch (PDOException $ex) {
            //echo "Please check the information inserted.";
            echo "Error: " . $ex->getMessage();
        }

      }//end if
     // ob_end_flush();
    ?>


    <!--Bootstrap Link-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>