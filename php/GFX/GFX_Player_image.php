<?php
    function Player_image(&$map, &$background, $X, $Y) 
    {
        $image_paths = [
            3 => '../image/player_workbench.png',
            9 => '../image/player_furnace.png',
            10 => '../image/player_water.png',
            16 => '../image/player_anvil.png'
        ];
        
        $image_path = isset($image_paths[$map[$X][$Y]]) ? $image_paths[$map[$X][$Y]] : '../image/Player.png';
        
        return "<img src='". $image_path . "' alt='' id='" . $background[$X][$Y] . "'>";
    }
?>