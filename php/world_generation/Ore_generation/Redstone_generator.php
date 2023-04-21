<?php
    function cave_generator(&$map,$worldsize)
    {
        //genererar grottor 
        $cavesize = 40;
        $cavefrequency = 2;

        for($X=0; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,5000) < $cavefrequency)
                {
                    $map[$X][$Y] = 4;
                }
            }
        }
        $map2 = $map;
        for($i=0; $i < $cavesize; $i++) 
        {
            for($X=1; $X < $worldsize-1; $X++) 
            {
                for($Y=1; $Y < $worldsize-1; $Y++) 
                {
                    if($map[$X][$Y] == 4&&rand(1,100) < 25 ) 
                    {
                        $map2[$X][$Y-1] = 4;
                        $map2[$X][$Y+1] = 4;
                        $map2[$X-1][$Y] = 4;
                        $map2[$X+1][$Y] = 4;
                    }
                }
            }
            $map = $map2;
        }
    }
?>