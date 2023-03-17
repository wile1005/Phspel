<div id="GFX">
    <?php
        session_start();
        //bla bla bla loggin till mysql
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "phspel";

        //connects to mysqli server
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        //hämtar spelar X och Y
        $sql = "SELECT `playerX`,`playerY`,`craftmode`,`inventory`,`id` FROM `player`;";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
            if($_SESSION["id"]==$row["id"])
            {
                $playerX = $row["playerX"];
                $playerY = $row["playerY"];
                $inventory=json_decode($row["inventory"]);
            }
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
        for ($X=-2+$playerX; $X < 3+$playerX; $X++)
        {
            for ($Y=-2+$playerY; $Y < 3+$playerY; $Y++)
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
                            if ($map[$X][$Y]==3)
                            {
                                $_SESSION["craftmode"]="bench";
                                echo "<img src='../image/crafting.png' alt='' id='".$background[$X][$Y]."' >";
                            }elseif ($map[$X][$Y]==9)
                            {
                                $_SESSION["craftmode"]="furnace";
                                echo "<img src='../image/furnacing.png' alt='' id='".$background[$X][$Y]."' >";
                            }else
                            {
                                if ($row["id"]==$_SESSION["playerid"])
                                {
                                    $_SESSION["craftmode"]="null";
                                }
                                echo "<img src='../image/Player.png' alt='' id='".$background[$X][$Y]."' >";
                            }
                            $playerprint = true;
                            break;
                        }
                    }
                    if ($playerprint == false)
                    {
                        if ($map[$X][$Y] == 1)
                        {
                            echo "<img src='../image/grass".rand(1,2).".png' alt='' id='".$background[$X][$Y]."' >";
                        }elseif ($map[$X][$Y] == 2)
                        {
                            echo "<img src='../image/tree.png' alt='' id='".$background[$X][$Y]."' >";
                        }elseif ($map[$X][$Y] == 3)
                        {
                            echo "<img src='../image/workbench_place.png' alt='' id='".$background[$X][$Y]."' >";
                        }elseif ($map[$X][$Y] == 4)
                        {
                            echo "<img src='../image/stone_floor.png' alt='' id='".$background[$X][$Y]."' >";
                        }elseif ($map[$X][$Y] == 5)
                        {
                            echo "<img src='../image/stone_wall.png' alt='' id='".$background[$X][$Y]."' >";
                        }elseif ($map[$X][$Y] == 6)
                        {
                            echo "<img src='../image/iron_ore.png' alt='' id='".$background[$X][$Y]."' >";
                        }elseif ($map[$X][$Y] == 7)
                        {
                            echo "<img src='../image/redstone_ore.png' alt='' id='".$background[$X][$Y]."' >";
                        }elseif ($map[$X][$Y] == 8)
                        {
                            echo "<img src='../image/bedrock.jpg' alt='' id='".$background[$X][$Y]."' >";
                        }elseif ($map[$X][$Y] == 9)
                        {
                            echo "<img src='../image/furnace_place.png' alt='' id='".$background[$X][$Y]."' >";
                        }else
                        {

                        }
                    }
                }
            }
            echo "<br>";
        }
        for ($i=0; $i < count($inventory); $i++)
        {
            if ($inventory[$i]=="null")
            {
                echo "<img src='../image/slot.jpg' alt=''>";
            }else
            {
                echo "<img src='../image/".$inventory[$i].".jpg' alt=''>";
            }

        }
        echo "<br>";
        for ($i=0; $i < 5; $i++)
        {
            if ($i==$_SESSION["num"])
            {
                echo "<img src='../image/selector_arrow.jpg' alt=''>";
            }else
            {
                echo "<img src='../image/selector_slot.jpg' alt=''>";
            }

        }
    ?>
</div>