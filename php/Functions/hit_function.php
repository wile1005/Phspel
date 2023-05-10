<?php
    //kollar om tilen kan bli slagen
    function hit(&$map, $playerX, $playerY, &$inventory, $holding, $background)
    {
        switch($map[$playerX][$playerY])
        {
            case"2":
                //tree hit
                background_return($map,$playerX,$playerY,$background);
                add_item_to_inventory($inventory,"wood",rand(1,3));
                break;
        
            case"5":
                //stone hit
                if(strpos($holding,"pickaxe"))
                {
                    background_return($map,$playerX,$playerY,$background);
                    add_item_to_inventory($inventory,"stone",rand(1,3));
                }
                break;

            case"6":
                //iron hit
                if($holding=="stone pickaxe")
                {
                    background_return($map,$playerX,$playerY,$background);
                    add_item_to_inventory($inventory,"iron ore",rand(1,4));
                }
                break;
            
            case"7":
                //redstone ore hit
                if($holding=="iron pickaxe")
                {
                    background_return($map,$playerX,$playerY,$background);
                    add_item_to_inventory($inventory,"stone",rand(4,6));
                }
                break;
            
            case"13":
                //coal ore hit
                if(strpos($holding,"pickaxe"))
                {
                    background_return($map,$playerX,$playerY,$background);
                    add_item_to_inventory($inventory,"coal",rand(1,4));
                }
                break;
            
            case"14":
                //wall hit
                if($holding=="wood axe")
                {
                    background_return($map,$playerX,$playerY,$background);
                    add_item_to_inventory($inventory,"stone",1);
                }
                break;
        }
    }
?>