<?php
    function place(&$inventory,&$map,$playerX,$playerY,&$holding)
    {
        include "Database/Database_login.php";

        if($map[$playerX][$playerY]!=17&&$map[$playerX][$playerY]!=18)
        {
            switch($holding)
            {
                case "workbench":
                    remove_item_from_inventory($inventory,"workbench",1);
                    $map[$playerX][$playerY]=3;
                    $holding = "none";
                    break;
                
                case "furnace":
                    remove_item_from_inventory($inventory,"furnace",1);
                    $map[$playerX][$playerY]=9;
                    $holding = "none";
                    break;
            }
        }

    }
?>