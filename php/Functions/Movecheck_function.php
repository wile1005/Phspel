<?php
    function movecheck(&$map, $playerX, $playerY)
    {
        //checks if player can move to the tile
        switch ($map[$playerX][$playerY]) {
            case 2:
            case 5:
            case 6:
            case 7:
            case 8:
            case 13:
            case 14: 
            case "gold_ore": 
                return(false);
            default:
                return(true);
        }
    }
?>