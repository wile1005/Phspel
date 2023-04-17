<?php
    function update_database($map,$playerX,$playerY,$inventory,$num,$background,$current_floor,$craftmode)
    {
        include "Database/Database_login.php";

        //updaterar spelar positionen
        $sql = "UPDATE `player` SET `playerY` = '".$playerY."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);
        $sql = "UPDATE `player` SET `playerX` = '".$playerX."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);
        $sql = "UPDATE `player` SET `floor` = '".$current_floor."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        //updaterar spelarens inventory,craftmode och num
        $sql = "UPDATE `player` SET `inventory` = '".json_encode($inventory)."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);
        $sql = "UPDATE `player` SET `num` = '".$num."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);
        $sql = "UPDATE `player` SET `craftmode` = '".$craftmode."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        //updaterar kartan
        $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = ".$current_floor.";";
        $result = $conn->query($sql);
    }
?>