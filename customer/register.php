<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Register Page</title>
</head>
<style>
    h1 {
        text-align: left;
    }
</style>

<body>

    <!-- nav  -->
    <?php include("../customer/customerNavBar.php"); ?>


    <?php
    try {
        require('../connection.php');
        extract($_POST);
        if (isset($firstname)) {
            $exists = 0;
            $data = $db->query("select * from users")->fetchAll();
            foreach ($data as $row) {
                if ($username == $row[1]) {
                    echo "Username already exists.";
                    $exists = 1;
                }
            }


            if ($exists != 1) {
                //Regular expressions
                $firstnameReg = '/^[A-Z][a-z]{2,12}$/'; //First Name - must start with capital letter
                $lastnameReg = '/^[A-Z][a-z]{2,12}$/'; //Last Name - must start with capital letter
                $usernameReg = '/^[a-zA-Z0-9_.-]{4,20}$/'; //Username - must be at least 4 characters long and include these characters  _ or . or -
                $passwordReg = '/^([A-Z])[a-z0-9]{1,19}[!@#$%^&*_+.?]{1}$/'; //Password - must start with a capital letter, at least a characters after it, end with a special character (!@#$%^&*_+.?)
                $phoneReg = '/(^([36])[0-9]{7}$)|(^(17)[0-9]{6}$)/'; //Phone number - must not begin with country code, must start with either a 3 or a 6 or a 17 with at most 7 more numbers
                $emailReg = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-+_.]+\.[a-zA-Z.]{2,5}$/'; //Email - Must have an @
                if (!preg_match($firstnameReg, $firstname))
                    echo "<div class='alert alert-danger' role='alert'>First Name must start with a captial letter and must not include any special characters</div>";
                if (!preg_match($lastnameReg, $lastname))
                    echo "<div class='alert alert-danger' role='alert'>Last Name must start with a captial letter and must not include any special characters</div>";
                else if (!preg_match($usernameReg, $username))
                    echo "<div class='alert alert-danger' role='alert'>Username must be at least 4 characters long and must not include any special characters other than _ or . or -</div>";
                else if (!preg_match($passwordReg, $password))
                    echo "<div class='alert alert-danger' role='alert'>Password must start with a capital letter, at least a characters after it, end with a special character (!@#$%^&*_+.?)</div>";
                else if ($password != $rpassword)
                    echo "<div class='alert alert-danger' role='alert'>The passwords is not match.";
                else if (!preg_match($phoneReg, $phone))
                    echo "<div class='alert alert-danger' role='alert'>Phone number must not begin with the country code, must start with either: 3 or 6 or 17 with at most 8 more numbers</div>";
                else if (!preg_match($emailReg, $email))
                    echo "<div class='alert alert-danger' role='alert'>Please enter a valid email contain @</div>";
                else {
                    $hpassword = md5($password);
                    $user = $username;

                    $db->beginTransaction();
                    $stmt = $db->prepare("INSERT INTO users (Fname, Lname, username, password, phone, type, email) VALUES (:Fname, :Lname, :username, :password, :phone, :type, :email)");
                    $type = 'customer';

                    $stmt->bindParam(':Fname', $firstname);
                    $stmt->bindParam(':Lname', $lastname);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $hpassword);
                    $stmt->bindParam(':phone', $phone);
                    $stmt->bindParam(':type', $type);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    $row = $db->query("Select uid from users where username='$username'");
                    foreach ($row as $r)
                        $userid = $r[0];
                    // (profile field)(fields the same as in bindParam(here,)) 
                    $stmt2 = $db->prepare("INSERT INTO profile (userId, Fname, Lname, Phone, Email) values (:userId, :Fname, :Lname, :Phone, :Email)");
                    $stmt2->bindParam(':userId', $userid);
                    $stmt2->bindParam(':Fname', $firstname);
                    $stmt2->bindParam(':Lname', $lastname);
                    $stmt2->bindParam(':Phone', $phone);
                    $stmt2->bindParam(':Email', $email);
                    $stmt2->execute();

                    $r = $db->commit();

                    if ($r == 1) {
                        // inside [] the users field 
                        $_SESSION['status'] = 'Register';
                    }
                    $db = null;
                }
            } //end if
        } //end if
    } //end try
    catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
    ?>
    <div class="container">

        <h1>Register</h1>

        <form method="POST" name="Form" onsubmit="validateform()">

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder='Enter First Name'>
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder='Enter Last Name'>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder='Enter Username'>
                </div>

                <div class="col-lg-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="pass">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="rpassword" class="form-label">Repeat Password</label>
                    <input type="password" name="rpassword" class="form-control" id="rpassword">
                </div>


            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="Phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="Phone">
                </div>
            </div>


            <div class="row">

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox1" name="checkbox1">
                    <label class="form-check-label" for="checkbox1">Yes, I want to receive emails.</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox2" name="checkbox2">
                    <label class="form-check-label" for="checkbox2">I agree to all the <strong>Term</strong> and <strong>Privacy Policy</strong></label>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="register">Create Account</button>
            </div>

        </form>

        <p>Already have an account <a href="Login.php">Log in</a> </p>

    </div> <!--end fiv container-->

    <script>
        function validateform() {
            let counter = document.forms["Form"].elements.length;
            for (let i = 1; i < counter; i++) {
                var detail = document.forms["Form"].elements[i].value;
                if (detail == '') {
                    alert("Please make sure to fill the form.");
                    return false;
                }
            }
        }
    </script>
   

    <!-- footer  -->
    <?php include("../customer/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <?php if (isset($_SESSION['status'])) { ?>
        <script>
            Swal.fire({
                        text: "Successfuly Registered",
                        icon: "success",
                        showConfirmButton: false,
                      });
        </script>
        <?php } unset($_SESSION['status']); ?>
</body>

</html>
