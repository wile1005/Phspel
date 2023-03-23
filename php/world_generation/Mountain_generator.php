<?php
    function Mountain_generator(&$map,$worldsize)
    {
        $mountainsize = 5;
        $mountaingain = 25;

        for($X=1; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,100) < 2)
                {
                    $map[$X][$Y] = 5;
                }
            }
        }
        $map2 = $map;
        for($i=0; $i < $mountainsize; $i++) 
        {
            for($X=1; $X < $worldsize-1; $X++) 
            {
                for($Y=1; $Y < $worldsize-1; $Y++) 
                {
                    if($map[$X][$Y] == 5&&rand(1,100) < $mountaingain) 
                    {
                        $map2[$X][$Y-1] = 5;
                        $map2[$X][$Y+1] = 5;
                        $map2[$X-1][$Y] = 5;
                        $map2[$X+1][$Y] = 5;
                    }
                }
            }
            $map = $map2;
        }
    }
?>