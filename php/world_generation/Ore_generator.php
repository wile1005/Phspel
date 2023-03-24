<?php
    function ore_generator(&$map,$worldsize)
    {
        for($X=1; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(0,10) < 2&&$map[$X][$Y]==5)
                {
                    $map[$X][$Y] = 6;
                }
                if(rand(0,10) < 1&&$map[$X][$Y]==5)
                {
                    $map[$X][$Y] = 7;
                }
                if(rand(0,10) < 3&&$map[$X][$Y]==5)
                {
                    $map[$X][$Y] = 13;
                }
            }
        }
    }
?>