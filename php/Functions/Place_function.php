<?php
    function place(&$inventory,&$map,$playerX,$playerY,&$holding)
    {
        include "Database/Database_login.php";

        if($map[$playerX][$playerY]!=17&&$map[$playerX][$playerY]!=18)
        {
            switch($holding)
            {
                case 'workbench':
                $inventory[find_item($inventory,"workbench")][1]--;
                $map[$playerX][$playerY]=3;
                $holding = "none";
            }
        }

    }
?>