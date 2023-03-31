<?php
    function Tile_image(&$map, &$background, $X, $Y) 
    {
        $image_paths = [
            1 => '../image/grass' . rand(1, 2) . '.png',
            2 => '../image/tree.png',
            3 => '../image/workbench_place.png',
            4 => '../image/stone_floor.png',
            5 => '../image/stone_wall.png',
            6 => '../image/iron_ore.png',
            7 => '../image/redstone_ore.png',
            8 => '../image/bedrock.jpg',
            9 => '../image/furnace_place.png',
            10 => '../image/water.png',
            11 => '../image/sand.png',
            12 => '../image/cactus.png',
            13 => '../image/coal_ore.png',
            14 => '../image/wood_wall.png'
        ];
        
        $image_path = isset($image_paths[$map[$X][$Y]]) ? $image_paths[$map[$X][$Y]] : '';
        
        return '<img src="' . $image_path . '" alt="" id="' . $background[$X][$Y] . '" />';
    }
?>