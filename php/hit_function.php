<?php
    //kollar om tilen kan bli slagen
    function hit(&$map, $playerX, $playerY,$inventory, $num)
    {
        include"Database_login.php";
        $inventory_size=count($inventory);
        if ($map[$playerX][$playerY]==2)
        {
            //tree hit
            $map[$playerX][$playerY]=1;
            for ($i=0; $i <$inventory_size ; $i++)
            {
                if ($inventory[$i] == "null")
                {
                    $inventory[$i] = "log";
                    break;
                }
            }
        }elseif ($map[$playerX][$playerY]==5)
        {
            //stone hit
            for ($i=0; $i <$inventory_size ; $i++)
            {
                if ($inventory[$i] == "Wood_pickaxe"&&$num==$i||$inventory[$i] == "stone_pickaxe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=4;
                    for ($j=0; $j < $inventory_size; $j++)
                    {
                        if ($inventory[$j] == "null")
                        {
                            $inventory[$j] = "stone";
                            break;
                        }
                    }
                }
            }
        }elseif ($map[$playerX][$playerY]==6)
        {
            //iron hit
            for ($i=0; $i <$inventory_size ; $i++)
            {
                if ($inventory[$i] == "stone_pickaxe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=4;
                    for ($j=0; $j < $inventory_size; $j++)
                    {
                        if ($inventory[$j] == "null")
                        {
                            $inventory[$j] = "raw_iron";
                            break;
                        }
                    }
                }
            }
        }elseif ($map[$playerX][$playerY]==7)
        {
            //redstone ore hit
            for ($i=0; $i <$inventory_size ; $i++)
            {
                if ($inventory[$i] == "iron_pickaxe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=4;
                    for ($j=0; $j < $inventory_size; $j++)
                    {
                        if ($inventory[$j] == "null")
                        {
                            $inventory[$j] = "redstone";
                            break;
                        }
                    }
                }
            }
        }elseif ($map[$playerX][$playerY]==13)
        {
            //coal ore hit
            for ($i=0; $i <$inventory_size ; $i++)
            {
                if ($inventory[$i] == "Wood_pickaxe"&&$num==$i||$inventory[$i] == "stone_pickaxe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=4;
                    for ($j=0; $j < $inventory_size; $j++)
                    {
                        if ($inventory[$j] == "null")
                        {
                            $inventory[$j] = "coal";
                            break;
                        }
                    }
                }
            }
        }if ($map[$playerX][$playerY]==14)
        {
            //wall hit
            for ($i=0; $i <$inventory_size ; $i++)
            {
                if ($inventory[$i] == "axe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=1;
                    for ($i=0; $i <$inventory_size ; $i++)
                    {
                        if ($inventory[$i] == "null")
                        {
                            $inventory[$i] = "plank";
                            break;
                        }
                    }
                }
            }
        }

        $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = 1;";
        $result = $conn->query($sql);

        return($inventory);
    }
?>