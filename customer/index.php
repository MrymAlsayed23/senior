<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--------- Link Swiper's CSS ----------->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

        <title>Customer Home Page</title>
    </head>
    <style>
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

        <main>
        <span class="one">
          <h1>xxx</h1>
        <section>
          <div class="swiper mySwiper container">
            <div class="swiper-wrapper content">

              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD1.5</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD2</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD2.9</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD3</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD1.9</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD11.7</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD10</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD0.5</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">xxx</span>
                    <span class="profession">BD22.8</span>
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
        


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
