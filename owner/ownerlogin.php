<?php
session_start();
if (isset($_POST["sign"])) {

  $uname = $_POST["username"];
  $pass = $_POST["password"];
  try {
    require('../connection.php');

    $sql = "SELECT u.*, b.bid 
        FROM users u 
        LEFT JOIN business b ON u.uid = b.bownerid 
        WHERE u.username = '$uname'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    // $sql = "SELECT * FROM users WHERE username ='$uname'";
    // $rs = $db->query($sql);
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      //extract($row);
      if ($pass == $row['password']) {
        //echo $row['password'];
        if ($row['type'] == 'Owner') {
          $_SESSION['owner'] = $row['uid'];
          $bid = $row['bid'];
          header('Location: ownerPanel.php?bid=' . $bid);
          die();
        }
        if ($row['type'] == 'Admin') {
          $_SESSION['admin'] = $row['uid'];
          header("location: ../admin/dashbord.php");
        }
      }
    }
    $db = null;
  } catch (Exception $e) {
    die($e->getMessage());
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <script src="https://kit.fontawesome.com/02448b3b92.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="signinn.css">
  <style>
    .sidebar-item {
      border: 0px solid;
      margin-left: 3.5rem;
      margin-right: 1.5rem;
      text-align: center;
      padding-top: 10px;
      padding-bottom: 10px;
      cursor: pointer;
    }

    .sidebar-item a {
      color: black;
      font-weight: 400;
    }

    nav ul li a {
      display: block;
      font-size: 16px;
      text-transform: capitalize;
      color: #aaaaaa;
      padding: 10px 0;
      transition: all 0.5s ease;
      text-decoration: none;
    }

    .sidebar-item:hover,
    .sidebar-item:hover i,
    .sidebar-item:hover a {
      /*border: 1px solid #b4628f;*/
      color: #cc7fa9;
      border-radius: 2px;
      font-weight: 600;
      /*background-color: #ece1e7;*/
      /*color: white;*/
      transition: 0.5s;
    }

    hr{
        color: #414040;
      }

  </style>

<body>


  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href=""><img src="../home/logo/logo.png" alt="" style="width: 30%;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="sidebar-item px-1">
            <a href="../home/home.php" class="sidebar-link">
              <span>Home</span>
            </a>
          </li>

          <li class="sidebar-item px-1">
            <a href="" class="sidebar-link">
              <span>Company</span>
            </a>
          </li>

          <li class="sidebar-item px-1">
            <a href="" class="sidebar-link">
              <span>Services</span>
            </a>
          </li>

          <li class="sidebar-item px-1">
            <a href="" class="sidebar-link">
              <span>Contact</span>
            </a>
          </li>
          <li class="sidebar-item px-1">
            <a href="ownerlogin.php" class="sidebar-link">
              <span>Login</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <hr>

  <form action="ownerlogin.php" method="post" id="loginForm">

    <br><br><br>
    <main>
      <div class="container-fluid">
        <div class="signup-container">
          <h4 class="erro" style="text-align:center;" id="msg"></h4><br>
          <div class="signup-outline">
            <div class="signup-background">
              <table class="caption-top sign-in">
                <caption>
                  <h2 style="color: black;">Sign in</h2>
                  <span style="font-weight:100;">
                    <p>Login to Your Account</p>
                  </span>
                  <span style="font-weight:100;">
                    <p>Thank you to get to
                      <span style="font-weight:500;">Automaited Business</span>
                    </p>
                  </span>
                </caption>
                <tr>
                  <input type="hidden" name="uid" form="loginForm">
                  <td><label for="username">Username</label></td>
                  <td><input type="text" name="username" id="username" required form="loginForm"> <br> <small></small> </td>
                </tr>
                <tr>
                  <td><label for="password">Password</label></td>
                  <td><input type="password" name="password" id="password" required form="loginForm"> <br> <small></small> </td>
                </tr>
                <div class="footerTable">
                  <tr>
                    <td colspan="2" style="text-align:center;"><button class="razi-btn singin-btn" type="submit" name="sign" form="loginForm">Login</button></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="btnSignup"><span style="color: #726464;
                    font-weight:500;margin-left: 3.8rem;">Not a member? </span><a href="signup.php" class=""> Signup</a></td>
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