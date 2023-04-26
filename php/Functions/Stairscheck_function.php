<?php
    function stairscheck($map,$playerX,$playerY,&$current_floor)
    {
        //kollar ifall spelaren står på en trappa ner eller up
        if($map[$playerX][$playerY]==17)
        {
            $current_floor++;
            return true;
        }elseif($map[$playerX][$playerY]==18)
        {
            $current_floor--;
            return true;
        }else
        {
            return false;
        }
    }
?>