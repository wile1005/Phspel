<?php
    function update_player($map,$playerX,$playerY,$inventory,$num,$current_floor,$craftmode,$holding)
    {
        include "Database/Database_login.php";

        //updaterar spelar positionen
        $sql = "UPDATE `player` SET 
        `playerY` = '".$playerY."', 
        `playerX` = '".$playerX."', 
        `floor` = '".$current_floor."' 
        WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        //updaterar spelarens inventory,craftmode och num
        $sql = "UPDATE `player` SET 
        `inventory` = '".json_encode($inventory)."',
        `num` = '".$num."',
        `holding` = '".$holding."',
        `craftmode` = '".$craftmode."'
        WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);
    }

    function update_map($map,$background,$current_floor)
    {
        include "Database/Database_login.php";

        //updaterar kartan
        $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = ".$current_floor.";";
        $result = $conn->query($sql);
        $sql = "UPDATE `world` SET `background` = '".json_encode($background)."' WHERE `world`.`id` = ".$current_floor.";";
        $result = $conn->query($sql);
    }
?>