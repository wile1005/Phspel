<?php
    function filter(&$message)
    {
        $filter = array
        (
            "<",
            ">",
            "vatsug"
        );  
        foreach($filter as $string_to_remove)
        {
            $message = str_replace('$string_to_remove', '', $message);
        }
    }
?>