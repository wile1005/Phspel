<?php
    function biome_generator(&$map,$size,$frequenzy,$tile_id)
    {
        //genererar öken 

        for($X=0; $X < count($map)-1; $X++)
        {
            for($Y=1; $Y < count($map[$X])-1; $Y++)
            {
                if(rand(1,100) < $frequenzy)
                {
                    $map[$X][$Y] = $tile_id;
                }
            }
        }
        $tempmap = $map;
        for($i=0; $i < $size; $i++) 
        {
            for($X=1; $X < count($map)-1; $X++) 
            {
                for($Y=1; $Y < count($map[$X])-1; $Y++) 
                {
                    if($map[$X][$Y] == $tile_id&&rand(1,100) < 25) 
                    {
                        $tempmap[$X][$Y-1] = $tile_id;
                        $tempmap[$X][$Y+1] = $tile_id;
                        $tempmap[$X-1][$Y] = $tile_id;
                        $tempmap[$X+1][$Y] = $tile_id;
                    }
                }
            }
            $map = $tempmap;
        }
    }
?>