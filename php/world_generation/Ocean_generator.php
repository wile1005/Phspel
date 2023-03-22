<?php
    function ocean_generator(&$map,$worldsize)
    {
        $oceansize = 5;
        $oceangain = 25;

        for($X=0; $X < count($map); $X++)
        {
            for($Y=0; $Y < count($map[1]); $Y++)
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
            for($X=0; $X < $worldsize; $X++) 
            {
                for($Y=0; $Y < $worldsize; $Y++) 
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