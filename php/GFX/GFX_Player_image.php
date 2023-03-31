<?php
    function Player_image(&$map, &$background, $X, $Y, &$craftmode) 
    {
        $image_paths = [
            3 => ['path' => '../image/crafting.png', 'mode' => 'bench'],
            9 => ['path' => '../image/furnacing.png', 'mode' => 'furnace'],
            10 => ['path' => '../image/swiming.png', 'mode' => null],
        ];
    
        $image_path = isset($image_paths[$map[$X][$Y]]) ? $image_paths[$map[$X][$Y]]['path'] : '../image/Player.png';
        $craftmode = isset($image_paths[$map[$X][$Y]]) ? $image_paths[$map[$X][$Y]]['mode'] : 'null';
    
        return "<img src='" . $image_path . "' alt='' id='" . $background[$X][$Y] . "'>";
    }
    
?>