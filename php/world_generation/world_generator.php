<?php
    function generate_world()
    {
        //sätter max minnet till 4gb och loggar in i databasen
        ini_set('memory_limit','4G');
        include "Database/Database_login.php";

        //includar alla worldgen filer
        foreach (glob("{world_generation/*.php}", GLOB_BRACE) as $file) 
        {
            include_once $file;
        }

        for($layer=1; $layer < 4; $layer++)
        {
            $map = array();
            $background_map = array();
            //skapar världen
            if($layer==1)
            {
                //skapar overworld
                $map = array_fill(0,$worldsize,1);
                $background_map = array_fill(0,$worldsize,1);
                for($i=0; $i < count($map); $i++)
                {
                    $map[$i] = array_fill(0,$worldsize,0);
                    $background_map[$i] = array_fill(0,$worldsize,1);
                }

                biome_generator($background_map,$oceansize,$oceanfrequency,2);
                
                //beach fixer
                beach_fixer($background_map,$worldsize);

                Mountain_generator($map,$background_map,$worldsize,$mountainsize,$mountainfrequency);
                
                //fixes holes in the map
                hole_fixer($map,$worldsize);

                Plant_placer($map,$background_map,1,2,50);

                $map = border_fix($map,$worldsize);
            }else
            {
                //om lagret är under 1 skapar den grottor istället för en overworld
                $map = array_fill(0,$worldsize,5);
                for($i=0; $i < count($map); $i++)
                {
                    $map[$i] = array_fill(0,$worldsize,5);
                }

                $map = border_fix($map,$worldsize);
            }

            //updaterar map och background
            $sql = "SELECT `map`,`background` FROM `map`";

            $sql = "UPDATE `world` SET `background` = '".json_encode($background_map)."' WHERE `world`.`id` = ".$layer.";";
            $result = $conn->query($sql);
            
            $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = ".$layer.";";
            $result = $conn->query($sql);
        }
        //genererar trappor mellan varje våning
        //Stairs_generator($worldsize);
        echo("world done!");
    }
    function in_range($value,$min,$max)
    {
        if(($min <= $value) && ($value <= $max))
        {
            return(true);
        }
    }
?>