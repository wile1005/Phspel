<?php
    function remove_item_from_inventory(&$inventory,$item_to_remove,$quantity)
    {
        //removes item to inventory
        foreach($inventory as $key => $item)
        {
            if($item[0]==$item_to_remove)
            {
                $inventory[$key][1]-=$quantity;
                if ($inventory[$key][1] <= 0) 
                {
                    unset($inventory[$key]);
                    $inventory = array_values($inventory);
                }
                return;
            }
        }
    }
?>