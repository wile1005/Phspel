<div id="GFX">
    <?php
        include "GFX_Tile_image.php";
        include "GFX_Player_image.php";
        include "../Database/Database_login.php";

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
        if($current_floor==$row["id"])
        {
            $map = json_decode($row["map"]);
            $background = json_decode($row["background"]);
        }
        

        //SPELARENS SYNFÄLLT
        $output = "";

        //Grafikens höjd
        for ($X=-3+$playerX; $X < 4+$playerX; $X++)
        {
            //Grafikens bred
            for ($Y=-6+$playerY; $Y < 7+$playerY; $Y++)
            {
                //ÄR SYNFÄLLT UTANFÖR ARRAY???
                if ($X > -1 && $Y > -1 && $X < count($map) && $Y < count($map[1]))
                {
                    //kollar igenom alla spelare
                    $sql = "SELECT `playerX`,`playerY`,`craftmode`,`id`,`floor` FROM `player`;";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc())
                    {
                        $playerprint = false;
                        //om spelare finns på X oxh y cordinaten skriv ut spelaren
                        if ($row["playerX"]==$X && $row["playerY"]==$Y && $map[$X][$Y]!=8 && $row["floor"]==$current_floor)
                        {
                            $output .= Player_image($map, $background, $X, $Y);
                            $playerprint = true;
                            break;
                        }
                    }
                    if (!$playerprint)
                    {
                        $output .= Tile_image($map, $background, $X, $Y);
                    }
                }
            }
            $output.= "<br>";
        }
        $sql = "UPDATE `player` SET `craftmode` = '".$craftmode."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        echo $output;
    ?>
</div>