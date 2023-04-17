<?php
    function generate_world()
    {
        ini_set('memory_limit','4G');
        include "Database/Database_login.php";
        include "World_generation/Border_fixer.php";
        include "World_generation/Ocean_generator.php";
        include "World_generation/Mountain_generator.php";
        include "World_generation/Desert_generator.php";
        include "World_generation/Tree_placer.php";
        include "World_generation/Beach_fixer.php";
        include "World_generation/Cactus_planter.php";
        include "World_generation/Hole_fixer.php";
        include "World_generation/Ore_generator.php";
        include "World_generation/Stairs_generation.php";

        //variabler
        $map;
        $worldsize = 110;

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

                //generates ores
                ore_generator($map,$worldsize);

                $map = border_fix($map,$worldsize);
            }else
            {
                //skapar grottor
                $map = array_fill(0,$worldsize,5);
                for($i=0; $i < count($map); $i++)
                {
                    $map[$i] = array_fill(0,$worldsize,5);
                }
            }

            //tar map och gör omvandlar den till background
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