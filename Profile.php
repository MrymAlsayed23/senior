<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Profile Page</title>
    </head>

    <style>
    body{
        margin-left: 300px;
        margin-right: 300px;
    }
    .container{
        text-align:left; 
        margin: 200px;        
        border: solid 1px black;
        border-radius: 25px;
        padding: 50px;
    }

    h1{
        text-align: left;
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
        
        <?php
        
        if (!isset($_SESSION['username'])) {
            header("Location:login.php");
            exit(0);
        }
        
        $username = "Null";
        $fname= "NULL";
        $lname= "NULL";
        $phone=0;
        $email="NULL";
        
        try {
            require('connection.php');
            $sql="select * from profile where userID=".$_SESSION['id'];
            $r=$db->query($sql);
            $db=null;
        } 
        catch (PDOException $e) {
            die("Error Message".$e->getMessage());
        }
        
        $rs=$r->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rs as $key => $value) {
            $username=$value['username'];
            $fname=$value['Fname'];
            $lname=$value['Lname'];
            $phone=$value['phone'];
            $email=$value['email'];
        }
        ?>
        
        <body>
            <div class="container">
                <h1><?php echo $_SESSION['username']; ?></h1>
                <h4>First Name: <?php echo $fname; ?></h4>
                <h4>Last Name: <?php echo $lname; ?></h4>
                <h4>Phone Number: <?php echo $phone; ?></h4>
                <h4>Email: <?php echo $email; ?></h4>
                
            </div>
        </body>
 </html>
