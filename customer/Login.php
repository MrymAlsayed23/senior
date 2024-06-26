<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Login Page</title>
    </head>
    <style>
      
        .container{
            justify-content: center;
            padding-top: 100px;
        }
        p{
            text-align:right;
        }
    </style>
    <body>

        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>


        <div class="container">

            <h1>Login to your account</h1>

            <form method="POST" name="Form" onsubmit="">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name='username' class="form-control" placeholder="Enter your Username" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type='password' name='password' class="form-control" placeholder="Password" />
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>
                
              
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-primary" name="log" value="Sign in">
                </div>
                
                <br>
                <h6>Don't have an account yet? <a href="register.php">Sign up</a> </h6>

            </form>
        </div>
                <?php
                    extract($_POST);
                    if (isset($log)) { //if the form is submitted
                        try {
                            require("../connection.php");
                            if (isset($_POST['remember'])){ //if remember me is enabled
                                $remember = $_POST['remember'];
                            }
                            $hpass = md5($password);
                            $sqlStatement = "select * from users where username = :username and password = :password ;";
                            $stmt = $db->prepare($sqlStatement);
                            $stmt->bindParam(':username', $usernameDB);
                            $stmt->bindParam(':password', $passwordDB);
                            $usernameDB = $username;
                            $passwordDB = $hpass;
                            $stmt->execute();
                            $test = $stmt->fetchAll(PDO::FETCH_ASSOC);


                            if (isset($_POST['remember'])){
                                $remember = $_POST['remember'];
                                $expires= time()+((60*60*24))*7;
                                setcookie('username', $usernameDB,$expires);
                                setcookie('remember', $remember,$expires);
                            }
                            else{
                                setcookie('username', "", time() - 36000);
                                setcookie('remember', "", time() - 36000);
                            }

                            if ($test) {
                                $_SESSION['username'] = $username;
                                foreach ($test as $key => $value) {
                                   $_SESSION['uid'] = $value['uid'];
                                    $_SESSION['username'];
                                }

                                header("Location:customerHome.php");
                                exit();
                            }
                        
                            else echo "<div class='alert alert-danger' role='alert'>Invalid username or Password</div>";

                        } catch (PDOException $ex) {
                            echo $ex->getMessage();
                        }
                    } //end of if statement
                    ob_end_flush();
                ?>

         <!-- footer  -->
         <?php include("../customer/footer.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
