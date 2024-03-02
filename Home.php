<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Home Page</title>
    </head>
    <style>
        .homePic{
            justify-content: space-between;
        }

        .main{
            text-align: center;
        }

        .footer{
            text-align: center;
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

                        <li class="nav-item" >
                            <a class="nav-link" href="Login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </nav>

        <hr>

        <div class="container">
            <p>Our Mission</p>
            <h1>Paving the way to success for our clients.</h1>
            <img src="/senior/Images/homePic.png" alt="" class="homePic">

            <h3 style="text-align: center;">Our Services</h3>

            <div class="card-group">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Design</h5>
                        <p class="card-text">Design your E-commerce website.</p>
                    </div>
                </div>

                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Reports</h5>
                        <p class="card-text">Providing you with reports about your business.</p>
                    </div>
                </div>

                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Consultancy</h5>
                        <p class="card-text">Assisting you in making the right decision for your business.</p>
                    </div>
                </div>
            </div> <!--end card group div-->

            <div class="main">
                <h2>Why Choose Us?</h2>
                <p>Choosing us means more than just getting a website. You will get a partner whose mission is to make your business shine online at an affordable price.</p>
                <p>We ensure excellent through the lates thechnology, sleek design, and fast performance. In short, you choose us because you want more than a website; you want an experienced digital partner who will work for your interest.</p>
            </div>

            <div class="footer">
                <h2>Dream it? We build it!</h2>
                <p>Let us build your website layout and content based on your industry.</p>
                
                <div class="footerImg">
                    <img src="" alt="">
                    <h3>Set</h3>
                    <small>Your business</small>
                </div>

                <div class="footerImg">
                    <img src="" alt="">
                    <h3>Add</h3>
                    <small>Your Logo</small>
                </div>

                <div class="footerImg">
                    <img src="" alt="">
                    <h3>Select</h3>
                    <small>Additional features</small>
                </div>

                <div class="footerImg">
                    <img src="" alt="">
                    <h3>Choose</h3>
                    <small>Your favorite theme</small>
                </div>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
