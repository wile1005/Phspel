<style>#game{visibility:hidden;height:0;}</style>
<link rel="stylesheet" href="../scss/Debug.css">
<div id="game">
    <h1>PHsPel</h1>
    <form class="" method="post">
        <input id="up" type="submit" name="upp" class="button" value="Upp" />
        <input id="down" type="submit" name="down" class="button" value="Down" />
        <input id="left" type="submit" name="left" class="button" value="Left" />
        <input id="right" type="submit" name="right" class="button" value="Right" />
        <input id="enter" type="submit" name="enter" class="button" value="Enter" />
        <input id="pickup" type="submit" name="pickup" class="button" value="Pickup" />
        <input id="reset" type="submit" name="reset" class="button" value="Reset" />
        <input id="drop" type="submit" name="drop" class="button" value="Drop" />
        <input id="inventory" type="submit" name="inventory" class="button" value="Inventory" />
        <input id="crafting" type="submit" name="crafting" class="button" value="Crafting" />
    </form>
<?php
    //debug läget (visar mer info)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $debug = true;

    // includar alla nödvändiga filer
    //includar alla worldgen filer
    foreach (glob("{Functions,Plugins,Database,Crafting}/*.php", GLOB_BRACE) as $file) 
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

    //öppnar / stänger inventoriet
    if(array_key_exists('inventory', $_POST))
    {
        if($_SESSION["ui"]!="inventory")
        {
            $_SESSION["ui"]="inventory";
        }else
        {
            $_SESSION["ui"]="none";
        }
    }

    //öppnar / stänger crafting menyn
    if(array_key_exists('crafting', $_POST))
    {
        if($_SESSION["ui"]!="crafting")
        {
            $_SESSION["ui"]="crafting";
        }else
        {
            $_SESSION["ui"]="none";
        }
    }

    //kollar så att spelaren inte har invenoriet öppet
    if($_SESSION["ui"]=="none")
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

        //kod för att plocka up items (funkar inte)
        if(array_key_exists('pickup', $_POST))
        {
            pickup($map,$playerX,$playerY,$inventory,$num,$background);
        }

        //placerar ut itemet spelaren håller i
        if(array_key_exists('enter', $_POST))
        {
            place($inventory,$map,$playerX,$playerY,$num);
        }  
    }else
    {
        //kontroller för ui
        if(array_key_exists('upp', $_POST)&&$num>0)
        {
            $num--;
        }else if(array_key_exists('down', $_POST))
        {
            $num++;
        }else if(array_key_exists('enter', $_POST))
        {
            craft($recipes,$inventory,$num,$craftmode);
        }
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