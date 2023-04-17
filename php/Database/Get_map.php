<?php
    function get_map(&$map,&$background,$current_floor)
    {
        include "Database/Database_login.php";

        // hämtar mapen
        $sql = "SELECT `map`,`background`,`id` FROM `world` where `world`.`id`=".$current_floor."";
        $result = $conn->query($sql);
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        if($current_floor==$row["id"])
        {
            $map = json_decode($row["map"]);
            $background = json_decode($row["background"]);
        }
    }
?>