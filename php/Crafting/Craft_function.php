<?php
    function craft($recipes,&$inventory,$num,$craftmode)
    {
        if($recipes[$num]=="plank")
        {
            for($i=0; $i < count($inventory); $i++)
            {
                if($inventory[$i][0]=="log")
                {
                    $inventory[$i][1]--;
                    add_to_inventory($inventory,"plank");
                }
            }
        }else if($recipes[$num]=="stick")
        {
            for($i=0; $i < count($inventory); $i++)
            {
                if($inventory[$i][0]=="plank")
                {
                    $inventory[$i][1]--;
                    add_to_inventory($inventory,"stick");
                }
            }
        }
    }
?>