<?php
    function Stairs_check($map,$playerX,$playerY,&$current_floor)
    {
        //funkar inte(fixa senare)
        //kollar ifall spelaren står på en trappa ner eller up
        if($map[$playerX][$playerY]==17)
        {
            $current_floor++;
            $playerX += rand(-1,1);
            $playerY += rand(-1,1);
        }elseif($map[$playerX][$playerY]==18)
        {
            $current_floor--;
            $playerX += rand(-1,1);
            $playerY += rand(-1,1);
        }
        get_map($map,$background,$current_floor);
        $sql = "UPDATE `player` SET `floor` = '".$current_floor."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        //updaterar kartan
        $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = ".$current_floor.";";
        $result = $conn->query($sql);
        //kollar ifall spelaren står på en trappa ner eller up
        if($map[$playerX][$playerY]==17)
        {
            $current_floor++;
            $playerX += rand(-1,1);
            $playerY += rand(-1,1);
            // hämtar mapen
            get_map($map,$background,$current_floor);

            update_database($map,$playerX,$playerY,$inventory,$num,$background,$current_floor,$craftmode);
        }elseif($map[$playerX][$playerY]==18)
        {
            $current_floor--;
            $playerX += rand(-1,1);
            $playerY += rand(-1,1);
            // hämtar mapen
            get_map($map,$background,$current_floor);

            update_database($map,$playerX,$playerY,$inventory,$num,$background,$current_floor,$craftmode);
        }
    }
?>