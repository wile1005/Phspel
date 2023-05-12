<?php
    function set_ui(&$num,$craftmode,$newui,$recipes)
    {
        switch ($newui)
        {
            case "inventory":
                //öppnar inventoryt
                if($_SESSION["ui"]!="inventory")
                {
                    $num=0;
                    $_SESSION["ui"]="inventory";
                }else
                {
                    $_SESSION["ui"]="none";
                }
                break;

            case "crafting":
                //öppnar crafting menyn
                if($_SESSION["ui"]!="crafting")
                {
                    for($i=0; $i<count($recipes); $i++)
                    {
                        if($recipes[$i][1]==$craftmode)
                        {
                            $num = $i;
                            break;
                        }
                    }
                    $_SESSION["ui"]="crafting";
                }else
                {
                    $_SESSION["ui"]="none";
                }
                break;

            case "escape":
                //öppnar escape menyn
                if($_SESSION["ui"]=="none")
                {
                    $num=0;
                    $_SESSION["ui"]="escape";
                }elseif($_SESSION["ui"]!="escape")
                {
                    $_SESSION["ui"]="none";
                }else
                {
                    $_SESSION["ui"]="none";
                }
                break;

            case"chat":
                //öppnar inventoryt
                if($_SESSION["ui"]!="chat")
                {
                    $_SESSION["ui"]="chat";
                }else
                {
                    $_SESSION["ui"]="none";
                }
                break;
        }   
        
    }
?>