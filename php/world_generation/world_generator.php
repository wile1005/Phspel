<?php
    function generate_world()
    {
        //sätter max minnet till 4gb och loggar in i databasen
        ini_set('memory_limit','4G');
        include "Database/Database_login.php";

        //includar alla worldgen filer
        foreach (glob("world_generation/*.php") as $file) 
        {
            include_once $file;
        }

        //variabler
        $map;
        $worldsize = 100;

        for($layer=1; $layer < 4; $layer++)
        {
            $map = array();
            //skapar världen
            if($layer==1)
            {
                //skapar overworld
                $map = array_fill(0,$worldsize,1);
                for($i=0; $i < count($map); $i++)
                {
                    $map[$i] = array_fill(0,$worldsize,1);
                }
                //deseart generator
                Desert_generator($map,$worldsize);

                //ocean generator
                ocean_generator($map,$worldsize);

                //mountain generator
                Mountain_generator($map,$worldsize);

                //fixes holes in the map
                hole_fixer($map,$worldsize);

                //tree placer
                tree_placer($map,$worldsize);

                //cactus placer
                cactus_placer($map,$worldsize);
                
                //fixes holes in the map
                hole_fixer($map,$worldsize);

                //beach fixer
                beach_fixer($map,$worldsize);

                //fixes holes in the map
                hole_fixer($map,$worldsize);

                $map = border_fix($map,$worldsize);
            }else
            {
                //om lagret är under 1 skapar den grottor istället för en overworld
                $map = array_fill(0,$worldsize,5);
                for($i=0; $i < count($map); $i++)
                {
                    $map[$i] = array_fill(0,$worldsize,5);
                }

                //skapar grottor
                cave_generator($map,$worldsize);

                //generates ores
                ore_generator($map,$worldsize);

                $map = border_fix($map,$worldsize);
            }

            //tar $map och omvandlar den till background
            $background = array_merge(array(), $map);
            for($X=0; $X < count($map); $X++)
            {
                for($Y=0; $Y < count($map[1]); $Y++)
                {
                    if(in_range($map[$X][$Y],1,2))
                    {
                        $background[$X][$Y]="a1";
                    }elseif(in_range($map[$X][$Y],4,7))
                    {
                        $background[$X][$Y]="a2";
                    }elseif($map[$X][$Y]==10)
                    {
                        $background[$X][$Y]="a3";
                    }elseif(in_range($map[$X][$Y],11,12))
                    {
                        $background[$X][$Y]="a4";
                    }elseif(in_range($map[$X][$Y],13,13))
                    {
                        $background[$X][$Y]="a2";
                    }
                }
            }

            //updaterar map och background
            $sql = "SELECT `map`,`background` FROM `world`";

            $sql = "UPDATE `world` SET `background` = '".json_encode($background)."' WHERE `world`.`Layer` = ".$layer.";";
            $result = $conn->query($sql);
            
            $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`Layer` = ".$layer.";";
            $result = $conn->query($sql);
        }

        //genererar trappor mellan varje våning
        Stairs_generator($worldsize);
    }
?>