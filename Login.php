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
    <title>Login Page</title>
</head>
<style>
    body {
        margin-left: 300px;
        margin-right: 300px;
    }

    .container {
        text-align: center;
        margin: 200px;
        border: solid 1px black;
        border-radius: 25px;
        padding: 50px;
    }

    h1 {
        text-align: left;
    }
</style>

<body>

    <div class="container">

        <form method="POST" name="Form" onsubmit="">

            <h1>Log in</h1>


            <h3> Username: <input type="text" name='username' placeholder="Username" /> </h3>
            <h3>Password:<input type='password' name='password' placeholder="Password" /></h3>

            <button>
                <input type="submit" name="log" value="Log in">
            </button>

            <p>New User?<a href="register.php">Create Account</a> </p>

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
</body>

</html>