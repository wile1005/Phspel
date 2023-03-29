<div id="GFX">
    <?php
        include"GFX_Tile_image.php";
        include"GFX_Player_image.php";
        include"Database_login.php";

        session_start();

        //hämtar spelar X och Y
        $sql = "SELECT `playerX`,`playerY`,`craftmode`,`inventory`,`num`,`id` FROM `player`;";
        $result = $conn->query($sql);
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        if($_SESSION["id"]==$row["id"])
        {
            $playerX = $row["playerX"];
            $playerY = $row["playerY"];
            $craftmode = $row["craftmode"];
            $num = $row["num"];
            $inventory=json_decode($row["inventory"]);
        }


        //hämtar kartan och bakgrunden
        $sql = "SELECT `map`,`background`,`id` FROM `world`";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
            if($_SESSION["selected_world"]==$row["id"])
            {
                $map = json_decode($row["map"]);
                $background = json_decode($row["background"]);
            }
        }

        //SPELARENS SYNFÄLLT
        $output = "";
        for ($X=-3+$playerX; $X < 4+$playerX; $X++)
        {
            for ($Y=-3+$playerY; $Y < 4+$playerY; $Y++)
            {
                //ÄR SYNFÄLLT UTANFÖR ARRAY???
                if ($X > -1 && $Y > -1 && $X < count($map) && $Y < count($map[1]))
                {
                    //kollar igenom alla spelare
                    $sql = "SELECT `playerX`,`playerY`,`craftmode`,`id` FROM `player`;";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc())
                    {
                        $playerprint = false;
                        //om spelare finns på X oxh y cordinaten skriv ut spelaren
                        if ($row["playerX"]==$X && $row["playerY"]==$Y && $map[$X][$Y]!=8)
                        {
                            $output .= Player_image($map, $background, $X, $Y, $craftmode);
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

        //grafiken för
        foreach ($inventory as $item) 
        {
            $output .= $item == "null" ? "<img src='../image/slot.jpg' alt=''>" : "<img src='../image/$item.jpg' alt=''>";
        }

        $output.= "<br>";
        for ($i=0; $i < count($inventory); $i++)
        {
            if ($i==$num)
            {
                $output .= "<img src='../image/selector_arrow.jpg' alt=''>";
            }else
            {
                $output .= "<img src='../image/selector_slot.jpg' alt=''>";
            }

        }
        $sql = "UPDATE `player` SET `craftmode` = '".$craftmode."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        echo $output;
    ?>
</div>