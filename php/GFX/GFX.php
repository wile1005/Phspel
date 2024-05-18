<div id="GFX">
    <?php
        include "GFX_Player_image.php";
        include "../Database/Database_login.php";
        include "../../Assets/Tiles/Tiles.php";
        include "../../Assets/Tiles/Background_tiles.php";

        session_start();

        //hämtar spelar X och Y
        $sql = "SELECT `playerX`,`playerY`,`floor`,`craftmode`,`inventory`,`num`,`id` FROM `player` WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);
        if (!$result) 
        {
            echo "Error: " . mysqli_error($conn);
        } else 
        {
            $row = $result->fetch_assoc();
            $current_floor = $row["floor"];
            $playerX = $row["playerX"];
            $playerY = $row["playerY"];
            $craftmode = $row["craftmode"];
            $num = $row["num"];
            $inventory=json_decode($row["inventory"]);
        }
        //hämtar kartan och bakgrunden
        $sql = "SELECT `map`,`background`,`id` FROM `world` where `world`.`id` = ".$current_floor."";
        $result = $conn->query($sql);
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        $map = json_decode($row["map"]);
        $background_map = json_decode($row["background"]);
        

        //SPELARENS SYNFÄLLT
        $terrain = "<div id='terrain'>";
        $background = "<div id='background'>";

        //Grafikens höjd
        $viewheight = 8;
        for ($X=-($viewheight/2)+1+$playerX; $X < ($viewheight/2)+$playerX; $X++)
        {
            //Grafikens bred
            $viewwidth = 16;
            for ($Y=-($viewwidth/2)+1+$playerY; $Y < ($viewwidth/2)+$playerY; $Y++)
            {
                //ÄR SYNFÄLLT UTANFÖR ARRAY???
                if (isset($map[$X][$Y]))
                {
                    //kollar igenom alla spelare
                    $sql = "SELECT `playerX`,`playerY`,`craftmode`,`id`,`floor` FROM `player`;";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc())
                    {
                        $playerprint = false;
                        //om spelare finns på X oxh y cordinaten skriv ut spelaren
                        if ($row["playerX"]==(int)$X && $row["playerY"]==(int)$Y && $map[$X][$Y]!=8 && $row["floor"]==$current_floor)
                        {
                            $terrain .= Player_image($map, (int)$X, (int)$Y);
                            $background .= get_background_texture($background_tiles, $background_map[$X][$Y]);
                            $playerprint = true;
                            break;
                        }
                    }
                    if (!$playerprint)
                    {
                        $terrain .= get_terrain_texture($tiles, $map[$X][$Y]);
                        $background .= get_background_texture($background_tiles, $background_map[$X][$Y]);
                    }
                }else
                {
                    $terrain .= '<img src="../assets/images/background_tiles/air.png"/>';
                    $background .= '<img src="../assets/images/background_tiles/air.png"/>';
                }
            }
            $terrain.= "<br>";
            $background.= "<br>";
        }
        $sql = "UPDATE `player` SET `craftmode` = '".$craftmode."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        echo $terrain."</div>";
        echo $background."</div>";

        function get_terrain_texture($tiles, $tileId)
        {
            return '<img src="../assets/images/tiles/'.$tiles[$tileId]["texture"].'"/>';
        }
        function get_background_texture($tiles, $tileId)
        {
            return '<img src="../assets/images/background_tiles/'.$tiles[$tileId]["texture"].'"/>';
        }
    ?>
</div>