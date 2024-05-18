<?php
    function diamond_generator(&$map,$worldsize,$diamondsize,$diamondfrequency)
    {
        //genererar diamond_ore 
        for($X=0; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,5000) < $diamondfrequency&&$map[$X][$Y]==5)
                {
                    $map[$X][$Y] = "diamond_ore";
                }
            }
        }
        $map2 = $map;
        for($i=0; $i < $diamondsize; $i++) 
        {
            for($X=1; $X < $worldsize-1; $X++) 
            {
                for($Y=1; $Y < $worldsize-1; $Y++) 
                {
                    if($map[$X][$Y] == "diamond_ore"&&rand(1,100) < 25 ) 
                    {
                        $map2[$X][$Y-1] = "diamond_ore";
                        $map2[$X][$Y+1] = "diamond_ore";
                        $map2[$X-1][$Y] = "diamond_ore";
                        $map2[$X+1][$Y] = "diamond_ore";
                    }
                }
            }
            $map = $map2;
        }
    }
?>