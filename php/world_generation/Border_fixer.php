<?php
    function border_fix(&$map,$worldsize)
    {
        //fixa border
        for($X=0; $X < count($map); $X++)
        {
            for($Y=0; $Y < count($map[1]); $Y++)
            {
                if($Y==0)$map[$X][$Y] = 8;
                elseif($X==0)$map[$X][$Y] = 8;
                elseif($Y==$worldsize-1)$map[$X][$Y] = 8;
                elseif($X==$worldsize-1)$map[$X][$Y] = 8;
            }
        }
        return($map);
    }
?>