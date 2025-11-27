<?php
    $servername = "localhost";
    $username   = "root";
    $password   = "root";
    $dbname     = "user_registration";

    $connection = mysqli_connect($servername,$username,$password,$dbname);
    if($connection)
    {
        //echo "Connection success";
    }
    else
    {
        echo "Connection failed".mysqli_connect_error();
    }
?>