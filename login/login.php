<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <script src="login.js"></script>
    <title>Login Page</title>
</head>

<body>
    <div class="login-container">
        <h1>Login Page</h1>

        <form class="form" action="#" method="POST">

            <div class="input-field">
                <label for="email">Email</label>
                <input type="text" id="email" class="input" name="email">
            </div>

            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" class="input" name="password">
            </div>

            <div class="submit-form">
                <input type="submit" class="input" value="Login" name="login">
            </div>
            <div class="signup-link">
                New member? <a href="../register/form.php">Sign up here</a>
            </div>

        </form>
    </div>
</body>
</html>

<?php
include("../db/connection.php");

if (isset($_POST['login'])) 
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email != "" && $password != "")
    {
        $check = mysqli_query($connection, 
                "SELECT * FROM users WHERE email='$email' AND password='$password'");

        if (mysqli_num_rows($check) == 1)
        {
            $_SESSION['username']=$email;
            header("Location: ../welcome/welcome.php?email=$email");
            exit();
        }
        else
        {
            echo "<script>alert('Invalid email or password');</script>";
        }
    }
    else
    {
        echo "<script>alert('Please fill all fields');</script>";
    }
}
?>
