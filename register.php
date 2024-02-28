<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
</head>
<style>
    body{
        margin-left: 300px;
        margin-right: 300px;
    }
    .container{
        text-align:left; 
        margin: 200px;        
        border: solid 1px black;
        border-radius: 25px;
        padding: 50px;
    }

    h1{
        text-align: left;
    }
</style>
<body>

    <?php
    try {
        require('connection.php');
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
                $emailReg = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/'; //Email - Must have an @
                if (!preg_match($firstnameReg, $firstname))
                    echo "First Name must start with a captial letter and must not include any special characters";
                if (!preg_match($lastnameReg, $lastname))
                    echo "Last Name must start with a captial letter and must not include any special characters";
                else if (!preg_match($usernameReg, $username))
                    echo "Username must be at least 4 characters long and must not include any special characters other than _ or . or -";
                else if (!preg_match($passwordReg, $password))
                    echo "Password must start with a capital letter, at least a characters after it, end with a special character (!@#$%^&*_+.?)";
                else if ($password != $rpassword)
                    echo "The passwords is not match.";
                else if (!preg_match($phoneReg, $phone))
                    echo "Phone number must not begin with the country code, must start with either: 3 or 6 or 17 with at most 8 more numbers";
                else if (!preg_match($emailReg, $email))
                    echo "Please enter a valid email contain @";
                else {
                    $hpassword = md5($password);
                    $user = $username;

                    $db->beginTransaction();
                    $stmt = $db->prepare("INSERT INTO users (Fname, Lname, username, password, phone, email) VALUES (:Fname, :Lname, :username, :password, :phone, :email)");


                    $stmt->bindParam(':Fname', $firstname);
                    $stmt->bindParam(':Lname', $lastname);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $hpassword);
                    $stmt->bindParam(':phone', $phone);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    $row = $db->query("Select uid from users where username='$username'");
                    foreach ($row as $r)
                        $userid = $r[0];


                        $stmt2 = $db->prepare("INSERT INTO profile (userId, Fname, Lname, phone, email) values (:userId, :Fname, :Lname, :Phone, :Email)");
                        $stmt2->bindParam(':userId', $userid);
                        $stmt2->bindParam(':Fname', $firstname);
                        $stmt2->bindParam(':Lname', $lastname);
                        $stmt2->bindParam(':Phone', $phone);
                        $stmt2->bindParam(':Email', $email);
                        $stmt2->execute();

                    $r = $db->commit();

                    if ($r == 1) {
                        $_SESSION['uid'] = $userid;
                        $_SESSION['fname'] = $firstname;
                        $_SESSION['lname'] = $lastname;
                        $_SESSION['username'] = $user;
                        $_SESSION['phone'] = $phone;
                        $_SESSION['email'] = $email;
                        header("location:Home.php");
                    }
                    $db = null;
                }
            }
        }
    } catch (PDOException $ex) {
        echo "Error: ".$ex->getMessage();
    }
    ?>
    <html>

    <body>
        <div class='container'>
            <h1>Sign Up</h1>
            <form method="POST" name="Form" onsubmit="validateform()">

                <label for='firstname'>First Name:</label>
                <input type='text' id='firstname' name='firstname' placeholder='Enter First Name' />
                <br><br>
                <label for='lastname'>Last Name:</label>
                <input type='text' id='lastname' name='lastname' placeholder='Enter Last Name' />
                <br><br>
                <label for='username'>Username:</label>
                <input type='text' id='username' name='username' placeholder='Enter Username' onkeyup="" />

                <h6>Please Enter a Password that starts with a capital letter, followed by a character, more non-special characters and ends with a special character.</h6>
                <label for='password'>Password:</label>
                <input type='password' id='pass' name='password' onkeyup="" />
                <br>
                <label for='rpassword'>Repeat Password:</label>
                <input type='password' id='rpassword' name='rpassword' />
                <br><br>
                <label for='Phone'>Phone:</label>
                <input type='text' id='phone' name='phone' />
                <br><br>
                <label for='email'>Email</label>
                <input type='text' id='email' name='email' />
                <br><br>
                <button>
                    <input type="submit" name="register" value="Register">
                </button>
            </form>
            <p>Already have an account <a href="Login.php">Click Here!</a> </p>
        </div>

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
    </body>
    </html>