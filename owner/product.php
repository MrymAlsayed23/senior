<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>New Product</title>
    </head>
    <style>
        
    </style>
    <body>

        <!-- nav  -->
        <?php include("../owner/ownerNavBar.php"); ?>

        <div class="container">
            <form method="POST" name="Form" action="">
                <h2>New Product</h2>
                
                <table>
                    <div class="mb-3">
                        <label for="pname" class="form-label">Product Name</label>
                        <input type="email" name="pname" class="form-control" id="pname">
                    </div>

                    <div class="mb-3">
                        <label for="BrandName" class="form-label">Brand Name</label>
                        <input type="text" name="BrandName" class="form-control" id="BrandName">
                    </div>

                    <div class="mb-3">
                        <label for="BrandName" class="form-label">Brand Name</label>
                        <input type="text" name="BrandName" class="form-control" id="BrandName">
                    </div>

                    <div class="mb-3">
                        <label for="pquantity" class="form-label">Quantity</label>
                        <input type="number" name="pquantity" class="form-control" id="pquantity">
                    </div>

                    <div class="mb-3">
                        <label for="Details" class="form-label">Details</label>
                        <textarea name="Details" id="" cols="3" rows="3" placeholder="Details" class="form-control" id="Details"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="pType" class="form-label">Product Type</label>
                        <input type="text" name="pType" class="form-control" id="pType">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>

                    <div class="mb-3">
                        <label for="sellPrice" class="form-label">Sell Price</label>
                        <input type="number" name="sellPrice" class="form-control" id="sellPrice">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                        <button type="submit" class="btn btn-primary" name="saveAnother">Save and Add Another </button>
                    </div>
                
                
                    <!-- <tr>
                        <td>

                            <input type="submit" name="save" id="" value="Save">
                            <input type="submit" name="saveAnother" id="" value="Save and Add Another">

                        </td>
                    </tr> -->
            </form>

        </div>
        
        <?php
        extract($_POST);

        if (isset($save) || isset($saveAnother)) {
            try {
                require('../connection.php');
                $db->beginTransaction();
                $stmt = $db->prepare("insert into products (pname, BrandName, Details, sellPrice, pquantity, image, pType) values (:pname, :BrandName, :Unit, :Details, :sellPrice, :pquantity, :image, :pType)");
            
                $stmt->bindParam(':pname', $pname);
                $stmt->bindParam(':BrandName', $BrandName);
                $stmt->bindParam(':Details', $Details);
                $stmt->bindParam(':sellPrice', $sellPrice);
                $stmt->bindParam(':pquantity', $pquantity);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':pType', $pType);


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
