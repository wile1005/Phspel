<?php
    function border_fix(&$map,$worldsize)
    {
        //fixa en border runt kartan
        $mapX_length = count($map);
        $mapY_length = count($map[0]);
        
        for($X=0; $X < $mapX_length; ++$X)
        {
            for($Y=0; $Y < $mapY_length; ++$Y)
            {
                switch (true) {
                    case $Y === 0:
                    case $X === 0:
                    case $Y === $worldsize - 1:
                    case $X === $worldsize - 1:
                        $map[$X][$Y] = 8;
                        break;
                }
            }
        }
        return($map);
    }
?>