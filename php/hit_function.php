<?php
    //kollar om tilen kan bli slagen
    function hit($player_X ,$player_Y, $conn)
    {
    echo($player_X." ".$player_Y);
    if ($map[$player_X][$player_Y]==2)
    {
        $map[$player_X][$player_Y]=1;
        for ($i=0; $i <5 ; $i++)
        {
            if ($_SESSION["inventory"][$i] == "null")
            {
                $_SESSION["inventory"][$i] = "log";
                break;
            }
        }
        echo "hit tree, ";
    }
    if ($map[$player_X][$player_Y]==5)
    {
        echo "hit stone, ";
        for ($i=0; $i <5 ; $i++)
        {
            if ($_SESSION["inventory"][$i] == "Wood_pickaxe"&&$_SESSION["num"]==$i||$_SESSION["inventory"][$i] == "stone_pickaxe"&&$_SESSION["num"]==$i)
            {
                $map[$player_X][$player_Y]=4;
                for ($j=0; $j < 5; $j++)
                {
                    if ($_SESSION["inventory"][$j] == "null")
                    {
                        $_SESSION["inventory"][$j] = "stone";
                        break;
                    }
                }
            }
        }
    }
    if ($map[$player_X][$player_Y]==6)
    {
        echo "hit iron ore, ";
        for ($i=0; $i <5 ; $i++)
        {
            if ($_SESSION["inventory"][$i] == "stone_pickaxe"&&$_SESSION["num"]==$i)
            {
                $map[$player_X][$player_Y]=4;
                for ($j=0; $j < 5; $j++)
                {
                    if ($_SESSION["inventory"][$j] == "null")
                    {
                        $_SESSION["inventory"][$j] = "raw_iron";
                        break;
                    }
                }
            }
        }
    }
    if ($map[$player_X][$player_Y]==7)
    {
        echo "hit redstone ore, ";
        for ($i=0; $i <5 ; $i++)
        {
            if ($_SESSION["inventory"][$i] == "iron_pickaxe"&&$_SESSION["num"]==$i)
            {
                $map[$player_X][$player_Y]=4;
                for ($j=0; $j < 5; $j++)
                {
                    if ($_SESSION["inventory"][$j] == "null")
                    {
                        $_SESSION["inventory"][$j] = "redstone";
                        break;
                    }
                }
            }
        }
    }
    }
?>