<?php
    function place($inventory,$map,$playerX,$playerY,$num)
    {
        include"Database_login.php";

        for ($i=0; $i < count($inventory); $i++)
        {
            if ($inventory[$i]=="workbench"&&$map[$playerX][$playerY]!=3 && $num == $i)
            {
                $inventory[$i] = "null";
                $map[$playerX][$playerY]=3;
                break;
            }elseif ($inventory[$i]=="Furnace"&&$map[$playerX][$playerY]!=9 && $num == $i)
            {
                $inventory[$i] = "null";
                $map[$playerX][$playerY]=9;
                break;
            }elseif ($inventory[$i]=="wood_wall"&&$map[$playerX][$playerY]!=14 && $num == $i)
            {
                $inventory[$i] = "null";
                $map[$playerX][$playerY]=14;
                break;
            }
        }

        $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = 1;";
        $result = $conn->query($sql);
        
        $sql = "UPDATE `player` SET `inventory` = '".json_encode($inventory)."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        return($inventory);
    }
?>