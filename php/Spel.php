<style>#inputs{visibility:visible;height:0;}</style>
<div id="inputs">
    <form class="" method="post">
        <h1>PHsPel</h1>
        <input id="up" type="submit" name="upp" class="button" value="upp" />
        <input id="down" type="submit" name="down" class="button" value="down" />
        <input id="left" type="submit" name="left" class="button" value="left" />
        <input id="right" type="submit" name="right" class="button" value="right" />
        <input id="place" type="submit" name="place" class="button" value="place" />
        <input id="pickup" type="submit" name="pickup" class="button" value="pickup" />
        <input id="reset" type="submit" name="reset" class="button" value="reset" />
        <input id="drop" type="submit" name="drop" class="button" value="drop" />
    </form>
    <form class="" method="post">
        <input id="1" type="submit" name="1" class="button" value="1" />
        <input id="2" type="submit" name="2" class="button" value="2" />
        <input id="3" type="submit" name="3" class="button" value="3" />
        <input id="4" type="submit" name="4" class="button" value="4" />
        <input id="5" type="submit" name="5" class="button" value="5" />
        <input id="6" type="submit" name="6" class="button" value="6" />
        <input id="7" type="submit" name="7" class="button" value="7" />
    </form>
</div>
<?php
    //debug läget (visar mer info)
    $debug = true;

    // includar andra php filer (funktioner)
    include "World_generation/Cave_generator.php";
    include "World_generation/World_generator.php";
    include "Functions/Movecheck_function.php";
    include "Functions/Reset_function.php";
    include "Functions/Place_function.php";
    include "Functions/Hit_function.php";
    include "Functions/Drop_function.php";
    include "Functions/Craftmode_function.php";
    include "Database/Get_map.php";
    include "Database/Update_database.php";
    include "Database/Get_player_variables.php";

    //startar sessionen och hämtar databasen
    session_start();
    include "Database/Database_login.php";

    //hämtar spelar variabler och kartan
    get_player_variables($current_floor,$playerX,$playerY,$num,$craftmode,$inventory);
    get_map($map,$background,$current_floor);

    //rörelsekod för spelet
    if(array_key_exists('upp', $_POST))
    {
    //Rörelse kod för up
        if (movecheck($map, $playerX-1, $playerY)==true)
        {
            $playerX -= 1;
        }else
        {
            hit($map,$playerX-1,$playerY,$inventory,$num,$background);
        }

    }else if(array_key_exists('down', $_POST))
    {
    //Rörelse kod för ner
        if (movecheck($map, $playerX+1, $playerY)==true)
        {
            $playerX += 1;
        }else
        {
            hit($map,$playerX+1,$playerY,$inventory,$num,$background);
        }

    }else if(array_key_exists('left', $_POST))
    {
    //Rörelse kod för vänster
        if (movecheck($map, $playerX, $playerY-1)==true)
        {
            $playerY -= 1;
        }else
        {
            hit($map,$playerX,$playerY-1,$inventory,$num,$background);
        }

    }else if(array_key_exists('right', $_POST))
    {
    //Rörelse kod för höger
        if (movecheck($map, $playerX, $playerY+1)==true)
        {
            $playerY += 1;
        }else
        {
            hit($map,$playerX,$playerY+1,$inventory,$num,$background);
        }
    }
    //kollar ifall spelaren står på en trappa ner eller up
    if($map[$playerX][$playerY]==17)
    {
        $current_floor++;
        $playerX += rand(-1,1);
        $playerY += rand(-1,1);
        // hämtar mapen
        get_map($map,$background,$current_floor);

        update_database($map,$playerX,$playerY,$inventory,$num,$background,$current_floor,$craftmode);
    }elseif($map[$playerX][$playerY]==18)
    {
        $current_floor--;
        $playerX += rand(-1,1);
        $playerY += rand(-1,1);
        // hämtar mapen
        get_map($map,$background,$current_floor);

        update_database($map,$playerX,$playerY,$inventory,$num,$background,$current_floor,$craftmode);
    }
    //ändrar vilken inventory slot som är selectad
    foreach($_POST as $key => $value) 
    {
        if(is_numeric($key)) 
        {
            $num = $key - 1;
            break;
        }
    }

    //tar bort itemet i spelarens valda hotbar slot
    if(array_key_exists('drop', $_POST))
    {
        drop($inventory,$num);
    }   

    //placerar ut itemet spelaren håller i
    if(array_key_exists('place', $_POST))
    {
        place($inventory,$map,$playerX,$playerY,$num);
    }     

    //hämtar craftmode beroende på tilen under
    get_craftmode($map, $playerX, $playerY, $craftmode);
    
    //updaterar databasen
    update_database($map,$playerX,$playerY,$inventory,$num,$background,$current_floor,$craftmode);


    if($debug==true)
    {
        $sql = "SELECT `playerX`,`playerY`,`inventory`,`id` FROM `player`;";
        $result = $conn->query($sql);

        if ($result === false) 
        {
            echo "Error: " . mysqli_error($conn);
        } else 
        {
            while($row = $result->fetch_assoc()) 
            {
                if($_SESSION["id"]==$row["id"])
                {
                    echo("Debug: info, ");
                    echo("ID: ".$row["id"]);
                    echo(", Position: ".$row["playerX"]."x,".$row["playerY"]."y, ");
                    echo("Inventory: ".$row["inventory"]." ");
                    echo("num: ".$num." ");
                    echo("Craftmode: ".$craftmode);
                    echo(", Standing on: ".$map[$row["playerX"]][$row["playerY"]]);
                }
            }
        }
        function convert($size)
        {
            $unit=array('b','kb','mb','gb','tb','pb');
            return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
        }

        echo ", memory usage: ". convert(memory_get_usage(true)); // 123 kb
    }   
?>
<?php include 'Javascript.php';?>