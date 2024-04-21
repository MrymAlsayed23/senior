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

        article{
  height: 600px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f0f7f5;
}
summary{
  height: 600px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
}

    
        

    </style>
    <body>

        <!-- nav  -->
        <?php include("../customer/customerNavBar.php"); ?>

        <figcaption>
        <nav class="homenav">
          <img src="../Images/Library.avif">
        </nav>


        <aside>
          <p class="p1">Our<br/>Library</p>
          <p class="p2">Discover the World of Books: Your Online Bookstore Destination</p>
          <a href="contact.php" class="contact">Contact with Us!</a>
        </aside>

      </figcaption>

        <main>
        <span class="one">
          <h1>Children Books</h1>
        <section>
          <div class="swiper mySwiper container">
            <div class="swiper-wrapper content">

              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Cholcolate Me!.jpg" alt="Cholcolate Me!">
                  </div>



                  <div class="name-profession">
                    <span class="name">Cholcolate Me!</span>
                    <span class="profession">BD1.5</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Daddy and Me and the Rhyme to be.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">Daddy and Me and the Rhyme to be</span>
                    <span class="profession">BD2</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Daddy Dressed Me.jpeg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">Daddy Dressed Me</span>
                    <span class="profession">BD2.9</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/I Don't Want To Be Quite!.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">I Don't Want To Be Quite!</span>
                    <span class="profession">BD3</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/I Said No!.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">I Said No!</span>
                    <span class="profession">BD1.9</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Milo's Monster.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">Milo's Monster</span>
                    <span class="profession">BD11.7</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/My Monster and Me.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">My Monster and Me</span>
                    <span class="profession">BD10</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Pattern Breakers.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">Pattern Breakers</span>
                    <span class="profession">BD0.5</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Say Something.jpeg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">Say Something</span>
                    <span class="profession">BD6</span>
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
        
      <article>
        <span class="one">
          <h1>Historical Books</h1>
          <section>

          <div class="swiper mySwiper container">
            <div class="swiper-wrapper content">

              <div class="swiper-slide cardw">
                <div class="cardw-content white">
                  <div class="image">
                  <img src="../customer/Images/Ancient Civilizations.jpg" alt="Ventolin HFA">
                  </div>



                  <div class="name-profession">
                    <span class="name">Ancient Civilizations</span>
                    <span class="profession"><s>BD7</s> BD5.8</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide cardw">
                <div class="cardw-content">
                  <div class="image">
                    <img src="../customer/Images/Band of Sisters.jpg" alt="Acetaminophen">
                  </div>



                  <div class="name-profession">
                    <span class="name">Band of Sisters</span>
                    <span class="profession"><s>BD6</s> BD4.5</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide cardw">
                <div class="cardw-content">
                  <div class="image">
                    <img src="../customer/Images/Bible is a Single Book.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">Bible is a Single Book</span>
                    <span class="profession"><s>BD3</s> BD1.95</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide cardw">
                <div class="cardw-content">
                  <div class="image">
                    <img src="../customer/Images/Know your Bible.jpeg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">Know your Bible</span>
                    <span class="profession"><s>BD6</s> BD5</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide cardw">
                <div class="cardw-content">
                  <div class="image">
                    <img src="../customer/Images/The Bride's Sister.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">The Bride's Sister</span>
                    <span class="profession"><s>BD7</s> BD5.8</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide cardw">
                <div class="cardw-content">
                  <div class="image">
                    <img src="../customer/Images/The Edelweiss Sisters.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">The Edelweiss Sisters</span>
                    <span class="profession"><s>BD7</s> BD5.8</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide cardw">
                <div class="cardw-content">
                  <div class="image">
                    <img src="../customer/Images/The Everygirl Single Girl.png" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">The Everygirl Single Girl</span>
                    <span class="profession"><s>BD7.746</s> BD6.421</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide cardw">
                <div class="cardw-content">
                  <div class="image">
                    <img src="../customer/Images/The History of the Renaissance World.jpg" alt="">
                  </div>



                  <div class="name-profession">
                    <span class="name">The History of the Renaissance World</span>
                    <span class="profession"><s>BD5.267</s> BD2.633</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide cardw">
                <div class="cardw-content">
                  <div class="image">
                    <img src="../customer/Images/The Last Daughter.jpg" alt="Denture Cleanser">
                  </div>



                  <div class="name-profession">
                    <span class="name">The Last Daughter</span>
                    <span class="profession"><s>BD3.309</s> BD1.750</span>
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

      </article>


      <summary>
        <span class="one">
          <h1>Horror Books</h1></br>
        <section>

          <div class="swiper mySwiper container">
            <div class="swiper-wrapper content">

              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Ghost and Other Unseen Visitors.jpg" alt="Ghost and Other Unseen Visitors">
                  </div>



                  <div class="name-profession">
                    <span class="name">Ghost and Other Unseen Visitors</span>
                    <span class="profession">BD4.494</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Ghost Eaters.jpeg" alt="Ghost Eaters">
                  </div>



                  <div class="name-profession">
                    <span class="name">Ghost Eaters</span>
                    <span class="profession">BD6.097</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Ghost in My Life.jpeg" alt="Ghost in My Life">
                  </div>



                  <div class="name-profession">
                    <span class="name">Ghost in My Life</span>
                    <span class="profession">BD17.5</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Ghost Song.jpg" alt="Ghost Song">
                  </div>



                  <div class="name-profession">
                    <span class="name">Ghost Song</span>
                    <span class="profession">BD5</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/Her Body and Other Parties.jpg" alt="Her Body and Other Parties">
                  </div>



                  <div class="name-profession">
                    <span class="name">Her Body and Other Parties</span>
                    <span class="profession">BD3.675</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/The Drift.jpg" alt="The Drift">
                  </div>



                  <div class="name-profession">
                    <span class="name">The Drift</span>
                    <span class="profession">BD4.999</span>
                  </div>




                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/The Ghost Between Us.jpg" alt="The Ghost Between Us">
                  </div>



                  <div class="name-profession">
                    <span class="name">The Ghost Between Us</span>
                    <span class="profession">2.75</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/The Outsider.jpeg" alt="The Outsider">
                  </div>



                  <div class="name-profession">
                    <span class="name">The Outsider</span>
                    <span class="profession">2.35</span>
                  </div>



                </div>
              </div>
              <div class="swiper-slide card">
                <div class="card-content">
                  <div class="image">
                    <img src="../customer/Images/What Moves the Dead.jpeg" alt="What Moves the Dead">
                  </div>



                  <div class="name-profession">
                    <span class="name">What Moves the Dead</span>
                    <span class="profession">BD2.864</span>
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

      </summary>


        <!-- footer  -->
        <?php include("../customer/footer.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
