<?php
    //kollar om tilen kan bli slagen
    function hit($map, $playerX, $playerY,$inventory)
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
            $map[$playerX][$playerY]=1;
            for ($i=0; $i <5 ; $i++)
            {
                if ($inventory[$i] == "null")
                {
                    $inventory[$i] = "log";
                    break;
                }
            }
            echo "hit tree, ";
        }
        if ($map[$playerX][$playerY]==5)
        {
            echo "hit stone, ";
            for ($i=0; $i <5 ; $i++)
            {
                if ($inventory[$i] == "Wood_pickaxe"&&$_SESSION["num"]==$i||$inventory[$i] == "stone_pickaxe"&&$_SESSION["num"]==$i)
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
        }
        if ($map[$playerX][$playerY]==6)
        {
            echo "hit iron ore, ";
            for ($i=0; $i <5 ; $i++)
            {
                if ($inventory[$i] == "stone_pickaxe"&&$_SESSION["num"]==$i)
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
        }
        if ($map[$playerX][$playerY]==7)
        {
            echo "hit redstone ore, ";
            for ($i=0; $i <5 ; $i++)
            {
                if ($inventory[$i] == "iron_pickaxe"&&$_SESSION["num"]==$i)
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
        
        $sql = "UPDATE `player` SET `inventory` = '".json_encode($inventory)."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);
        return($inventory);
    }
?>