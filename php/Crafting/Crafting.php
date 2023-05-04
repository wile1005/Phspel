<?php
    function craft($recipes,&$inventory,$num,$craftmode)
    {
        $can_craft=false;
        for($i=2; $i < count($recipes[$num]); $i++)
        {
            //om find_item() hittar itemet går den vidare 
            if(find_item($inventory,$recipes[$num][$i][0])!="not found")
            {
                if($inventory[find_item($inventory,$recipes[$num][$i][0])][1]>$recipes[$num][$i][1]-1)
                {
                    $can_craft=true;
                }else
                {
                    $can_craft=false;
                    break;
                }
            }else
            {
                $can_craft=false;
                break;
            }
        }
        if($can_craft==true)
        {
            for($i=2; $i < count($recipes[$num]); $i++)
            {   
                $inventory[find_item($inventory,$recipes[$num][$i][0])][1]-=$recipes[$num][$i][1];
            }
            add_item_to_inventory($inventory,$recipes[$num][0],1);
        }
    }
?>