<?php
    //kollar om tilen kan bli slagen
    function hit(&$map, $playerX, $playerY, &$inventory, $holding, $background)
    {
        $itemfound = false;
        $inventory_size=count($inventory);
        if($map[$playerX][$playerY]==2)
        {
            //tree hit
            background_return($map,$playerX,$playerY,$background);
            add_item_to_inventory($inventory,"wood");
        }elseif ($map[$playerX][$playerY]==5)
        {
            //stone hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone");
            }
        }elseif ($map[$playerX][$playerY]==6)
        {
            //iron hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone");
            }
        }elseif ($map[$playerX][$playerY]==7)
        {
            //redstone ore hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone");
            }
        }elseif ($map[$playerX][$playerY]==13)
        {
            //coal ore hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone");
            }
        }if ($map[$playerX][$playerY]==14)
        {
            //wall hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone");
            }
        }
    }
?>