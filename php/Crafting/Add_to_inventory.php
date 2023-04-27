<?php
    function add_item_to_inventory(&$inventory,$item)
    {
        //lägger till ett item till inventoriet
        $itemfound = false;
        $inventory_size=count($inventory);
        
        for($i=0; $i < $inventory_size; $i++)
        {
            if($inventory[$i][0]==$item)
            {
                $itemfound = true;
                $inventory[$i][1]++;
            }
        }
        if ($itemfound == false)
        {
            array_push($inventory,array($item,1));
        }
    }
    function add_tool_to_inventory(&$inventory,$item)
    {
        // lägger till ett tool till inventoriet
        array_push($inventory,$item);
    }
?>