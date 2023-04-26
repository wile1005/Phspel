<?php
    function update_player($map,$playerX,$playerY,$inventory,$num,$current_floor,$craftmode)
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
    }
?>