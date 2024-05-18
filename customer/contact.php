

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Contact Us</title>
    </head>

    <body>

        <div class="container-fluid">

            <!-- nav  -->
            <?php include("../customer/customerNavBar.php"); ?>
            
            <?php

            //modified
                try {
                    require('../connection.php'); 
                    $bid = $_GET['bid'];
                    $sql = "SELECT * FROM business WHERE bid = $bid";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $ownerID = $result['bownerid'];
                    // echo $ownerID;
                    $sql2 = "SELECT email FROM users WHERE uid = $ownerID";
                    $stmt2 = $db->query($sql2);
                    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
               
            ?>
            
            <div class="m-5">
                <h1>Contact Us</h1>
                <?php ?>
                <h4>Email: <?php echo $result2['email'];  ?></h4>
                <p>We would love to hear from you! Feel free to reach out to us with any questions, inquiries, or collaboration opportunities.
                </p>
                <a href="mailto:<?php echo $result2['email']; ?>">Send an E-mail</a>
            </div>
<?php 
 } catch (PDOException $e) {
    die("Error occurred: " . $e->getMessage());
}

?>
        </div>

        <!-- footer  -->
        <?php include("../customer/footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
