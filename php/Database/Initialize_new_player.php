<?php
    include "database_login.php";
    session_start();

    $playerY = 5;
    $playerX = 5;
    $num = 0;
    $inventory = array_fill(0,7,"null");

    $sql = "SELECT `id` FROM `player`;";
    $result = $conn->query($sql);

    if ($updateResult === false) 
    {
        echo "Error: " . mysqli_error($conn);
    }
    
    $sql = "UPDATE `player` SET `playerY` = '".$playerY."' WHERE `player`.`id` = ".$_SESSION["id"].";";
    $updateResult = $conn->query($sql);
    if ($updateResult === false) 
    {
        echo "Error: " . mysqli_error($conn);
    }

    $sql = "UPDATE `player` SET `playerX` = '".$playerX."' WHERE `player`.`id` = ".$_SESSION["id"].";";
    $updateResult = $conn->query($sql);
    if ($updateResult === false) 
    {
        echo "Error: " . mysqli_error($conn);
    }

    $sql = "UPDATE `player` SET `floor` = '1' WHERE `player`.`id` = ".$_SESSION["id"].";";
    $updateResult = $conn->query($sql);
    if ($updateResult === false) 
    {
        echo "Error: " . mysqli_error($conn);
    }
    
    $sql = "UPDATE `player` SET `inventory` = '".$num."' WHERE `player`.`id` = ".$_SESSION["id"].";";
    $updateResult = $conn->query($sql);
    if ($updateResult === false) 
    {
        echo "Error: " . mysqli_error($conn);
    }

    $sql = "UPDATE `player` SET `inventory` = '".json_encode($inventory)."' WHERE `player`.`id` = ".$_SESSION["id"].";";
    $updateResult = $conn->query($sql);
    if ($updateResult === false) 
    {
        echo "Error: " . mysqli_error($conn);
    }
    header("location:../phspel.php");
?>