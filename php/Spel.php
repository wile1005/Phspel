<head>
    <script src="Javascript.js" defer></script>
    <script src="https://code.jquery.com/jquery-latest.min.js" defer></script>
</head>
<style>#game{visibility:hidden;height:0;}</style>
<link rel="stylesheet" href="../scss/Debug.css">
<div id="game">
    <div id="debug">
        <h1>PHsPel</h1>
        <form class="" method="post">
            <input id="up" type="submit" name="upp" class="button" value="Upp" />
            <input id="down" type="submit" name="down" class="button" value="Down" />
            <input id="left" type="submit" name="left" class="button" value="Left" />
            <input id="right" type="submit" name="right" class="button" value="Right" />
            <input id="enter" type="submit" name="enter" class="button" value="Enter" />
            <input id="escape" type="submit" name="escape" class="button" value="Escape" />
            <input id="inventory" type="submit" name="inventory" class="button" value="Inventory" />
            <input id="crafting" type="submit" name="crafting" class="button" value="Crafting" />
            <input id="chat" type="submit" name="chat" class="button" value="Chat" />
        </form>
<?php
    //debug läget (visar mer info)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // includar alla nödvändiga filer
    //includar alla worldgen filer
    foreach (glob("{Functions,Plugins,Database,Crafting}/*.php", GLOB_BRACE) as $file) 
    {
        include $file;
    }
    include "World_generation/World_generator.php";
    include "Ui/Escape_menu.php";
    include "Ui/Options_menu.php";
    include "Ui/Set_ui.php";
    include "Ui/Move_ui.php";
    include "Database/Database_login.php";

    //startar sessionen
    if(session_status()!=2)
    {
        session_start();
    }

    //hämtar spelar variabler och kartan
    get_player_variables($current_floor,$playerX,$playerY,$num,$craftmode,$inventory,$holding);
    get_map($map,$background,$current_floor);

    switch(true)
    {
        //öppnar / stänger inventoriet
        case array_key_exists('inventory', $_POST):
        set_ui($num,$craftmode,"inventory",$recipes);
        break;

        //öppnar / stänger crafting menyn
        case array_key_exists('crafting', $_POST):
        set_ui($num,$craftmode,"crafting",$recipes);
        break;

        //öppnar / stänger escape meyn
        case array_key_exists('escape', $_POST):
        set_ui($num,$craftmode,"escape",$recipes);
        break;

        case array_key_exists('chat', $_POST):
        set_ui($num,$craftmode,"chat",$recipes);
        break;
    }
    

    //kollar så att spelaren inte har invenoriet öppet
    if($_SESSION["ui"]=="none")
    {
        //rörelsekod för spelet
        switch(true)
        {
            //Rörelse kod för up
            case array_key_exists('upp', $_POST):
            if (movecheck($map, $playerX-1, $playerY)==true)
            {
                $playerX -= 1;
            }else
            {
                hit($map,$playerX-1,$playerY,$inventory,$holding,$background);
            }
            break;

            //Rörelse kod för ner
            case array_key_exists('down', $_POST):
            if (movecheck($map, $playerX+1, $playerY)==true)
            {
                $playerX += 1;
            }else
            {
                hit($map,$playerX+1,$playerY,$inventory,$holding,$background);
            }
            break;

            //Rörelse kod för vänster
            case array_key_exists('left', $_POST):
            if (movecheck($map, $playerX, $playerY-1)==true)
            {
                $playerY -= 1;
            }else
            {
                hit($map,$playerX,$playerY-1,$inventory,$holding,$background);
            }
            break;

            //Rörelse kod för höger
            case array_key_exists('right', $_POST):
            if (movecheck($map, $playerX, $playerY+1)==true)
            {
                $playerY += 1;
            }else
            {
                hit($map,$playerX,$playerY+1,$inventory,$holding,$background);
            }
            break;

            //kod för att plocka up / lägga ner items
            case array_key_exists('enter', $_POST):
            pickup($map,$playerX,$playerY,$inventory,$background);
            place($inventory,$map,$playerX,$playerY,$holding);
            break;
        }
    }else
    {
        //kontroller för ui
        switch(true)
        {
            case array_key_exists('upp', $_POST):
            move_ui("upp",$num,$craftmode,$recipes,$inventory,$escape_menu_items,$option_menu_items);
            break;

            case array_key_exists('down', $_POST):
            move_ui("down",$num,$craftmode,$recipes,$inventory,$escape_menu_items,$option_menu_items);
            break;

            case array_key_exists('enter', $_POST)&&$_SESSION["ui"]=="crafting":
            craft($recipes,$inventory,$num,$craftmode);
            break;

            case array_key_exists('enter', $_POST)&&$_SESSION["ui"]=="escape":
            escape_menu($escape_menu_items,$num);
            break;
            
            //
            case array_key_exists('enter', $_POST)&&$_SESSION["ui"]=="options":
            options_menu($option_menu_items,$num);
            break;

            case array_key_exists('enter', $_POST)&&$_SESSION["ui"]=="inventory":
            //sätter vad spelaren håller i
            $holding = $inventory[$num][0];
            $moveinventory = $inventory[$num];
            unset($inventory[$num]);
            array_unshift($inventory, $moveinventory);
            $_SESSION["ui"]="none";
            break;
        }
    }

    //resetar alla spelare och genererar om världen (funkar? 🤔)
    if($_SESSION["ui"]=="reset")
    {
        $_SESSION["ui"]="none";
        get_player_variables($current_floor,$playerX,$playerY,$num,$craftmode,$inventory,$holding);
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

    update_player($map,$playerX,$playerY,$inventory,$num,$current_floor,$craftmode,$holding);

    function convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }

    if(isset($_SESSION["debug_mode"])&&$_SESSION["debug_mode"]==true)
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
            echo("<p>Debug info </p>");
            echo("<p>ID: ".$row["id"]."</p>");
            echo("<p>Position: ".$row["playerX"]."x,".$row["playerY"]."y </p>");
            echo("<p>Floor: ".$row["floor"]."</p>");
            echo("<p>Inventory: ".$row["inventory"]."</p>");
            echo("<p>Num: ".$num."</p>");
            echo("<p>Holding: ".$holding."</p>");
            echo("<p>Craftmode: ".$craftmode."</p>");
            echo("<p>Standing on: ".$map[$row["playerX"]][$row["playerY"]]."</p>");
            echo("<p>Ui: ".$_SESSION["ui"]."</p>");
            echo("<p>Memory usage: ". convert(memory_get_usage(true))."</p>");
            echo("</div>");
        }
    }   
?>