<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="css/businesses.css">
    <title>Businesses</title>
</head>
<body>
    <header class="header">
        <div class="headercontainer">
            <div class="row align-items-center justify-content-between">
                <div class="logo">
                </div>
                <nav class="nav">
                </nav>
            </div>
        </div>
     </header>
     <div class="totaldiv">
                <?php
       
                    // localhost is localhost 
                    // servername is root 
                    // password is empty 
                    // database name is database 
                    $con = mysqli_connect("localhost","root","","senior"); 

                    // SQL query to display row count 
                    // in building table 
                    $sql = "SELECT * from business"; 

                    if ($result = mysqli_query($con, $sql)) { 

                    // Return the number of rows in result set 
   
                    $rowcount = mysqli_num_rows( $result ); 
   
                    // Display result 
                ?>
                <h1 class="total">All Business <?php echo $rowcount ?></h1>
                <?php
                    } 
       
                    // Close the connection 
                    mysqli_close($con); 

                ?> 
            </div>
        <article>
            <?php
                require_once('db.inc.php');

                $isFullList = true;


                if(isset($_GET['sid']) && ctype_digit($_GET['sid'])){
                    //details
                    $isFullList = false;
                    $sid = intval($_GET['sid']);
                    $strSQL = "SELECT * FROM business WHERE id=?";
                    $prepared = $conn->prepare($strSQL);
                    $prepared->execute(array($sid));

                }
                else{

                    $strSQL = "SELECT * FROM business";
                    $prepared = $conn->prepare($strSQL);
                    $prepared->execute(array());
    
    
                }


            ?>

            <section>
            <?php
                if($isFullList){

                 if($prepared->rowCount() > 0){
                    $prepared->setFetchMode(PDO::FETCH_ASSOC);
                    while($row= $prepared->fetch()){
                                                
                        $imageData = base64_encode($row[ 'blogo']);
                        $imagesrc = 'data: image/jpeg;base64,' . $imageData;
                        
            ?>
                <div class="cards">
                  <div class= "image">
                    <a href="#"><img class="rounded-0" value="<?php echo $row['bid'] ?>" src="<?php echo $imagesrc ?>"  alt="<?php echo $row['bname'] ?>"></a>
                    <div class="img-overlay">
                      <div class="img-title" value="<?php echo $row['bid'] ?>"><?php echo $row['bname'] ?></div>
                      <p class="img-descriptio" value="<?php echo $row['bid'] ?>"><?php echo $row['category'] ?></p>
                      <?php
                      echo '<a class="info" href="details.php?sid=' . $row['bid'] . '">';
                      echo 'More Info</a></p>';
                       ?>
                   </div>
                 </div>
              </div>
                <?php
                
                }
                }
                }
            ?>
            </section>
    </article>
</body>
</html>
