<?php
    //bla bla bla loggin till mysql
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phspel";

    //connects to mysqli server
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>