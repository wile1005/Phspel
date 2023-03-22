<?php
    function generate_world()
    {
        ini_set('memory_limit','4G');
        include "World_generation/Border_fixer.php";
        include "World_generation/Ocean_generator.php";
        include "World_generation/Mountain_generator.php";
        //variabler
        $worldsize = 25;
        $map = array_fill(0,$worldsize,1);
        for($i=0; $i < count($map); $i++)
        {
            $map[$i] = array_fill(0,$worldsize,1);
        }

        //bla bla bla loggin till mysql
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "phspel";

        //connects to mysqli server
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        //deseart generator
        //todo

        //mountain generator
        Mountain_generator($map,$worldsize);

        //ocean generator
        ocean_generator($map,$worldsize);

        //tree placer
        for($X=0; $X < count($map); $X++)
        {
            for($Y=0; $Y < count($map[1]); $Y++)
            {
                if(rand(1,10) < 2&&$map[$X][$Y]==1)
                {
                    $map[$X][$Y] = 2;
                }
            }
        }

        $map = border_fix($map,$worldsize);
        


        //tar map och gör omvandlar den till background
        $background = array_merge(array(), $map);
        for($X=0; $X < count($map); $X++)
        {
            for($Y=0; $Y < count($map[1]); $Y++)
            {
                if(preg_match('/[1-2]+/', $map[$X][$Y]))
                {
                    $background[$X][$Y]="a1";
                }else if(preg_match('/[4-7]+/', $map[$X][$Y]))
                {
                    $background[$X][$Y]="a2";
                }if($map[$X][$Y]==10)
                {
                    $background[$X][$Y]="a3";
                }
            }
        }
        $sql = "SELECT `map`,`background` FROM `world`";

        $sql = "UPDATE `world` SET `background` = '".json_encode($background)."' WHERE `world`.`id` = 1;";
        $result = $conn->query($sql);
        
        $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = 1;";
        $result = $conn->query($sql);
    }
?>