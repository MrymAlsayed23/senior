<?php
require_once('db.inc.php');

$isFullList = true;

//This can be split into two separate pages.
if(isset($_GET['sid']) && ctype_digit($_GET['sid'])){
  //details
  $isFullList = false;
  $sid = intval($_GET['sid']);
  $strSQL = "SELECT * FROM business WHERE bid=?";
  $prepared = $conn->prepare($strSQL);
  $prepared->execute(array($sid));
}else{
  //full list
  $strSQL = "SELECT * FROM business";
  $prepared = $conn->prepare($strSQL);
  $prepared->execute(array());
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Detail</title>
  <link rel="stylesheet" href="css/details.css">

</head>
<body>
  <main>
    <?php
      if($prepared->rowCount() == 1){
        $row = $prepared->fetch();
        $imageData = base64_encode($row[ 'blogo']);
        $imagesrc = 'data: image/jpeg;base64,' . $imageData;
        echo '<nav> <h1>' . $row['bname'] .'</h1>  </nav>';
        ?>
        <div class="poster">
        <img class="rounded-0"   style="width:230px" value="<?php echo $row['bid'] ?>" src="<?php echo $imagesrc ?>"  alt="<?php echo $row['bname'] ?>"></a>
        <?php
        echo '</div>';
        echo '<hr>';
        
        echo '<article>';
        
        echo '<table>';
        echo '<tr>';
        echo '<th> category: </th>';
        echo '<td>' . $row['category'] . '</td>';
        echo '</tr>';
        echo '</table>';
        echo '<p class="desc">' . $row['bdetail'] . '</p>';
        echo '</article>';
      }
      else{
        echo '<p>No movie match available.</p>';
      }
      ?>

        <hr>
        <a href="dashboard.php">&#8249;</a>



      </main>




</body>
</html>
