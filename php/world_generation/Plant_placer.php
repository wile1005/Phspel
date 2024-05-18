<?php
    function Plant_placer(&$map,$background_map,$tileid,$plantid,$frequenzy)
    {
        //placerar kaktusar på sand tiles
        for($X=1; $X < count($map)-1; $X++)
        {
            for($Y=1; $Y < count($map)-1; $Y++)
            {
                if(rand(1,100) < $frequenzy&&$background_map[$X][$Y]==$tileid)
                {
                    $map[$X][$Y] = $plantid;
                }
            }
        }
    }
?>