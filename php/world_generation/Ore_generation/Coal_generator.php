<?php
    function Coal_generator(&$map,$worldsize,$coalsize,$coalfrequency)
    {
        //genererar coal_ore 

        for($X=0; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,5000) < $coalfrequency&&$map[$X][$Y]==5)
                {
                    $map[$X][$Y] = 13;
                }
            }
        }
        $map2 = $map;
        for($i=0; $i < $coalsize; $i++) 
        {
            for($X=1; $X < $worldsize-1; $X++) 
            {
                for($Y=1; $Y < $worldsize-1; $Y++) 
                {
                    if($map[$X][$Y] == 13&&rand(1,100) < 25 ) 
                    {
                        $map2[$X][$Y-1] = 13;
                        $map2[$X][$Y+1] = 13;
                        $map2[$X-1][$Y] = 13;
                        $map2[$X+1][$Y] = 13;
                    }
                }
            }
            $map = $map2;
        }
    }
?>