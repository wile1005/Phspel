<?php
    function Image_return(&$map, &$background, $X, $Y) 
    {
        switch ($map[$X][$Y]) 
        {
            case 1:
                return '<img src="../image/grass'.rand(1,2).'.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 2:
                return '<img src="../image/tree.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 3:
                return '<img src="../image/workbench_place.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 4:
                return '<img src="../image/stone_floor.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 5:
                return '<img src="../image/stone_wall.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 6:
                return '<img src="../image/iron_ore.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 7:
                return '<img src="../image/redstone_ore.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 8:
                return '<img src="../image/bedrock.jpg" alt="" id="'.$background[$X][$Y].'" />';
        
            case 9:
                return '<img src="../image/furnace_place.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 10:
                return '<img src="../image/water.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 11:
                return '<img src="../image/sand.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 12:
                return '<img src="../image/cactus.png" alt="" id="'.$background[$X][$Y].'" />';
        
            case 13:
                return '<img src="../image/coal_ore.png" alt="" id="'.$background[$X][$Y].'" />';
        
            default:
                return '<img alt="" id="'.$background[$X][$Y].'" />';
        }
    }
?>