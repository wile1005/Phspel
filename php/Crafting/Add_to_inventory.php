<?php
    function add_item_to_inventory(&$inventory,$item,$quantity)
    {
        //adds item to inventory
        $itemfound = false;
        $inventory_size=count($inventory);
        
        for($i=0; $i < $inventory_size; $i++)
        {
            if($inventory[$i][0]==$item)
            {
                $inventory[$i][1]+=$quantity;
                return;
            }
        }
        array_push($inventory,array($item,1));
    }
    function add_tool_to_inventory(&$inventory,$item)
    {
        //adds tool to invetory
        array_push($inventory,$item);
    }
?>