<?php
    function Tile_image(&$map, &$background, $X, $Y) 
    {
        $image_paths = [
            1 => '../images/grass' . rand(1, 2) . '.png',
            2 => '../images/tree.png',
            3 => '../images/workbench_place.png',
            4 => '../images/stone_floor.png',
            5 => '../images/stone_wall.png',
            6 => '../images/iron_ore.png',
            7 => '../images/redstone_ore.png',
            8 => '../images/bedrock.jpg',
            9 => '../images/furnace_place.png',
            10 => '../images/water.png',
            11 => '../images/sand.png',
            12 => '../images/cactus.png',
            13 => '../images/coal_ore.png',
            14 => '../images/wood_wall.png',
            16 => '../images/anvil.png',
            17 => '../images/Stairs_down.png',
            18 => '../images/Stairs_up.png'
        ];
        
        $image_path = isset($image_paths[$map[$X][$Y]]) ? $image_paths[$map[$X][$Y]] : '';
        
        return '<img src="' . $image_path . '" alt="" id="' . $background[$X][$Y] . '" />';
    }
?>