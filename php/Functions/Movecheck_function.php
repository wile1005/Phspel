<?php
    function movecheck(&$map, $playerX, $playerY)
    {
        switch ($map[$playerX][$playerY]) {
            case 2:
            case 5:
            case 6:
            case 7:
            case 8:
            case 13:
            case 14: 
                return(false);
            default:
                return(true);
        }
    }
?>