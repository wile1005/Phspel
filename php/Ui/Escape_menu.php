<?php
    //menu items vissible in ui
    $escape_menu_items = array
    (
        "Back to game",
        "Options",
        "Logout"
    );

    function escape_menu($menu_items,&$num)
    {
        switch($menu_items[$num])
        {
            case"Back to game":
            $_SESSION["ui"]="none";
            break;

            case"Options";
            $_SESSION["ui"]="options";
            $num=0;
            break;

            case"Logout";
            $_SESSION["id"]="logout";
            break;

            case"Reset";
            reset_func();
            $_SESSION["ui"]="reset";
            break;
        }
    }
?>