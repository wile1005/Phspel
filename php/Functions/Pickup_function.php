<?php
    function pickup(&$map,$X,$Y,&$inventory,$background)
    {
        switch($map[$X][$Y])
        {
            case"3":
            background_return($map,$X,$Y,$background);
            add_item_to_inventory($inventory,"workbench",1);
            break;
        }
    }
?>