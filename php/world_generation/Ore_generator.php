<?php
    function ore_generator(&$map,$worldsize)
    {
        $map2 = $map;
        for($X=1; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if($map[$X+1][$Y]==5&&$map[$X-1][$Y]==5&&$map[$X][$Y+1]==5&&$map[$X][$Y-1]==5)
                {
                    if(rand(0,10) < 2&&$map[$X][$Y]==5)
                    {
                        $map2[$X][$Y] = 6;
                    }
                    if(rand(0,10) < 1&&$map[$X][$Y]==5)
                    {
                        $map2[$X][$Y] = 7;
                    }
                    if(rand(0,10) < 3&&$map[$X][$Y]==5)
                    {
                        $map2[$X][$Y] = 13;
                    }
                }
            }
        }
        $map = $map2;
    }
?>