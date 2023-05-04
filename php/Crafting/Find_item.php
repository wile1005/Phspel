<?php
    function find_item($inventory,$item)
    {
        //returns index of item in inventory
        for($i=0; $i < count($inventory); $i++)
        {
            if($inventory[$i][0]==$item)
            {
                return $i;
            }
        }
        return "not found";
    }
?>