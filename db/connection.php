<?php
    $servername = "localhost";
    $username   = "root";
    $password   = "root";
    $dbname     = "user_registration";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    try {
        $connection = new mysqli($servername, $username, $password, $dbname);
        // Set charset
        $connection->set_charset("utf8");

        // Connection successful
        // echo "Connection success";

    } catch (mysqli_sql_exception $e) {
        // Handle connection error
        die("Connection failed: " . $e->getMessage());
    }
?>