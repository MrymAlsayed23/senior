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

        <div class="container">

            <h1>Log in</h1>
            <h5>Login to your account</h5>

            <form method="POST" name="Form" onsubmit="">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name='username' class="form-control" placeholder="Email of Phone Number" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type='password' name='password' class="form-control" placeholder="Password" />
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember me</label>
                    <p href="#"><a href="">Reset Password?</a> </p>
                </div>
                
              
                <div class="d-grid gap-2">
                    <button class="btn btn-secondary">
                        <input type="submit" name="log" value="Sign in">
                    </button>

                </div>
                

                <h6>Don't have an account yet?<a href="register.php">Sign up</a> </h6>

                <?php
                extract($_POST);
                if (isset($log)) {
                    try {
                        require("connection.php");
                        $hpass = md5($password);
                        $sqlStatement = "select * from users where username = :username and password = :password ;";
                        $stmt = $db->prepare($sqlStatement);
                        $stmt->bindParam(':username', $usernameDB);
                        $stmt->bindParam(':password', $passwordDB);
                        $usernameDB = $username;
                        $passwordDB = $hpass;
                        $stmt->execute();
                        $test = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($test) {
                            $_SESSION['username'] = $username;
                            foreach ($test as $key => $value) {
                                $_SESSION['uid'] = $value['uid'];
                                $_SESSION['username'];
                                //$_SESSION['type']=$value['type'];
                            }

                            header("Location:home.php");
                            exit();
                        }
                    
                        else echo "Invalid Username or Password";
                    } catch (PDOException $ex) {
                        echo $ex->getMessage();
                    }
                }
                ob_end_flush();
                ?>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
