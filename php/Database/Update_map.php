<?php
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