<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
</head>

<body>

    <form action="POST">
        <h2>New Product</h2>
        <hr>
        <table>
            <tr>
                <td>
                    <label for="">Barcode or QR-Code</label>
                    <input type="text" name="qrCode">
                </td>
                <td>
                    <label for="">Product Name</label>
                    <input type="text" name="pname">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Strength</label>
                    <input type="text" name="strength">
                </td>
                <td>
                    <label for="">Brand Name</label>
                    <input type="text"  name="BrandName">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Box Size</label>
                    <input type="number" name="boxSize">
                </td>
                <td>
                    <label for="">Unit</label>
                    <input type="text" name="Unit">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Product Shelf</label>
                    <input type="text" name="pShelf">
                </td>
                <td>
                    <label for="">Details</label>
                    <textarea name="Details" id="" cols="30" rows="5" placeholder="Details"></textarea>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Product Type</label>
                    <select name="pType" id="">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </td>
                <td>
                    <label for="image">Image</label>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Category</label>
                    <select name="category" id="">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </td>
                <td>
                    <label for="">Sell Price</label>
                    <input type="number" name="sellPrice" id="">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">Manufacture</label>
                    <select name="" id="">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </td>
                <td>
                    <label for="">Manufacture Price</label>
                    <input type="number" name="ManufacturePrice" id="">
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">+Add New Manufacture</a>
                </td>
            </tr>
            <tr>
                <td>

                    <input type="submit" name="save" id="" value="Save">
                    <input type="submit" name="SaveAnother" id="" value="Save and Add Another">

                </td>
            </tr>

        </table>
    </form>

    <?php
    extract($_POST);

    if (isset($save)) {
        try {
            require('connection.php');
            $db->beginTransaction();
            $stmt = $db->prepare("insert into products (qrCode, pname, BrandName, Unit, boxSize, Details, sellPrice, ManufacturePrice, pquantity, image, strength, pShelf, pType, category) values (:qrCode, :pname, :BrandName, :Unit, :boxSize, :Details, :sellPrice, :ManufacturePrice, :pquantity, :image, :strength, :pShelf, :pType, :category)");
           
            $stmt->bindParam(':qrCode', $qrCode);
            $stmt->bindParam(':pname', $pname);
            $stmt->bindParam(':BrandName', $BrandName);
            $stmt->bindParam(':Unit', $Unit);
            $stmt->bindParam(':boxSize', $boxSize);
            $stmt->bindParam(':Details', $Details);
            $stmt->bindParam(':sellPrice', $sellPrice);
            $stmt->bindParam(':ManufacturePrice', $ManufacturePrice);
            $stmt->bindParam(':pquantity', $pquantity);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':strength', $strength);
            $stmt->bindParam(':pShelf', $pShelf);
            $stmt->bindParam(':pType', $pType);
            $stmt->bindParam(':category', $category);
            

            $stmt->execute();
            $db->commit();

        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    ob_end_flush();
    ?>

</body>

</html>