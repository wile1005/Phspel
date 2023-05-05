<?php
    function set_ui(&$num,$craftmode,$newui,$recipes)
    {
        switch ($newui)
        {
            case "inventory":
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
        }   
        
    }
?>