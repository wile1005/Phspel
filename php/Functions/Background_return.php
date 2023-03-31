<?php
    function background_return(&$map,$X,$Y,$background)
    {
        switch($background[$X][$Y])
        {
            case "a1":
                $map[$X][$Y]=1;
                break;
                
            case "a2":
                $map[$X][$Y]=4;
                break;

            case "a3":
                $map[$X][$Y]=10;
                break;

            case "a4":
                $map[$X][$Y]=11;
                break;
        }
    }
?>