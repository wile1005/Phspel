<?php
    function Player_image(&$map, &$background, $X, $Y) 
    {
        $image_paths = [
            3 => '../images/player_workbench.png',
            9 => '../images/player_furnace.png',
            10 => '../images/player_water.png',
            16 => '../images/player_anvil.png'
        ];
        
        $image_path = isset($image_paths[$map[$X][$Y]]) ? $image_paths[$map[$X][$Y]] : '../images/Player.png';
        
        return "<img src='". $image_path . "' alt='' id='" . $background[$X][$Y] . "'>";
    }
?>