<?php
    include "Database/database_login.php";
    session_start();

    $playerY = 5;
    $playerX = 5;
    $holding = "";
    $num = 0;
    $current_floor = 1;
    $inventory = array();

    $sql = "SELECT `id` FROM `player`;";
    $result = $conn->query($sql);

    if ($updateResult === false) 
    {
        echo "Error: " . mysqli_error($conn);
    }
    
    $sql = "UPDATE `player` SET 
    `playerY` = '".$playerY."', 
    `playerX` = '".$playerX."', 
    `floor` = '".$current_floor."', 
    `inventory` = '".$num."', 
    `holding` = '".$holding."', 
    `inventory` = '".json_encode($inventory)."' 
    WHERE `player`.`id` = ".$_SESSION["id"].";";
    $updateResult = $conn->query($sql);
    if ($updateResult === false) 
    {
        echo "Error: " . mysqli_error($conn);
    }
    header("location:phspel.php");
?>