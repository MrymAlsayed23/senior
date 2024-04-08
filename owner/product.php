<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>New Product</title>
</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="/senior/Images/Logo.jpg" alt="Logo" width="30" height="24">
        </a>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Login.php">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </nav>

    <form method="POST" name="Form" action="">
        <h2>New Product</h2>
        <hr>
        <table>
            <tr>
                <td>
                    <label for="">Product Name</label>
                    <input type="text" name="pname">
                </td>
                <td>
                    <label for="">Brand Name</label>
                    <input type="text" name="BrandName">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Unit</label>
                    <input type="text" name="Unit">
                </td>
                <td>
                    <label for="">Quantity</label>
                    <input type="number" name="pquantity" min=1>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Details</label>
                    <textarea name="Details" id="" cols="30" rows="5" placeholder="Details"></textarea>
                </td>
                <td>
                    <label for="">Product Type</label>
                    <select name="pType" id="">
                        <option value="test">test</option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="image">Image</label>
                    <input type="file" name="image">
                </td>

                <td>
                    <label for="">Category</label>
                    <select name="category" id="">
                        <option value="Books">Books</option>
                        <option value="Hand Made">Hand Made</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Clothes">Clothes</option>
                        <option value="Bags">Bags</option>
                        <option value="Gaming Merchandise">Gaming Merchandise</option>
                        <option value="Sports Equipment and Apparel">Sports Equipment and Apparel</option>
                    </select>
                </td>
            </tr>

            <tr>
                
                <td>
                    <label for="">Sell Price</label>
                    <input type="number" name="sellPrice" id="">
                </td>
            </tr>

          
        
            <tr>
                <td>

                    <input type="submit" name="save" id="" value="Save">
                    <input type="submit" name="saveAnother" id="" value="Save and Add Another">

                </td>
            </tr>

        </table>
    </form>

    <?php
    extract($_POST);

   
    

    if (isset($save) || isset($saveAnother)) {
        try {
            require('../connection.php');
            $db->beginTransaction();
            $stmt = $db->prepare("insert into products (pname, BrandName, Unit, Details, sellPrice, pquantity, image, pType, category) values (:pname, :BrandName, :Unit, :Details, :sellPrice, :pquantity, :image, :pType, :category)");
           
            $stmt->bindParam(':pname', $pname);
            $stmt->bindParam(':BrandName', $BrandName);
            $stmt->bindParam(':Unit', $Unit);
            $stmt->bindParam(':Details', $Details);
            $stmt->bindParam(':sellPrice', $sellPrice);
            $stmt->bindParam(':pquantity', $pquantity);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':pType', $pType);
            $stmt->bindParam(':category', $category);


            $r = $stmt->execute();
            if ($r == 1) {
    ?>
                <div class="alert a-cont " role="alert">
                    <div class="modal-body">
                        <script>
                            alert("New Product has been inserted successfully");
                        </script>                    
                    </div>
                </div>

    <?php
            } else {
                throw new PDOException("Error");
            }

            $db->commit();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    ob_end_flush();
    ?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
