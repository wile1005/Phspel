<?php
    function Stairs_generator($worldsize)
    {
        include "Database/Database_login.php";
        $sql = "SELECT `id`,`map` FROM `world`;";
        $result = $conn->query($sql);
        $map = array();
        while($row = $result->fetch_assoc()) 
        {
            $map[$row["id"]]=json_decode($row["map"]);
        }
        for($layer=1; $layer < count($map)+1; $layer++)
        {
            if($layer==1)
            {
                $map[$layer][4][4]=17;
                for($X=4; $X < $worldsize-4; $X++)
                {
                    for($Y=4; $Y < $worldsize-4; $Y++)
                    {
                        if($map[$layer][$X][$Y]==5&&rand(1,100)==1)
                        {
                            $map[$layer][$X][$Y] = 17;
                        }
                    }
                }
                $sql = "UPDATE `world` SET `map` = '".json_encode($map[$layer])."' WHERE `world`.`id` = ".$layer.";";
                $result = $conn->query($sql);
            }else
            {
                for($X=4; $X < $worldsize-4; $X++)
                {
                    for($Y=4; $Y < $worldsize-4; $Y++)
                    {
                        if($map[$layer-1][$X][$Y]==17)
                        {
                            $map[$layer][$X][$Y]=18;
                        }elseif($map[$layer][$X][$Y]==5&&rand(1,100)==1)
                        {
                            $map[$layer][$X][$Y] = 17;
                        }
                    }
                }
                $sql = "UPDATE `world` SET `map` = '".json_encode($map[$layer])."' WHERE `world`.`id` = ".$layer.";";
                $result = $conn->query($sql);
            }
        }
    }
?>