<?php
    //kollar om tilen kan bli slagen
    function hit($map, $playerX, $playerY,$inventory, $num)
    {
        //connectar till databasen
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "phspel";

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($map[$playerX][$playerY]==2)
        {
            //tree hit
            $map[$playerX][$playerY]=1;
            for ($i=0; $i <5 ; $i++)
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
            for ($i=0; $i <5 ; $i++)
            {
                if ($inventory[$i] == "Wood_pickaxe"&&$num==$i||$inventory[$i] == "stone_pickaxe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=4;
                    for ($j=0; $j < 5; $j++)
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
            for ($i=0; $i <5 ; $i++)
            {
                if ($inventory[$i] == "stone_pickaxe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=4;
                    for ($j=0; $j < 5; $j++)
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
            for ($i=0; $i <5 ; $i++)
            {
                if ($inventory[$i] == "iron_pickaxe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=4;
                    for ($j=0; $j < 5; $j++)
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
            //redstone ore hit
            for ($i=0; $i <5 ; $i++)
            {
                if ($inventory[$i] == "wood_pickaxe"&&$num==$i)
                {
                    $map[$playerX][$playerY]=4;
                    for ($j=0; $j < 5; $j++)
                    {
                        if ($inventory[$j] == "null")
                        {
                            $inventory[$j] = "redstone";
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