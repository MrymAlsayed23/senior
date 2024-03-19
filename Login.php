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
        body{
            padding: 50px;
            margin-left: 350px;
            margin-right: 350px;
        }
        .container{
            justify-content: center;
            padding: 100px;
        }
        p{
            text-align:right;
        }
    </style>
    <body>

        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="/senior/Images/Logo.jpg" alt="Logo" width="30" height="24">
            </a>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </nav>

        <div class="container">

            <h1>Log in</h1>
            <h5>Login to your account</h5>

            <form method="POST" name="Form" onsubmit="">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name='email' class="form-control" placeholder="Enter your Email" />
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
                    <input type="submit" name="log" value="Sign in">
                </div>
                

                <h6>Don't have an account yet?<a href="register.php">Sign up</a> </h6>

                <?php
                    extract($_POST);
                    if (isset($log)) { //if the form is submitted
                        try {
                            require("connection.php");
                            if (isset($_POST['remember'])){ //if remember me is enabled
                                $remember = $_POST['remember'];
                            }
                            $hpass = md5($password);
                            $sqlStatement = "select * from users where email = :email and password = :password ;";
                            $stmt = $db->prepare($sqlStatement);
                            $stmt->bindParam(':email', $emailDB);
                            $stmt->bindParam(':password', $passwordDB);
                            $emailDB = $email;
                            $passwordDB = $hpass;
                            $stmt->execute();
                            $test = $stmt->fetchAll(PDO::FETCH_ASSOC);


                            if (isset($_POST['remember'])){
                                $remember = $_POST['remember'];
                                $expires= time()+((60*60*24))*7;
                                setcookie('email', $emailDB,$expires);
                                setcookie('remember', $remember,$expires);
                            }
                            else{
                                setcookie('email', "", time() - 36000);
                                setcookie('remember', "", time() - 36000);
                            }

                            if ($test) {
                                $_SESSION['email'] = $email;
                                foreach ($test as $key => $value) {
                                   // $_SESSION['uid'] = $value['uid'];
                                    $_SESSION['email'];
                                }

                                header("Location:home.php");
                                exit();
                            }
                        
                            else echo "Invalid email or Password";

                        } catch (PDOException $ex) {
                            echo $ex->getMessage();
                        }
                    } //end of if statement
                    ob_end_flush();
                ?>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
