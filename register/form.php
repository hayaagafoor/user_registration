<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <script src="form.js"></script>
    <title>Register Page</title>
</head>

<body>
    <div class="register-container">
        <h1>Register Page</h1>
        <form class="form" action="#" method="POST">
            <div class="input-field">
                <label for="name">Name</label>
                <input type="text" id="name" class="input" name="name">
                <small class="error" id="nameError"></small>
            </div>

            <div class="input-field">
                <label for="phone">Phone</label>
                <input type="text" id="phone" class="input" name="phone">
                <small class="error" id="phoneError"></small>
            </div>

            <div class="input-field">
                <label for="email">Email</label>
                <input type="text" id="email" class="input" name="email">
                <small class="error" id="emailError"></small>
            </div>

            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" class="input" name="password">
            </div>

            <div class="input-field">
                <label for="confirm">Confirm Password</label>
                <input type="password" id="cpassword" class="input" name="cpassword">
                <small class="error" id="passwordError"></small>
            </div>
            <div class="submit-form">
                <input type= "submit" class="input" value="Register" name="register">
            </div>
            <div class="login-link">
                Already a member? <a href="../login/login.php">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php
include("../db/connection.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['register'])) 
{
    try{
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if($name != "" && $phone != "" && $email !="" && $password != "" && $cpassword != "")
        {
            //check if email already exists
            $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >> 0)
            {
                echo "<script>alert('User already registered');</script>";
            }
            //after registering redirect to login page
            else{
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $connection->prepare(
                    "INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)"
                );
                $stmt->bind_param("ssss", $name, $phone, $email, $hashedPassword);
                if ($stmt->execute()) {
                    header("Location: ../login/login.php?msg=registered");
                    exit();
                } 
                else
                {
                    echo " Data insertion failed";
                }   
            }        
        }
        else
        {
            echo "Please fill the form";
        }
    }
    catch (mysqli_sql_exception $e) {
        // Catch any MySQLi errors
        echo "Database error: " . $e->getMessage();
    }
}
?>
