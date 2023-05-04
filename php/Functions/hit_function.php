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
            add_item_to_inventory($inventory,"wood",rand(1,3));
        }elseif ($map[$playerX][$playerY]==5)
        {
            //stone hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone",rand(1,3));
            }
        }elseif ($map[$playerX][$playerY]==6)
        {
            //iron hit
            if($holding=="stone pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"iron ore",rand(1,4));
            }
        }elseif ($map[$playerX][$playerY]==7)
        {
            //redstone ore hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone",rand(4,6));
            }
        }elseif ($map[$playerX][$playerY]==13)
        {
            //coal ore hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone",rand(1,4));
            }
        }if ($map[$playerX][$playerY]==14)
        {
            //wall hit
            if($holding=="wood pickaxe")
            {
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"stone",1);
            }
        }
    }
?>