<?php
    function gold_generator(&$map,$worldsize,$goldsize,$goldfrequency)
    {
        //genererar gold_ore 
    
        for($X=0; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if(rand(1,5000) < $goldfrequency&&$map[$X][$Y]==5)
                {
                    $map[$X][$Y] = "gold_ore";
                }
            }
        }
        $map2 = $map;
        for($i=0; $i < $goldsize; $i++) 
        {
            for($X=1; $X < $worldsize-1; $X++) 
            {
                for($Y=1; $Y < $worldsize-1; $Y++) 
                {
                    if($map[$X][$Y] == "gold_ore"&&rand(1,100) < 25 ) 
                    {
                        $map2[$X][$Y-1] = "gold_ore";
                        $map2[$X][$Y+1] = "gold_ore";
                        $map2[$X-1][$Y] = "gold_ore";
                        $map2[$X+1][$Y] = "gold_ore";
                    }
                }
            }
            $map = $map2;
        }
    }
?>