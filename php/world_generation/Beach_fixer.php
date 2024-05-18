<?php
    function beach_fixer(&$map,$worldsize)
    {
        //gör om alla tiles brevid vatten till sand
        for($X=1; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                if($map[$X+1][$Y]==2||$map[$X-1][$Y]==2||$map[$X][$Y+1]==2||$map[$X][$Y-1]==2)
                {
                    if($map[$X][$Y]!=2)
                    {
                        $map[$X][$Y]=3;
                    }
                }
            }
        }
    }
?>