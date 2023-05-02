<?php
    function craft2($recipes,&$inventory,$item_to_craft,$craftmode)
    {

    }
    function craft($recipes,&$inventory,$num,$craftmode)
    {
        //simplifiera detta

        $index;
        //crafting logic
        switch ($recipes[$num]) 
        {
            case "plank":
            $index = find_item($inventory,"log");
            if($inventory[$index][1]>0)
            {
                $inventory[$index][1]-=1;
                add_item_to_inventory($inventory,"plank");
            }
            break;

            case "workbench":
            $index = find_item($inventory,"log");
            if($inventory[$index][1]>9)
            {
                $inventory[$index][1]-=10;
                add_item_to_inventory($inventory,"workbench");
            }
            break;

            case "wood pickaxe" && $craftmode=="workbench":
            $index = find_item($inventory,"log");
            if($inventory[$index][1]>4)
            {
                $inventory[$index][1]-=5;
                add_item_to_inventory($inventory,"wood_pickaxe");
            }
            break;
        }
    }
?>