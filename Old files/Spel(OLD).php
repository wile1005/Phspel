<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../scss/css.css">
  </head>
  <body>
    <div id="wrap">
      <div id="spel">

        <form class="" method="post">
          <h1>PhSpel</h1>
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
        </form>

        <div id="php">
          <?php
            echo "<P>";

            //startar sessionen
            session_start();
            //session_destroy();

            $debug=true;

            //loggin till databasen
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

            //hämtar player variabler (player_x, player_y, inventory från player)
            $sql = "SELECT `id`,`playerX`,`playerY`,`inventory` FROM `player`";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc())
            {
              if($row["id"]==$_SESSION["playerid"])
              {
                $player_X=$row["playerX"];
                $player_Y=$row["playerY"];
                //$inventory=json_decode($row["Inventory"]);
              }
            }


            //fixar variabler (ska försöka tas bort)
            $_SESSION["num"];
            $_SESSION["craftmode"];
            $_SESSION["background"];


            //initializerar inventoryt
            if ($_SESSION["craftmode"] === null || $_SESSION["inventory"] === null)
            {
              $_SESSION["craftmode"] = "null";
              $_SESSION["inventory"] = array("null","null","null","null","null");
            }

            //hämtar map från world och omvandlar strigen till en array 2d
            $sql = "SELECT `map` FROM `world`";
            while($row = $result->fetch_assoc())
            {
              $map=json_decode($row["map"]);
              Map_to_background();
            }


            //rörelsekod för spelet
            if(array_key_exists('upp', $_POST))
            {
              //Rörelse kod för up
              if (movecheck($map, $player_X-=1, $player_Y)==true)
              {
                $player_X -= 1;
              }else
              {
                hit($player_X-1,$player_Y,$conn);
              }

            }else if(array_key_exists('down', $_POST))
            {
              //Rörelse kod för ner
              if (movecheck($map, $player_X+=1, $player_Y)==true)
              {
                $player_X += 1;
              }else
              {
                hit($player_X+1,$player_Y,$conn);
              }

            }else if(array_key_exists('left', $_POST))
            {
              //Rörelse kod för vänster
              if (movecheck($map, $player_X, $player_Y-=1)==true)
              {
                $player_Y -= 1;
              }else
              {
                hit($player_X,$player_Y-1,$conn);
              }

            }else if(array_key_exists('right', $_POST))
            {
              //Rörelse kod för höger
              if (movecheck($map, $player_X, $player_Y+=1)==true)
              {
                $player_Y += 1;
              }else
              {
                hit($player_X,$player_Y+1,$conn);
              }
            }


            //ändrar vilken inventory slot som är selectad
            foreach($_POST as $key => $value) 
            {
              if(is_numeric($key)) {
                  $_SESSION["num"] = $key - 1;
                  break;
              }
            }


            //funktion som nollställer databasen och några session variabler
            if(array_key_exists('reset', $_POST))
            {
              $sql = "SELECT `id`,`playerX`,`playerY`,`inventory` FROM `player`";
              $result = $conn->query($sql);
              $inventory = json_encode($_SESSION["inventory"]);
              while($row = $result->fetch_assoc())
              {
                $sql = "UPDATE `player` SET `playerX`,`playerY`,`Inventory` = '2','2','$inventory' WHERE `player`.`id` = ".$row["id"].";";
              }
              $_SESSION["inventory"] = array("null","null","null","null","null");
              //kartan där olika nummer är olika items
              //generate_world();
              $map = array(
                  array(8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8),
                  array(8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 5, 5, 5, 7, 7, 7, 8),
                  array(8, 1, 1, 2, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 4, 5, 5, 7, 6, 6, 8),
                  array(8, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 4, 5, 4, 5, 6, 6, 8),
                  array(8, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 4, 5, 6, 5, 8),
                  array(8, 1, 1, 2, 2, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 5, 5, 8),
                  array(8, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 4, 8),
                  array(8, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8),
                  array(8, 1, 1, 2, 2, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8),
                  array(8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8),
                  array(8, 1, 1, 2, 2, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8),
                  array(8, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 8),
                  array(8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8),
              );
              //kartan där olika a nummer är olika bakgrunder
              Map_to_background();
              $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = 1;";
              $result = $conn->query($sql);
            }


            //placerar object
            if(array_key_exists('place', $_POST))
            {
              for ($i=0; $i < 5; $i++)
              {
                if ($_SESSION["inventory"][$i]=="workbench"&&$map[$player_X][$player_Y]!=3 && $_SESSION["num"] == $i)
                {
                  $_SESSION["inventory"][$i] = "null";
                  $map[$player_X][$player_Y]=3;
                  break;
                }elseif ($_SESSION["inventory"][$i]=="Furnace"&&$map[$player_X][$player_Y]!=9 && $_SESSION["num"] == $i)
                {
                  $_SESSION["inventory"][$i] = "null";
                  $map[$player_X][$player_Y]=9;
                  break;
                }
              }
            }


            //kastar bort ett object
            if (array_key_exists('drop', $_POST))
            {
              $_SESSION[$_SESSION["num"]] = "null";
            }


            //plockar upp ett object
            else if(array_key_exists('pickup', $_POST))
            {

              for ($i=0; $i < 5; $i++)
              {
                if ($_SESSION["inventory"][$i]=="null"&&$map[$player_X][$player_Y]==9 && $_SESSION["num"]==$i)
                {
                  //kollar vilke§n bakgrund som är under spelarn och sätter ut motsvarande objekt
                  if($_SESSION["background"][$player_X][$player_Y]=="a1")
                  {
                    $map[$player_X][$player_Y]=1;
                    $_SESSION["inventory"][$i] = "Furnace";
                    break;
                  }elseif($_SESSION["background"][$player_X][$player_Y]=="a2")
                  {
                    $map[$player_X][$player_Y]=4;
                    $_SESSION["inventory"][$i] = "Furnace";
                    break;
                  }
                }else if ($_SESSION["inventory"][$i]=="null"&&$map[$player_X][$player_Y]==3 && $_SESSION["num"]==$i)
                {
                  //kollar vilke§n bakgrund som är under spelarn och sätter ut motsvarande objekt
                  if($_SESSION["background"][$player_X][$player_Y]=="a1")
                  {
                    $map[$player_X][$player_Y]=1;
                    $_SESSION["inventory"][$i] = "workbench";
                    break;
                  }elseif($_SESSION["background"][$player_X][$player_Y]=="a2")
                  {
                    $map[$player_X][$player_Y]=4;
                    $_SESSION["inventory"][$i] = "workbench";
                    break;
                  }
                }
              }
            }


            //FUNKTIONER


            //tar map och gör omvandlar den till background
            function Map_to_background()
            {
              for($X=0; $X < count($map); $X++)
              {
                for($Y=0; $Y < count($map[1]); $Y++)
                {
                  if(preg_match('/[1-2]+/', $map[$X][$Y]))
                  {
                    $_SESSION["background"][$X][$Y]="a1";
                  }else if(preg_match('/[4-7]+/', $map[$X][$Y]))
                  {
                    $_SESSION["background"][$X][$Y]="a2";
                  }else
                  {
                    $_SESSION["background"][$X][$Y]="a0";
                  }
                }
              }
            }


            //kollar om tilen kan bli slagen
            function hit($player_X ,$player_Y, $conn)
            {
              echo($player_X." ".$player_Y);
              if ($map[$player_X][$player_Y]==2)
              {
                $map[$player_X][$player_Y]=1;
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "null")
                  {
                    $_SESSION["inventory"][$i] = "log";
                    break;
                  }
                }
                echo "hit tree, ";
              }
              if ($map[$player_X][$player_Y]==5)
              {
                echo "hit stone, ";
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "Wood_pickaxe"&&$_SESSION["num"]==$i||$_SESSION["inventory"][$i] == "stone_pickaxe"&&$_SESSION["num"]==$i)
                  {
                    $map[$player_X][$player_Y]=4;
                    for ($j=0; $j < 5; $j++)
                    {
                      if ($_SESSION["inventory"][$j] == "null")
                      {
                        $_SESSION["inventory"][$j] = "stone";
                        break;
                      }
                    }
                  }
                }
              }
              if ($map[$player_X][$player_Y]==6)
              {
                echo "hit iron ore, ";
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "stone_pickaxe"&&$_SESSION["num"]==$i)
                  {
                    $map[$player_X][$player_Y]=4;
                    for ($j=0; $j < 5; $j++)
                    {
                      if ($_SESSION["inventory"][$j] == "null")
                      {
                        $_SESSION["inventory"][$j] = "raw_iron";
                        break;
                      }
                    }
                  }
                }
              }
              if ($map[$player_X][$player_Y]==7)
              {
                echo "hit redstone ore, ";
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "iron_pickaxe"&&$_SESSION["num"]==$i)
                  {
                    $map[$player_X][$player_Y]=4;
                    for ($j=0; $j < 5; $j++)
                    {
                      if ($_SESSION["inventory"][$j] == "null")
                      {
                        $_SESSION["inventory"][$j] = "redstone";
                        break;
                      }
                    }
                  }
                }
              }
            }

            //checkar om spelaren kan ta sig till nästa tile
            function movecheck($array, $playerX, $playerY)
            {
              if ($array[$playerX][$playerY] == 2||$array[$playerX][$playerY]==5||$array[$playerX][$playerY]==6||$array[$playerX][$playerY]==7||$array[$playerX][$playerY]==8)
              {
                return(false);
              }else
              {
                return(true);
              }

            }


            //updaterar världen med nya arrayen
            $result = $conn->query($sql);
            $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = 1;";
            $result = $conn->query($sql);


            //updaterar spelarens värden
            $inventory = json_encode($_SESSION["inventory"]);
            $sql = "SELECT `id`,`playerX`,`playerY`,`inventory` FROM `player`";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc())
            {
              $sql = "UPDATE `player` SET `playerX`,`playerY`,`Inventory` = '$player_X','$player_Y','$inventory' WHERE `player`.`id` = ".$_SESSION["playerid"].";";
            }


            //Debug info
            if($debug==true)
            {
              echo ("Player id: ".$_SESSION["playerid"].", ");
              echo ("Position: X".$player_X." Y".$player_Y." , ");

            }

            echo "</P>";

          ?>
	        <div class="result"></div>
          <br>
        </div>
      </div>
        <div>
          <?php include "Worldgen.php";?>
          <?php include "Javascript.php";?>
          <?php include "Crafting.php";?>
        </div>
    </div>
  </body>
</html>
