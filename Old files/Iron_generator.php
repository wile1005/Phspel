<?php
    function Iron_generator(&$map,$worldsize,$ironsize,$ironfrequency)
    {
        //genererar iron_ore 

        for($X=0; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,5000) < $ironfrequency&&$map[$X][$Y]==5)
                {
                    $map[$X][$Y] = 6;
                }
            }
        }
        $map2 = $map;
        for($i=0; $i < $ironsize; $i++) 
        {
            for($X=1; $X < $worldsize-1; $X++) 
            {
                for($Y=1; $Y < $worldsize-1; $Y++) 
                {
                    if($map[$X][$Y] == 6&&rand(1,100) < 25 ) 
                    {
                        $map2[$X][$Y-1] = 6;
                        $map2[$X][$Y+1] = 6;
                        $map2[$X-1][$Y] = 6;
                        $map2[$X+1][$Y] = 6;
                    }
                }
            }
            $map = $map2;
        }
    }
?>