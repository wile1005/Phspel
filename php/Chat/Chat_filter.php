<?php
    function chat_filter(&$message)
    {
        $message = str_replace('<', '', $message);
        $message = str_replace('>', '', $message);
    }  
?>