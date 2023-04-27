<?php
    function craft($recipes,&$inventory,$num,$craftmode)
    {
        //simplifiera detta

        //crafting logic
        if($recipes[$num]=="plank")
        {
            for($i=0; $i < count($inventory); $i++)
            {
                if($inventory[$i][0]=="log"&&$inventory[$i][1]>0)
                {
                    $inventory[$i][1]-=1;
                    add_item_to_inventory($inventory,"plank");
                    break;
                }
            }
        }else if($recipes[$num]=="workbench")
        {
            for($i=0; $i < count($inventory); $i++)
            {
                if($inventory[$i][0]=="log"&&$inventory[$i][1]>9)
                {
                    $inventory[$i][1]-=2;
                    add_item_to_inventory($inventory,"workbench");
                    break;
                }
            }
        }else if($recipes[$num]=="wood pickaxe"&&$craftmode=="workbench")
        {
            for($i=0; $i < count($inventory); $i++)
            {
                if($inventory[$i][0]=="log"&&$inventory[$i][1]<4)
                {
                    $inventory[$i][1]-=1;
                    add_tool_to_inventory($inventory,"wood_pickaxe");
                    break;
                }
            }
        }
    }
?>