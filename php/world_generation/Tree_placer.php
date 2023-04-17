<?php
    function tree_placer(&$map,$worldsize)
    {
        //generates trees on grass tiles
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