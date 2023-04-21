<?php
    function Mountain_generator(&$map,$worldsize,$mountainsize,$mountainamount)
    {
        //genererar berg

        for($X=1; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,2000) < $mountainamount)
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
                    if($map[$X][$Y] == 5&&rand(1,100) < 25) 
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