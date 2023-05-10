<?php
    //menu items vissible in ui
    $option_menu_items = array
    (
        "Back",
        "Toggle debug mode"
    );

    function options_menu($option_menu_items,$num)
    {
        switch($option_menu_items[$num])
        {
            case"Back":
            $_SESSION["ui"]="escape";
            break;

            case"Toggle debug mode":
            if($_SESSION["debug_mode"]==true)
            {
                $_SESSION["debug_mode"]=false;
            }else
            {
                $_SESSION["debug_mode"]=true;
            }
            break;
        }
    }
?>