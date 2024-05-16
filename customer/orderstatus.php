<?php
// try {
  session_start();
  if (isset($_SESSION["uid"])){
    $bid = $_GET['bid'];
     
  if (isset($_SESSION['message'])) {
    echo '<script type="text/javascript">';
    echo ' alert("Your order has been issued!")';
    echo '</script>';
    unset($_SESSION['message']);
  }
  date_default_timezone_set("Asia/Bahrain");
  // if (!isset($_SESSION['username'])) {
  //   header("Location:login.php");
  //   exit(0);
  // }
  // Set the "cart" cookie
//   $cookievalue = []; // Assuming you have an array of values to set as the cookie value
//   setcookie("cart", json_encode($cookievalue), time() + (86400 * 7));

//   if (isset($_POST['reorder'])) {
//     extract($_POST);
//     //$cookievalue = []; // Initialize $cookievalue as an empty array
//     if (isset($_COOKIE['cart'])) {
//       $previousdetails = (array) json_decode($_COOKIE['cart'], true);
//       foreach ($previousdetails as $details) {
//         $cookievalue[] = $details;
//       }
//     }
//     foreach ($p as $product => $productName) {
//       $proId = $productName;
//       $details['productId'] = $proId;
//       $cookievalue[] = $details;
//     }
//     //setcookie("cart", json_encode($cookievalue), time()+(86400*7));
//     header("Location:cart.php?bid=".$bid);
//   }
// } //end try (try tag at the beginning on the page)
// catch (PDOException $e) {
//   echo "Failed";
// }
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Order Status</title>
  </head>
  <style>
    .container-fluid {
      text-align: center;
    }
  </style>

  <body>
    
    <!-- Nav Bar  -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="customerHome.php">
                            <img src="../Images/Logo.jpg" alt="Logo" width="230" height="70">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="customerHome.php">Home</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Business
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <?php
                                                    try{
                                                        require('../connection.php');
                                                        $sql = "SELECT bname, bid FROM business";
                                                        $stmt = $db->query($sql); 
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($results as $row) {
                                                            echo "<li><a class='dropdown-item' href ='customerHome.php?bid=".$row['bid']."'>".$row['bname']."</a></li>";
                                                        }
                                                    }
                                                    catch (PDOException $e) {
                                                        echo "Error: " . $e->getMessage();
                                                }
                                                ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li> 


                                <li class="nav-item">
                                    <a class="nav-link" href="menu.php?bid=<?php echo $bid;?>">Menu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="cart.php?bid=<?php echo $bid;?>">Cart</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="orderstatus.php?bid=<?php echo $bid;?>">Order Status</a>
                                </li>

                            
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Profile
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                

      <div class="container-fluid">

        <!-- <h1>Your Orders</h1> -->

        <div class="mt-5">
          <div class="container">

          <center><h2>My Orders</h2></center>
          <table class="table table-sm"style="margin:4rem">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Status</th>
              <th>Total</th>
              <th></th>
              <th>Order Summary</th>
              <th>Date/Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
                try {
                  require('../connection.php');
                  $sql = "SELECT * FROM orders WHERE uid=".$_SESSION['uid']." AND bid=$bid";
                //    $sql1 = $db->prepare("SELECT * FROM order_items WHERE uid=".$_SESSION['uid']."");
                //    $sql1->execute();
                //    $r = $sql1->fetch();
                //    if ($r>0){
                //    $id = $r['pid'];
                //    //echo $id;
                //    $sql2  = $db->prepare("SELECT * FROM products WHERE pid =$id");
                //    $sql2->execute();
                //    $rs = $sql2->fetch();
                //  }
                  $row = $db->query($sql);
                  $c=0;
                  while ($rows = $row->fetch(PDO::FETCH_ASSOC)){
                      ++$c;
                    if ($c>0){
                  ?>
            <tr>
              <td><?php echo $c; ?></td>
              
              <td><?php echo $rows['ostatus']; ?></td>
              <td> <?php echo $rows['total'];  ?> 
              </td>
              <td>
                <?php
                if ($rows['ostatus'] == 'Completed'){
                    ?>
                    <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                  <?php } ?>
              </td>


              <td>  <a href="order.php?oid=<?php echo $rows['oid'];?>&bid=<?php echo $bid; ?>" class="btn btn-primary">more</a>   </td>
              <td><?php echo $rows['time']; ?></td>
            </tr>
            <!-- <tr>
              <td colspan="2" style="text-align: left; padding-left:4rem;font-weight:bold">Total</td>
              <td style="font-weight:bold"><?php echo $rows['total']."BHD"; ?></td>
            </tr> -->
          <?php }
          else {echo "<center><h1>You have no order yet!</h1></center>";}
        }
    }
        catch (PDOException $e) {
              die ("Error occured: ".$e->getMessage());
            }
        ?>
          </tbody>
        </table>
      </div>
        </div>
      </div> <!--end div container-->

        <div id="review_modal" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Submit Review</h5>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                      <!-- <span aria-hidden="true">&times;</span> -->
                  <!-- </button> -->
                </div>
                <div class="modal-body">
                  <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                          <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                          <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                          <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                          <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                  </h4>
                  <div class="form-group text-center mt-4">
                    <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                  </div>
                </div>
            </div>
          </div>
      </div>


      <!-- footer  -->
      <?php include ("../customer/footer.php"); ?>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    </body>

</html>


<script>
$(document).ready(function() {
    var rating_data = 0;

    $('#add_review').click(function() {
        $('#review_modal').modal('show');
    });

    $(document).on('mouseenter', '.submit_star', function() {
        var rating = $(this).data('rating');
        reset_background();
        for (var count = 1; count <= rating; count++) {
            $('#submit_star_' + count).addClass('text-warning');
        }
    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {
            $('#submit_star_' + count).addClass('star-light');
            $('#submit_star_' + count).removeClass('text-warning');
        }
    }

    $(document).on('mouseleave', '.submit_star', function() {
        reset_background();
        for (var count = 1; count <= rating_data; count++) {
            $('#submit_star_' + count).removeClass('star-light');
            $('#submit_star_' + count).addClass('text-warning');
        }
    });

    $(document).on('click', '.submit_star', function() {
        rating_data = $(this).data('rating');
    });

    $(document).on('click', '#save_review', function() {
        var params = new URLSearchParams(window.location.search);
        var bid = params.get('bid');
        var uid = "<?php echo $_SESSION['uid']; ?>";
        console.log(uid);
        console.log(bid);
        console.log(rating_data);
        $.ajax({
            type: "post",
            url: "submit_rating.php",
            data: {
                'submit': true,
                'rating_data': rating_data,
                'bid': bid,
                'uid': uid
            },
            success: function(data) {
                $('#review_modal').modal('hide');
                // Do other actions if needed
            }
        });
    });
});

    //     load_rating_data();


    // function load_rating_data(){
    //     $.ajax({
    //         url:"submit_rating.php",
    //         method:"POST",
    //         data:{action:'load_data'},
    //         dataType:"JSON",
    //         success:function(data){
    //             $('#average_rating').text(data.average_rating);
    //             $('#total_review').text(data.total_review);
        
    //             var count_star = 0;
        
    //             $('.main_star').each(function(){
    //                 count_star++;
    //                 if(Math.ceil(data.average_rating) >= count_star)
    //                 {
    //                     $(this).addClass('text-warning');
    //                     $(this).addClass('star-light');
    //                 }
    //             });
        
    //             $('#total_five_star_review').text(data.five_star_review);
        
    //             $('#total_four_star_review').text(data.four_star_review);
        
    //             $('#total_three_star_review').text(data.three_star_review);
        
    //             $('#total_two_star_review').text(data.two_star_review);
        
    //             $('#total_one_star_review').text(data.one_star_review);
        
    //             $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');
        
    //             $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');
        
    //             $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');
        
    //             $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');
        
    //             $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');
        
    //             if(data.review_data.length > 0)
    //             {
    //                 var html = '';
        
    //                 for(var count = 0; count < data.review_data.length; count++)
    //                 {
    //                     html += '<div class="row mb-3">';
        
    //                     html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';
        
    //                     html += '<div class="col-sm-11">';
        
    //                     html += '<div class="card">';
        
    //                     html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';
        
    //                     html += '<div class="card-body">';
        
    //                     for(var star = 1; star <= 5; star++)
    //                     {
    //                         var class_name = '';
        
    //                         if(data.review_data[count].rating >= star)
    //                         {
    //                             class_name = 'text-warning';
    //                         }
    //                         else
    //                         {
    //                             class_name = 'star-light';
    //                         }
        
    //                         html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
    //                     }
        
    //                     html += '<br />';
        
    //                     html += data.review_data[count].user_review;
        
    //                     html += '</div>';
        
    //                     html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';
        
    //                     html += '</div>';
        
    //                     html += '</div>';
        
    //                     html += '</div>';
    //                 }
        
    //                 $('#review_content').html(html);
    //             }
    //     }
    // })
    // }
    

    
    
</script>
<?php }?>