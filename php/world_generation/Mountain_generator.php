<?php
    function Mountain_generator(&$map,&$background_map,$mountainsize,$mountainfrequency)
    {
        //genererar berg

        for($X=1; $X < count($map)-1; $X++)
        {
            for($Y=1; $Y < count($map)-1; $Y++)
            {
                if(rand(1,2000) < $mountainfrequency)
                {
                    $map[$X][$Y] = 5;
                }
            }
        }
        $tempmap = $map;
        for($i=0; $i < $mountainsize; $i++) 
        {
            for($X=1; $X < count($map)-1; $X++) 
            {
                for($Y=1; $Y < count($map)-1; $Y++) 
                {
                    if($map[$X][$Y] == 5&&rand(1,100) < 25&&$background_map!=2) 
                    {
                        $tempmap[$X][$Y-1] = 5;
                        $tempmap[$X][$Y+1] = 5;
                        $tempmap[$X-1][$Y] = 5;
                        $tempmap[$X+1][$Y] = 5;
                    }
                }
            }
            $map = $tempmap;
        }
        for($X=1; $X < count($map)-1; $X++) 
        {
            for($Y=1; $Y < count($map)-1; $Y++) 
            {
                if($map[$X][$Y] == 5) 
                {
                    $background_map[$X][$Y] = 4;
                    $background_map[$X][$Y-1] = 4;
                    $background_map[$X][$Y+1] = 4;
                    $background_map[$X-1][$Y] = 4;
                    $background_map[$X+1][$Y] = 4;
                }
            }
        }
    }
?>