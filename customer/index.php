<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--------- Link Swiper's CSS ----------->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

        <title>Book Store</title>
    </head>
    <style>
      *{
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: 'Poppins', sans-serif;
        }
        .homebody{
          margin: 0;
          background-color: #ffffff;
        }
        .homecontainer{
          width: 100vw;

          font-family: 'quicksand',sand-sans-serif;
          font-weight: bold;
          font-size: 20px;

          align-items: center;
          justify-content: center;
          margin: 0 auto;
        }

        figcaption{
          width: 100vw;
          height: 700px;
          background-color:#f0f7f5 ;
        }
        .homenav{
          width: 50vw;
          height: 700px;
          background-color:#60d1a7 ;
        }
        aside{
        width: 45vw;
        height: 300px;
        color: black;
        background-color: #f0f7f5;
        margin-top: -500px;
        float: right;
        font-family: "Times New Roman", Times, serif;
        padding-left: 30px;
        }
        .p1{
          Font-size: 70PX;
        }
        .p2{
          Font-size: 15PX;
          color: black;
          padding-top: 7px;
          padding-bottom: 19px;
        }

        a.contact{/*still not*/
          background-color: #60d1a7;
          color: #ffffff;
          border: 10px solid #60d1a7;
          border-radius: 12px;
          border: none;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
        }
        a.contact:hover {
          box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
        main{
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
        }
        h1{
            text-align: center;
        }
        span section::before {
            content: "\A";
        }
        section{
            position: relative;
            height: 450px;
            width: 1075px;
            display: flex;
            align-items: center;
        }

        .swiper{
            width: 950px;
        }

        .card{
          position: relative;
          background: #fff;
          border-radius: 20px;
          margin: 20px 0;
          box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .card::before{
          content: "";
          position: absolute;
          height: 65%;
          width: 100%;
          background: #eaedf1;
          border-radius: 20px 20px 0 0;
        }

        .card .card-content{
          display: flex;
          flex-direction: column;
          align-items: center;
          padding: 30px;
          position: relative;
          z-index: 100;
        }

        section .card .image{
          height: 140px;
          width: 140px;
          padding: 3px;
          background: #eaedf1;
        }


        section .card .image img{
          height: 100%;
          width: 100%;
          object-fit: cover;
        }


        .card .name-profession{
          display: flex;
          flex-direction: column;
          align-items: center;
          margin-top: 10px;
          /* color: ; */
        }

        .cardw{
          position: relative;
          background: #fff;
          border-radius: 20px;
          margin: 20px 0;
          box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .cardw::before{
          content: "";
          position: absolute;
          height: 65%;
          width: 100%;
          background: #ffffff;
          border-radius: 20px 20px 0 0;
        }

        .cardw .cardw-content{
          display: flex;
          flex-direction: column;
          align-items: center;
          padding: 30px;
          position: relative;
          z-index: 100;
        }

        section .cardw .image{
          height: 140px;
          width: 140px;
          padding: 3px;
          background: #ffffff;
        }


        section .cardw .image img{
          height: 100%;
          width: 100%;
          object-fit: cover;
        }


        .cardw .name-profession{
          display: flex;
          flex-direction: column;
          align-items: center;
          margin-top: 10px;
          /* color: ; */
        }

        .name-profession .name{
            font-size: 20px;
            font-weight: 600;
        }

        .name-profession .profession{
            font-size:15px;
            font-weight: 500;
            color: #60d1a7;
        }

        .swiper-pagination{
            position: absolute;
        }

        .swiper-pagination-bullet{
            height: 7px;
            width: 26px;
            border-radius: 25px;
            background: #60d1a7;
        }

        .swiper-button-next, .swiper-button-prev{
            opacity: 0.7;
            color: #60d1a7;
            transition: all 0.3s ease;
        }
        .swiper-button-next:hover, .swiper-button-prev:hover{
            opacity: 1;
            color: #60d1a7;
        }        

    </style>
    <body>

     <!-- nav  -->
     <?php include("../customer/customerNavBar.php"); ?>

     <figcaption>
              <nav class="homenav">
              </nav>

      <?php

        try {
            require('../connection.php');
            // Define the range of product IDs you want to display
            $startProductId = 1; // Starting product ID
            $endProductId = 9; // Ending product ID

            // Prepare and execute the SQL query
            $sql = "SELECT * FROM products WHERE pid BETWEEN :startProductId AND :endProductId";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':startProductId', $startProductId);
            $stmt->bindParam(':endProductId', $endProductId);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


              foreach ($results as $result) {
                  $productId = $result['pid'];
                  $brandName = $result['BrandName'];
                  $pname = $result['pname'];
                  $image = $result['image'];
                  $sellPrice = $result['sellPrice'];
                  $pType = $result['pType'];
              }
          
            ?>

              <aside>
                <p class="p1">  <?php echo $brandName; ?></p> <br/> 
                <p class="p2">  <?php echo "will be as a new"; ?></p> <br/> 
                <a href="contact.php" class="contact">Contact with Us!</a>
              </aside>

            </figcaption>

            <main>
              <span class="one">
          
            <section>
              <div class="swiper mySwiper container">
                <div class="swiper-wrapper content">

                  <div class="swiper-slide card">
                    <div class="card-content">
                      <div class="image">

                        <?php

                        echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                        ?>                    
                  </div>


                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=1)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=1)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <?php

                      echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                      ?>                   
                  </div>



                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=2)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=2)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                <div class="image">
                    <?php

                      echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                      ?>                   
                  </div>



                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=3)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=3)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <?php

                      echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                      ?>                   
                  </div>



                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=4)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=4)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <?php

                      echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                      ?>                   
                  </div>



                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=5)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=5)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <?php

                      echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                      ?>                   
                  </div>



                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=6)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=6)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <?php

                      echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                      ?>                   
                  </div>



                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=7)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=7)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <?php

                      echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                      ?>                   
                  </div>



                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=8)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=8)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <?php

                      echo '<img src="../Images/' . $image . '" alt="Product Image"><br>';
                      ?>                   
                  </div>



                  <div class="name-profession">
                    <span class="name">
                      <?php
                      if($pid=9)
                        echo $pname;
                    ?>
                    </span>
                    <span class="profession">
                    <?php
                      if($pid=9)
                        echo $sellPrice." BD";
                    ?>
                    </span>
                  </div>



                </div>
              </div>

            </div>
          </div>

          <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </section>
      </span>

            <?php
            
              $db = null; // Close the database connection
              } catch (PDOException $e) {
                die("Error Message" . $e->getMessage());
              }
            ?>

        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
          var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            slidesPerGroup: 3,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
          });
        </script>

      </main>
      

        <!-- footer  -->
        <?php include("../customer/footer.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
