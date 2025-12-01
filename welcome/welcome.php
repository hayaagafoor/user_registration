<?php
    session_start();
    include("../db/connection.php");

    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header('Location: ../login/login.php');
        exit();
    }

    $email = $_SESSION['username'];

    // Fetch name from database
    $query = "SELECT name FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    $name = "User";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>
    <div class="welcome-container">
        <h2>Hi, <?php echo htmlspecialchars($name); ?> 👋</h2>
        <form action="../logout/logout.php" method="POST" style="margin-top: 20px;">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>