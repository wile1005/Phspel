<?php
    function movecheck($map, $playerX, $playerY)
    {
        if ($map[$playerX][$playerY] == 2)
        {
            return(false);
        }elseif($map[$playerX][$playerY]==5)
        {
            return(false);
        }elseif($map[$playerX][$playerY]==6)
        {
            return(false);
        }elseif($map[$playerX][$playerY]==7)
        {
            return(false);
        }elseif($map[$playerX][$playerY]==8)
        {
            return(false);
        }else
        {
            return(true);
        }
    }
?>