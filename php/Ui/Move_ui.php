<?php
    function move_ui($direction,&$num,$craftmode,$recepies,$inventory,$escape_menu_items,$option_menu_items)
    {
        switch ($direction.".".$_SESSION["ui"])
        {
            case "upp.crafting":
            if(isset($recepies[$num-1])&&$recepies[$num-1][1]==$craftmode)
            {
                $num--;
            }
            break;

            case "down.crafting":
            if(isset($recepies[$num+1])&&$recepies[$num+1][1]==$craftmode)
            {
                $num++;
            }
            break;

            case "upp.inventory":
            if($num>0)
            {
                $num--;
            }
            break;

            case "down.inventory":
            if($num<count($inventory)-1)
            {
                $num++;
            }
            break;

            case "upp.escape":
            if($num>0)
            {
                $num--;
            }
            break;

            case "down.escape":
            if($num<count($escape_menu_items)-1)
            {
                $num++;
            }
            break;

            case "upp.options":
            if($num>0)
            {
                $num--;
            }
            break;

            case "down.options":
            if($num<count($option_menu_items)-1)
            {
                $num++;
            }
            break;
        }
    }
?>