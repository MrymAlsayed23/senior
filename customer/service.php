<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Services</title>
    </head>
    <style>
     
    </style>
    <body>
            <!-- nav  -->
            <?php include("../customer/customerNavBar.php"); ?>

            <div class="container-fluid">

            <h1>Our Services</h1>

            <ol>
                <?php
                    try{
                        require('../connection.php');
                        $sql = "SELECT bname FROM business";
                        $stmt = $db->query($sql); 
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($results as $row) {
                            echo "<li>".$row['bname']."</li><br>";
                        }
                    }
                    catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>
            </ol>

        </div>
        
         <!-- footer  -->
         <?php include("../customer/footer.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>