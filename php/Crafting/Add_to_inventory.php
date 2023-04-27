<?php
    function add_to_inventory(&$inventory,$item)
    {
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
?>