<?php
    function ocean_generator(&$map,$worldsize)
    {
        $oceansize = 5;
        $oceangain = 25;

        for($X=2; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,100) < 2)
                {
                    $map[$X][$Y] = 10;
                }
            }
        }
        $map2 = $map;
        for($i=0; $i < $oceansize; $i++) 
        {
            for($X=1; $X < $worldsize-1; $X++) 
            {
                for($Y=1; $Y < $worldsize-1; $Y++) 
                {
                    if($map[$X][$Y] == 10&&rand(1,100) < $oceangain) 
                    {
                        $map2[$X][$Y-1] = 10;
                        $map2[$X][$Y+1] = 10;
                        $map2[$X-1][$Y] = 10;
                        $map2[$X+1][$Y] = 10;
                    }
                }
            }
            $map = $map2;
        }
    }
?>