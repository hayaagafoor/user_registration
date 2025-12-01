<?php
    session_start();
    include("../db/connection.php");

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        header('Location: ../login/login.php');
        exit();
    }

    $email = $_SESSION['username'];
    $name = "User";

    try{
        // Fetch name from database
        $stmt = $connection->prepare("SELECT name FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
        }
    }
    catch (mysqli_sql_exception $e) {
        echo "Database error: " . $e->getMessage();
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