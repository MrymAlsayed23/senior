<?php 
session_start();
if (isset($_POST["sign"])) {
    $username = $_POST["username"];
    $ps = $_POST["password"];
    try{
        require('../connection.php');
          $sql = "SELECT * FROM users WHERE username ='$username'";
          $rs = $db->query($sql);
          if ($row=$rs->fetch()){
              extract($row);
              //echo $type;
              if(password_verify($ps, $password)){
                echo "Esladx;sw";
                // if ($type =='Admin'){
                //   $_SESSION['staff'] = $uid;
                //   header('location:orders.php');
                // }
                if ($type == 'Owner'){
                  $_SESSION['owner'] = $uid;
                 header('location:OwnerPanel.php');
              }
              }
            }
    }
    catch(Exception $e){
        die($e->getMessage());
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="signin.css">
  <body>


<form action="login.php" method="post" id="loginForm">

  <br><br><br>
    <main>
      <div class="container-fluid">
        <div class="signup-container">
          <h4 class="erro"  style="text-align:center;" id="msg"></h4><br>
          <div class="signup-outline">
            <div class="signup-background">
              <table class="caption-top sign-in">
                <caption>
                   <h2 style="color: black;">Sign in</h2>
                   <span style="font-weight:100;"><p>Login to Your Account</p></span>
                   <span style="font-weight:100;"><p>Thank you to get to 
                    <span style="font-weight:500;">Automaited Business</span></p></span>
                </caption>
                  <tr>
                  <input type="hidden" name="uid" form="loginForm">
                    <td><label>Username</label></td>
                    <td><input type="text" name="username" id="username" required 
                    form="loginForm">  <br> <small></small> </td>
                  </tr>
                  <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" name="password" id="password" required  
                    form="loginForm"> <br>  <small></small> </td>
                  </tr>
                  <div class="footerTable">
                  <tr>
                    <td colspan="2" style="text-align:center;"><button class="razi-btn singin-btn" type="submit" name="sign"
                    form="loginForm">Login</button></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="btnSignup" ><span style="color: #726464;
                    font-weight:500;margin-left: 3.8rem;">Not a member? </span><a  href="signup.php" class=""> Signup</a></td>
                  </tr>
                  </div>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    </form>













    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>