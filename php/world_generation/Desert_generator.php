<?php
    function desert_generator(&$map,$worldsize)
    {
        $desertsize = 10;
        $desertgain = 25;
        $desertamount = 2;

        for($X=0; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,100) < $desertamount)
                {
                    $map[$X][$Y] = 11;
                }
            }
        }
        $map2 = $map;
        for($i=0; $i < $desertsize; $i++) 
        {
            for($X=1; $X < $worldsize-1; $X++) 
            {
                for($Y=1; $Y < $worldsize-1; $Y++) 
                {
                    if($map[$X][$Y] == 11&&rand(1,100) < $desertgain) 
                    {
                        $map2[$X][$Y-1] = 11;
                        $map2[$X][$Y+1] = 11;
                        $map2[$X-1][$Y] = 11;
                        $map2[$X+1][$Y] = 11;
                    }
                }
            }
            $map = $map2;
        }
    }
?>