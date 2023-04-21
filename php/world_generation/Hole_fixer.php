<?php
    function hole_fixer(&$map,$worldsize)
    {
        //fixar hål i kartan (när alla tiles runt är likadant men inte mitten)
        for($X=1; $X < $worldsize-1; $X++)
        {
            for($Y=1; $Y < $worldsize-1; $Y++)
            {
                //funkar inte 
                if($map[$X+1][$Y]!=5&&$map[$X-1][$Y]!=5&&$map[$X][$Y+1]!=5&&$map[$X][$Y-1]!=5&&$map[$X][$Y-1]==5)
                {
                    echo"11";
                    $map[$X][$Y]=1;
                }
                if($map[$X+1][$Y]!=10&&$map[$X-1][$Y]!=10&&$map[$X][$Y+1]!=10&&$map[$X][$Y-1]!=10)
                {
                    if($map[$X][$Y]==10)
                    {
                        $map[$X][$Y]=1;
                    }
                }
                if($map[$X+1][$Y]==11&&$map[$X-1][$Y]==11&&$map[$X][$Y+1]==11&&$map[$X][$Y-1]==11)
                {
                    if($map[$X][$Y]!=11)
                    {
                        $map[$X][$Y]=11;
                    }
                }
                if($map[$X+1][$Y]==1&&$map[$X-1][$Y]==1&&$map[$X][$Y+1]==1&&$map[$X][$Y-1]==1)
                {
                    if($map[$X][$Y]!=1)
                    {
                        $map[$X][$Y]=1;
                    }
                }
            }
        }
    }
?>