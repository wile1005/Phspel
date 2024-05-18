<?php
    function Player_image(&$map, $X, $Y) 
    {
        $image_paths = [
            3 => 'player_workbench.png',
            9 => 'player_furnace.png',
            10 => 'player_water.png',
            16 => 'player_anvil.png'
        ];
        
        $image_path = isset($image_paths[$map[$X][$Y]]) ? $image_paths[$map[$X][$Y]] : 'Player.png';
        
        return "<img src='../Assets/Images/Player/".$image_path."' alt=''>";
    }
?>