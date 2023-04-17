<?php
    function get_craftmode(&$map, $X, $Y, &$craftmode)
    {
        switch($map[$X][$Y])
        {
            case 3:
                $craftmode="workbench";
                break;

            case 9:
                $craftmode="furnace";
                break;
            
            case 16:
                $craftmode="anvil";
                break;

            default:
                $craftmode = "none";
                break;
        }
    }
?>