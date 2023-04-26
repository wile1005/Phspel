<?php
    function get_player_variables(&$current_floor,&$playerX,&$playerY,&$num,&$craftmode,&$inventory)
    {
        include "Database/Database_login.php";

        //hämtar player variabler (playerX, playerY, inventory från player)
        $sql = "SELECT `id`,`playerX`,`playerY`,`floor`,`inventory`,`num`,`craftmode` FROM `player` WHERE `player`.`id` = ".$_SESSION["id"]."";
        $result = $conn->query($sql);
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        $current_floor = $row["floor"];
        $playerX = $row["playerX"];
        $playerY = $row["playerY"];
        $num = $row["num"];
        $craftmode = $row["craftmode"];
        $inventory = json_decode($row["inventory"]);
    }
?>