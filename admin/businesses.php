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
                   <ul>
                      <li><a href="#"><i style="font-size:24px" class="fa">&#xf0a2;</i></a></li>
                      <li><a href="#"><i style="font-size:24px" class="fa">&#xf003;</i></a></li>
                      <li><a class="adminicon" href="#"><i style="font-size:24px" class="fa">&#xf2bd;</i> | Admin Name</a></li>
                   </ul>
                </nav>
            </div>
        </div>
     </header>
     <h1>All Businesses</h1>
    <div class="containerr">
        <main>
            <ul>
                <li class="mainli"><a style="color: #aaaaaa" href="dashbord.php"><i style="font-size:24px" class="fa">&#xf015;</i>   Dashboard</a></li>
                <li class="mainli"><a style="color: #454545" class="maina" href="businesses.php"><i style="font-size:24px" class="fa">&#xf0c0;</i>  Businesses</a></li>
                <li class="mainli"><a class="maina" href="message.php"><i style="font-size:24px" class="fa">&#xf075;</i>  Messages</a></li>
                <li class="mainli"><a class="maina" href="#"><i style="font-size:24px" class="fa">&#xf2d2;</i>  Categories</a></li>
              </ul><br>
        </main>
        <article>
            <?php
                require_once('db.inc.php');

                $isFullList = true;


                if(isset($_GET['sid']) && ctype_digit($_GET['sid'])){
                    //details
                    $isFullList = false;
                    $sid = intval($_GET['sid']);
                    $strSQL = "SELECT * FROM businesses WHERE id=?";
                    $prepared = $conn->prepare($strSQL);
                    $prepared->execute(array($sid));

                }
                else{

                    $strSQL = "SELECT * FROM businesses";
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

            ?>
                <div class="cards">
                  <div class= "image">
                    <a href="#"><img class="rounded-0" value="<?php echo $row['id'] ?>" src="<?php echo $row['logo'] ?>"  alt="<?php echo $row['name'] ?>"></a>
                    <div class="img-overlay">
                      <div class="img-title" value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></div>
                      <p class="img-descriptio" value="<?php echo $row['id'] ?>"><?php echo $row['category'] ?></p>
                      <?php
                      echo '<a class="info" href="details.php?sid=' . $row['id'] . '">';
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
    </div>
</body>
</html>