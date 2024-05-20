<!DOCTYPE html>
<html lang="en">
<head>
  <title>Navbar - Html Css Javascript</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="css/home.css">
</head>
<body>

 <header class="header">
    <div class="headercontainer">
        <div class="row align-items-center justify-content-between">
            <div class="logo">
               <a href="#"><img src="logo/logo.png" alt="Logo"></a>
            </div>
            <button type="button" class="nav-toggler">
               <span></span>
            </button>
            <nav class="nav">
               <ul>
                  <li><a href="#">home</a></li>
                  <li><a href="#">Company</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Contact</a></li>
                  <li><a href="owner/ownerlogin.php" class="active">Login</a></li>
               </ul>
            </nav>
        </div>
    </div>
 </header>
 <hr>
 <div class="container"></div>
   <main>
      <div class="maincontainer">
         <div class="title">
            <h1 class="a">Our Mission</h1>
            <h1 class="b">Paving the way to<br>success for our<br>clients.</h1>
            <a href="../owner/ownersignup.php">
            <button class="getstarted">Get started</button>
            </a>
         </div>
         <div class="pic">
            <img class="imges" src="imges/img5.png" alt="img">
         </div>
      </div>
   </main>
   <section>
      <h1 class="serviceh">Our Services</h1>
      <div class="sectioncontainer">
         <div class="services">
            <figure>
               <img class="serviceimges" src="imges/img11.png" alt="Design">
               <figcaption>Design</figcaption>
            </figure>
            <p class="servicep">Designing your E-<br>commerce website</p>
         </div>
         <div class="services">
            <figure>
               <img class="serviceimges" src="imges/img10.png" alt="Report">
               <figcaption>Report</figcaption>
            </figure>
            <p class="servicep">Proving you with<br>reports about your<br>business</p>
         </div>
         <div class="services">
            <figure>
               <img class="serviceimges" src="imges/img9.png" alt="consultancy">
               <figcaption>consultancy</figcaption>
            </figure>
            <p class="servicep">Assisting you in<br>making the right<br>decision for your<br>business</p>
         </div>
      </div>
   </section>
   <article>
      <h1 class="articleh">Why Choose Us?</h1>
      <p class="articlep">Choosing us means more than just getting a website. You will get a partner whose<br>
         mission is to make your business shine online at an affordable price.<br><br>
         We ensure excellence through the latest technology, sleek design, and fast<br>performance. In short, you chose us because you want more than a website; you want<br>
         an experienced digital partner who will work for your interests.</p>
   </article>
   <summary>
      <h1 class="summaryh">Dream it? We build it!</h1>
      <p class="summaryp">Let us build your website layout and content based on your industry</p>
      <div class="summarycontainer">
         <div class="summarydiv">
            <figure>
               <img class="summaryimges" src="imges/img18.png" alt="set">
               <figcaption>set</figcaption>
            </figure>
            <p class="summaryp2">Yor business</p>
         </div>
         <div class="summarydiv">
            <figure>
               <img class="summaryimges" src="imges/img19.png" alt="add">
               <figcaption>Add</figcaption>
            </figure>
            <p class="summaryp2">Your logo</p>
         </div>
         <div class="summarydiv">
            <figure>
               <img class="summaryimges" src="imges/img20.png" alt="Select">
               <figcaption>Select</figcaption>
            </figure>
            <p class="summaryp2">additional features</p>
         </div>
         <div class="summarydiv">
            <figure>
               <img class="summaryimges" src="imges/img21.png" alt="Choose">
               <figcaption>Choose</figcaption>
            </figure>
            <p class="summaryp2">Your favorite theme</p>
         </div>
      </div>
   </summary>
</div>
<footer class="footer">
   <div class="footercontainer">
      <div class="row">
         <div class="footer-col">
            <h4>company</h4>
            <ul>
               <li><a href="#">about us</a></li>
               <li><a href="#">our services</a></li>
               <li><a href="#">privacy policy</a></li>
            </ul>
         </div>
         <div class="footer-col">
            <h4>get help</h4>
            <ul>
               <li><a href="fqa.html">FAQ</a></li>
               <li><a href="#">shipping</a></li>
               <li><a href="#">payment options</a></li>
            </ul>
         </div>
         <div class="footer-col">
            <h4>Customers</h4>
            <ul>
               <li><a href="#">Case Studies</a></li>
               <li><a href="#">Store Examples</a></li>
            </ul>
         </div>
         <div class="footer-col">
            <h4>follow us</h4>
            <div class="social-links">
               <a href="#"><i class="fab fa-facebook-f"></i></a>
               <a href="#"><i class="fab fa-x-twitter"></i>𝕏</a>
               <a href="#"><i class="fab fa-instagram"></i></a>
               <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
         </div>
      </div>
   </div>
</footer>


 
 
<script src="js/home.js"></script>
</body>
</html>
