<?php
    if(array_key_exists('pickup', $_POST))
    {
        for ($i=0; $i < 5; $i++)
        {
            if ($inventory[$i]=="null"&&$map[$playerX][$playerY]==9 && $_SESSION["num"]==$i)
            {
                //kollar vilke§n bakgrund som är under spelarn och sätter ut motsvarande objekt
                if($_SESSION["background"][$playerX][$playerY]=="a1")
                {
                    $map[$playerX][$playerY]=1;
                    $inventory[$i] = "Furnace";
                    break;
                }elseif($_SESSION["background"][$playerX][$playerY]=="a2")
                {
                    $map[$playerX][$playerY]=4;
                    $inventory[$i] = "Furnace";
                    break;
                }
            }else if ($inventory[$i]=="null"&&$map[$playerX][$playerY]==3 && $_SESSION["num"]==$i)
            {
                //kollar vilke§n bakgrund som är under spelarn och sätter ut motsvarande objekt
                if($_SESSION["background"][$playerX][$playerY]=="a1")
                {
                    $map[$playerX][$playerY]=1;
                    $inventory[$i] = "workbench";
                    break;
                }elseif($_SESSION["background"][$playerX][$playerY]=="a2")
                {
                    $map[$playerX][$playerY]=4;
                    $inventory[$i] = "workbench";
                    break;
                }
            }
        }
    }
?>