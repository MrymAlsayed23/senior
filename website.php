<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Page</title>
    <script src="https://kit.fontawesome.com/0c44593f2b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"></span>
                        <span class="title">Project Name</span> <!--will take the value from the form that the user will add it.-->
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="add-outline"></ion-icon></span>
                        <span class="title">Adding Product</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <!-- <i class="bi bi-plus-square-dotted"></i> -->
                        <span class="icon"><ion-icon name="notifications-outline"></ion-icon></span>
                        <span class="title">Add page</span>
                    </a>
                </li>


                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div> <!--end of navigation-->

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <!-- search -->

                <div class="search">
                    <label for="">
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <!-- username -->

                <div class="user">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </div>
            </div>

            <form method="POST" action="website.php">
                <table>
                    <tr>
                        <td><label for="pname">Product Name:</label></td>
                        <td><input type="text" name=name></td>
                    </tr>

                    <tr>
                        <td><label for="pprice">Product Price</label></td>
                        <td><input type="number" name=price></td>
                    </tr>

                    <tr>
                        <td><label for="pquantity">Product Quantity:</label></td>
                        <td><input type="number" name=quantity></td>
                    </tr>

                    <tr>
                        <td><label for="p_pdate">Product Production Date:</label></td>
                        <td><input type="date" name=pdate></td>
                    </tr>

                    <tr>
                        <td><label for="">Product Expiry Date:</label></td>
                        <td><input type="date" name="edate"></td>
                    </tr>

                    <tr>
                        <td><label for="pcategory">Product Category:</label></td>
                        <td><input type="text" name="category"></td>
                    </tr>

                    <tr>
                        <td><label for="">Product Details:</label></td>
                        <td><input type="text" name=details></td>
                    </tr>

                    <tr>
                        <td><label for="ppicture">Product Picture:</label></td>
                        <div>
                            <img src="" alt="" id="image">
                            <td><input type="file" name="ppicture" id="picture"></td>
                        </div>
                    </tr>

                    <tr>
                        <td>
                            <button>
                                <input type="submit" name="uplode" value="Uplode">
                            </button>
                        </td>
                    </tr>



                </table>
            </form>


        </div> <!--end of main-->
    </div> <!--end of container-->


    <?php
        extract($_POST);
        if (isset($uplode)) {
        try {
            require('connection.php');
            $db->beginTransaction();
            $stmt = $db->prepare("insert into products (pname, pprice, pquantity, p_pdate, p_edate, pcategory, pdetails, ppicture) values (:pname, :pprice, :pquantity, :p_pdate, :p_edate, :pcategory, :pdetails, :ppicture)");
            //$type='customer';

            $stmt->bindParam(':pname', $pname);
            $stmt->bindParam(':pprice', $pprice);
            $stmt->bindParam(':pquantity', $pquantity);
            $stmt->bindParam(':p_pdate', $p_pdate);
            $stmt->bindParam(':p_edate', $p_edate);
            $stmt->bindParam(':pcategory', $pcategory);
            $stmt->bindParam(':pdetails', $pdetails);
            $stmt->bindParam(':ppicture', $ppicture);
            $stmt->execute();

            $r = $db->commit();
            echo "New Product has been inserted successfully.";
            //$db = null;
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
            echo "Please revise the information inserted";
        }
    } //end if
    ob_end_flush();
    ?>


    <!-- <script>
        var file = document.getElementById("picture");
        var picture = document.getElementById("image");
        file.addEventListener("change", (e) => {
            img.src = URL.createObjectURL(e.target.files[0])
        })
    </script> -->
</body>
</html>