<?php
    function place(&$inventory,&$map,$playerX,$playerY,$num)
    {
        include "Database/Database_login.php";
        
        if($map[$playerX][$playerY]!=17&&$map[$playerX][$playerY]!=18)
        {
            switch($inventory[$num]) 
            {
                case 'workbench': 
                $inventory[$num] = "null";
                $map[$playerX][$playerY]=3;
                break;

                case 'furnace': 
                $inventory[$num] = "null";
                $map[$playerX][$playerY]=9;
                break;

                case 'wood_wall': 
                $inventory[$num] = "null";
                $map[$playerX][$playerY]=14;
                break;

                case 'stone_wall': 
                $inventory[$num] = "null";
                $map[$playerX][$playerY]=15;
                break;

                case 'anvil': 
                    $inventory[$num] = "null";
                    $map[$playerX][$playerY]=16;
                    break;

                default:
                    $craftmode = "none";
                    break;
            }
        }

    }
?>