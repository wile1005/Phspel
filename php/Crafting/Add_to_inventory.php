<?php
    function add_item_to_inventory(&$inventory,$item_to_add,$quantity)
    {
        //adds item to inventory
        foreach($inventory as $key => $item)
        {
            if($item[0]==$item_to_add)
            {
                $inventory[$key][1]+=$quantity;
                return;
            }
        }
        array_push($inventory,array($item_to_add,1));
    }
    function add_tool_to_inventory(&$inventory,$item)
    {
        //adds tool to invetory
        array_push($inventory,$item);
    }
?>