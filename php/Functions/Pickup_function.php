<?php
    function pickup(&$map,$playerX,$playerY,&$inventory,$num,$background)
    {
        for ($i=0; $i < 5; $i++)
        {
            if ($inventory[$i]=="null"&&$map[$playerX][$playerY]==9 && $num==$i)
            {
                //kollar vilke§n bakgrund som är under spelarn och sätter ut motsvarande objekt
                if($background[$playerX][$playerY]=="a1")
                {
                    $map[$playerX][$playerY]=1;
                    $inventory[$i] = "Furnace";
                    break;
                }elseif($background[$playerX][$playerY]=="a2")
                {
                    $map[$playerX][$playerY]=4;
                    $inventory[$i] = "Furnace";
                    break;
                }
            }else if ($inventory[$i]=="null"&&$map[$playerX][$playerY]==3 && $num==$i)
            {
                //kollar vilke§n bakgrund som är under spelarn och sätter ut motsvarande objekt
                if($background[$playerX][$playerY]=="a1")
                {
                    $map[$playerX][$playerY]=1;
                    $inventory[$i] = "workbench";
                    break;
                }elseif($background[$playerX][$playerY]=="a2")
                {
                    $map[$playerX][$playerY]=4;
                    $inventory[$i] = "workbench";
                    break;
                }
            }
        }
    }
?>