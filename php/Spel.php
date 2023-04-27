<style>#game{visibility:hidden;height:0;}</style>
<link rel="stylesheet" href="../scss/Debug.css">
<div id="game">
    <h1>PHsPel</h1>
    <form class="" method="post">
        <input id="up" type="submit" name="upp" class="button" value="Upp" />
        <input id="down" type="submit" name="down" class="button" value="Down" />
        <input id="left" type="submit" name="left" class="button" value="Left" />
        <input id="right" type="submit" name="right" class="button" value="Right" />
        <input id="place" type="submit" name="place" class="button" value="Place" />
        <input id="pickup" type="submit" name="pickup" class="button" value="Pickup" />
        <input id="reset" type="submit" name="reset" class="button" value="Reset" />
        <input id="drop" type="submit" name="drop" class="button" value="Drop" />
        <input id="inventory" type="submit" name="inventory" class="button" value="Inventory" />
        <input id="crafting" type="submit" name="crafting" class="button" value="Crafting" />
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
<?php
    //debug läget (visar mer info)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $debug = true;

    // includar alla nödvändiga filer
    //includar alla worldgen filer
    foreach (glob("{Functions,Plugins,Database}/*.php", GLOB_BRACE) as $file) 
    {
        include $file;
    }
    include "World_generation/World_generator.php";
    include "Database/Database_login.php";

    //startar sessionen
    if(session_status()!=2)
    {
        session_start();
    }
    

    //hämtar spelar variabler och kartan
    get_player_variables($current_floor,$playerX,$playerY,$num,$craftmode,$inventory);
    get_map($map,$background,$current_floor);

    if(array_key_exists('inventory', $_POST))
    {
        if($_SESSION["showui"]==false)
        {
            $_SESSION["showui"]=true;
        }else
        {
            $_SESSION["showui"]=false;
        }
    }

    if($_SESSION["showui"]==false)
    {
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
    }else
    {
        if(array_key_exists('upp', $_POST))
        {
            $num--;
        }else if(array_key_exists('down', $_POST))
        {
            $num++;
        }
    }

    //kod för att plocka up items funkar inte
    if(array_key_exists('pickup', $_POST))
    {
        pickup($map,$playerX,$playerY,$inventory,$num,$background);
    }

    //resetar alla spelare och genererar om världen (funkar inte :( )
    if(array_key_exists('reset', $_POST))
    {
        reset_func();
        //hämtar dom nya grejorna(mapen spelare)
        get_player_variables($current_floor,$playerX,$playerY,$num,$craftmode,$inventory);
        get_map($map,$background,$current_floor);
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
    
    //kollar om spelaren står på en trappa upp/ner (förstör saker därför i denna if sats)
    if(!stairscheck($map,$playerX,$playerY,$current_floor))
    {
        //hämtar craftmode beroende på tilen under
        get_craftmode($map, $playerX, $playerY, $craftmode);

        //updaterar databasen
        update_map($map,$background,$current_floor);
    }

    update_player($map,$playerX,$playerY,$inventory,$num,$current_floor,$craftmode);

    function convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }

    if($debug==true)
    {
        $sql = "SELECT `id`,`playerX`,`playerY`,`floor`,`inventory`,`num`,`craftmode` FROM `player` WHERE `player`.`id` = ".$_SESSION["id"]."";
        $result = $conn->query($sql);
        $row = $result -> fetch_array(MYSQLI_ASSOC);
        if ($result === false) 
        {
            echo "Error: " . mysqli_error($conn);
        } else 
        {
            echo("<style>#game{visibility:visible;height:0;}</style>");
            echo("<div id = 'debug'>");
            echo("<p class ='debug'>Debug info </p>");
            echo("<p class ='debug'>ID: ".$row["id"]."</p>");
            echo("<p class ='debug'>Position: ".$row["playerX"]."x,".$row["playerY"]."y </p>");
            echo("<p class ='debug'>Floor: ".$row["floor"]."</p>");
            echo("<p class ='debug'>Inventory: ".$row["inventory"]."</p>");
            echo("<p class ='debug'>Num: ".$num."</p>");
            echo("<p class ='debug'>Craftmode: ".$craftmode."</p>");
            echo("<p class ='debug'>Standing on: ".$map[$row["playerX"]][$row["playerY"]]."</p>");
            echo("<p class ='debug'>Memory usage: ". convert(memory_get_usage(true))."</p>");
            echo("</div>");
        }
    }   
?>
</div>
<?php include 'Javascript.php';?>