<?php
    function tree_placer(&$map,$worldsize)
    {
        //genererar träd på gräs tiles
        for($X=1; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,10) < 4&&$map[$X][$Y]==1)
                {
                    $map[$X][$Y] = 2;
                }
            }
        }
    }
?>