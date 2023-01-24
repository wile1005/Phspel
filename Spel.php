<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css.css">
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
            $sql = "SELECT `map` FROM `world` order by id desc limit 1";
            $result = $conn->query($sql);

            //fixar variabler
            $x_offset = 0;
            $y_offset = 0;
            $_SESSION["num"];
            $_SESSION["craftmode"];
            $_SESSION["player_X"];
            $_SESSION["player_Y"];
            $_SESSION["map"];
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
                $_SESSION["map"]=json_decode($row["map"]);
            }


            //rörelsekod för spelet
            if(array_key_exists('upp', $_POST))
            {
              //Rörelse kod för ner
              if ($_SESSION["player_X"]!=0 && movecheck($_SESSION["map"], $_SESSION["player_X"]-1, $_SESSION["player_Y"])==true)
              {
                echo "walked up, ";
                $_SESSION["player_X"] -= 1;
              }else
              {
                hit($x_offset-1,$y_offset,$conn);
              }

            }else if(array_key_exists('down', $_POST))
            {
              //Rörelse kod för upp
              if ($_SESSION["player_X"]!=12 && movecheck($_SESSION["map"], $_SESSION["player_X"]+1, $_SESSION["player_Y"])==true)
              {
                echo "walked down, ";
                $_SESSION["player_X"] += 1;
              }else
              {
                hit($x_offset+1,$y_offset+0,$conn);
              }

            }else if(array_key_exists('left', $_POST))
            {
              //Rörelse kod för vänster
              if ($_SESSION["player_Y"]!=0 && movecheck($_SESSION["map"], $_SESSION["player_X"], $_SESSION["player_Y"]-1)==true)
              {
                echo "walked left, ";
                $_SESSION["player_Y"] -= 1;
              }else
              {
                hit($x_offset+0,$y_offset-1,$conn);
              }

            }else if(array_key_exists('right', $_POST))
            {
              //Rörelse kod för höger
              if ($_SESSION["player_Y"]!=19 && movecheck($_SESSION["map"], $_SESSION["player_X"], $_SESSION["player_Y"]+1)==true)
              {
                echo "walked right, ";
                $_SESSION["player_Y"] += 1;
              }else
              {
                hit($x_offset+0,$y_offset+1,$conn);
              }
            }


            //ändrar vilken inventory slot som är selectad
            if (array_key_exists('1', $_POST))
            {
              $_SESSION["num"] = 0;
            }elseif (array_key_exists('2', $_POST))
            {
              $_SESSION["num"] = 1;
            }elseif (array_key_exists('3', $_POST))
            {
              $_SESSION["num"] = 2;
            }elseif (array_key_exists('4', $_POST))
            {
              $_SESSION["num"] = 3;
            }elseif (array_key_exists('5', $_POST))
            {
              $_SESSION["num"] = 4;
            }


            //funktion som nollställer databasen och några session variabler
            if(array_key_exists('reset', $_POST))
            {
              $_SESSION["inventory"] = array("null","null","null","null","null");
              $_SESSION["player_X"]=2;
              $_SESSION["player_Y"]=2;
              //kartan där olika nummer är olika items
              $_SESSION["map"] = array(
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
              $sql = "UPDATE `world` SET `map` = '".json_encode($_SESSION["map"])."' WHERE `world`.`id` = 1;";
              $result = $conn->query($sql);
            }


            //placerar object
            if(array_key_exists('place', $_POST))
            {
              for ($i=0; $i < 5; $i++)
              {
                if ($_SESSION["inventory"][$i]=="workbench"&&$_SESSION["map"][$_SESSION["player_X"]][$_SESSION["player_Y"]]!=3 && $_SESSION["num"] == $i)
                {
                  $_SESSION["inventory"][$i] = "null";
                  $_SESSION["map"][$_SESSION["player_X"]][$_SESSION["player_Y"]]=3;
                  break;
                }elseif ($_SESSION["inventory"][$i]=="Furnace"&&$_SESSION["map"][$_SESSION["player_X"]][$_SESSION["player_Y"]]!=9 && $_SESSION["num"] == $i)
                {
                  $_SESSION["inventory"][$i] = "null";
                  $_SESSION["map"][$_SESSION["player_X"]][$_SESSION["player_Y"]]=9;
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
                if ($_SESSION["inventory"][$i]=="null"&&$_SESSION["map"][$_SESSION["player_X"]][$_SESSION["player_Y"]]==3 && $_SESSION["num"]==$i)
                {
                  //kollar vilke§n bakgrund som är under spelarn och sätter ut motsvarande objekt
                  if($_SESSION["background"][$_SESSION["player_X"]][$_SESSION["player_Y"]]=="a1")
                  {
                    $_SESSION["map"][$_SESSION["player_X"]][$_SESSION["player_Y"]]=1;
                    $_SESSION["inventory"][$i] = "workbench";
                    break;
                  }elseif($_SESSION["background"][$_SESSION["player_X"]][$_SESSION["player_Y"]]=="a2")
                  {
                    $_SESSION["map"][$_SESSION["player_X"]][$_SESSION["player_Y"]]=4;
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
              for($X=0; $X < count($_SESSION["map"]); $X++)
              {
                for($Y=0; $Y < count($_SESSION["map"][1]); $Y++)
                {
                  if($_SESSION["map"][$X][$Y]==1||$_SESSION["map"][$X][$Y]==2)
                  {
                    $_SESSION["background"][$X][$Y]="a1";
                  }
                  if($_SESSION["map"][$X][$Y]==4)
                  {
                    $_SESSION["background"][$X][$Y]="a2";
                  }
                }
              }
            }


            //kollar om tilen kan bli slagen
            function hit($x_offset ,$y_offset, $conn)
            {
              if ($_SESSION["map"][$_SESSION["player_X"]+$x_offset][$_SESSION["player_Y"]+$y_offset]==2)
              {
                $_SESSION["map"][$_SESSION["player_X"]+$x_offset][$_SESSION["player_Y"]+$y_offset]=1;
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
              if ($_SESSION["map"][$_SESSION["player_X"]+$x_offset][$_SESSION["player_Y"]+$y_offset]==5)
              {
                echo "hit stone, ";
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "Wood_pickaxe"&&$_SESSION["num"]==$i||$_SESSION["inventory"][$i] == "stone_pickaxe"&&$_SESSION["num"]==$i)
                  {
                    $_SESSION["map"][$_SESSION["player_X"]+$x_offset][$_SESSION["player_Y"]+$y_offset]=4;
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
              if ($_SESSION["map"][$_SESSION["player_X"]+$x_offset][$_SESSION["player_Y"]+$y_offset]==6)
              {
                echo "hit iron ore, ";
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "stone_pickaxe"&&$_SESSION["num"]==$i)
                  {
                    $_SESSION["map"][$_SESSION["player_X"]+$x_offset][$_SESSION["player_Y"]+$y_offset]=4;
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
              if ($_SESSION["map"][$_SESSION["player_X"]+$x_offset][$_SESSION["player_Y"]+$y_offset]==7)
              {
                echo "hit redstone ore, ";
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "iron_pickaxe"&&$_SESSION["num"]==$i)
                  {
                    $_SESSION["map"][$_SESSION["player_X"]+$x_offset][$_SESSION["player_Y"]+$y_offset]=4;
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
            $sql = "UPDATE `world` SET `map` = '".json_encode($_SESSION["map"])."' WHERE `world`.`id` = 1;";
            $result = $conn->query($sql);
            $result = $conn->query($sql);

            //Debug info
            echo "player id ".($_SESSION["playerid"].", ");

            echo "</P>";
          ?>
	        	<div class="result"></div>
          <br>
        </div>
      </div>








      <div id="craft">

        <form method="post" id="craftbutton">
                <h1>craft meny</h1>
                <input id="plank" type="submit" name="plank" class="button" value="plank" />
                <input id="workbench" type="submit" name="workbench" class="button" value="workbench" />
                <input id="stick" type="submit" name="stick" class="button" value="stick" />
                <input id="sword" type="submit" name="sword" class="button" value="sword" />
                <input id="Wood_pickaxe" type="submit" name="Wood_pickaxe" class="button" value="Wood pickaxe" />
                <input id="Stone_pickaxe" type="submit" name="Stone_pickaxe" class="button" value="Stone pickaxe" />
                <input id="Furnace" type="submit" name="Furnace" class="button" value="Furnace" />
        </form>

        <div class="php">
          <?php
          //crafting meny och logic
          if(array_key_exists('plank', $_POST))
          {
            for ($i=0; $i <5 ; $i++)
            {
              if ($_SESSION["inventory"][$i]=="log")
              {
                $_SESSION["inventory"][$i] ="plank";
                break;
              }
            }
          }else if(array_key_exists('workbench', $_POST))
          {
            for ($i=0; $i <5 ; $i++)
            {
              if ($_SESSION["inventory"][$i]=="plank")
              {
                for ($j=0; $j < 5; $j++)
                {
                  if ($_SESSION["inventory"][$i]=="plank"&&$_SESSION["inventory"][$j]=="plank"&& $i!=$j)
                  {
                    $_SESSION["inventory"][$i] ="workbench";
                    $_SESSION["inventory"][$j] ="null";
                    break;
                  }
                }
                break;
              }
            }
          }else if(array_key_exists('stick', $_POST))
          {
            for ($i=0; $i <5 ; $i++)
            {
              echo ($_SESSION["craftmode"]);
              if ($_SESSION["inventory"][$i]=="plank"&&$_SESSION["craftmode"]=="bench")
              {
                $_SESSION["inventory"][$i] ="stick";
                break;
              }
            }
          }else if(array_key_exists('sword', $_POST))
          {
            for ($i=0; $i <5 ; $i++)
            {
              if ($_SESSION["inventory"][$i]=="plank"&&$_SESSION["craftmode"]=="bench")
              {
                for ($j=0; $j < 5; $j++)
                {
                  if ($_SESSION["inventory"][$i]=="plank"&&$_SESSION["inventory"][$j]=="stick"&& $i!=$j)
                  {
                    $_SESSION["inventory"][$i] ="sword";
                    $_SESSION["inventory"][$j] ="null";
                    break;
                  }
                }
                break;
              }
            }
          }else if(array_key_exists('Wood_pickaxe', $_POST))
          {
            for ($i=0; $i <5 ; $i++)
            {
              if ($_SESSION["inventory"][$i]=="plank"&&$_SESSION["craftmode"]=="bench")
              {
                for ($j=0; $j < 5; $j++)
                {
                  if ($_SESSION["inventory"][$i]=="plank"&&$_SESSION["inventory"][$j]=="stick"&& $i!=$j)
                  {
                    $_SESSION["inventory"][$i] ="Wood_pickaxe";
                    $_SESSION["inventory"][$j] ="null";
                    break;
                  }
                }
                break;
              }
            }
          }else if(array_key_exists('Stone_pickaxe', $_POST))
          {
            for ($i=0; $i <5 ; $i++)
            {
              if ($_SESSION["inventory"][$i]=="stone"&&$_SESSION["craftmode"]=="bench")
              {
                for ($j=0; $j < 5; $j++)
                {
                  if ($_SESSION["inventory"][$j]=="stick")
                  {
                    for ($k=0; $k < 5; $k++)
                    {
                      if ($_SESSION["inventory"][$k]=="Wood_pickaxe")
                      {
                        $_SESSION["inventory"][$i] ="stone_pickaxe";
                        $_SESSION["inventory"][$j] ="null";
                        $_SESSION["inventory"][$k] ="null";
                        break;
                      }
                    }
                  }
                }
                break;
              }
            }
          }else if(array_key_exists('Furnace', $_POST))
          {
            for ($i=0; $i <5 ; $i++)
            {
              if ($_SESSION["inventory"][$i]=="stone")
              {
                for ($j=0; $j < 5; $j++)
                {
                  if ($_SESSION["inventory"][$i]=="stone"&&$_SESSION["inventory"][$j]=="stone"&& $i!=$j)
                  {
                    $_SESSION["inventory"][$i] ="Furnace";
                    $_SESSION["inventory"][$j] ="null";
                    break;
                  }
                }
                break;
              }
            }
          }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>


<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script>
    function refresh_time() {
        jQuery.ajax({
            url:'GFX.php',
            type:'POST',
            success:function(results) {
                jQuery(".result").html(results);
            }
        });
    }
    timer = setInterval(refresh_time,100);
</script>

<script type="text/javascript">
    //Event listner som tittar ifall tangenter på tangentbordet klickas på
    //Om en tangent klickas på trycks form knappen även

    document.addEventListener('keydown', function(event) {
      if(event.keyCode == 37) {
          console.log('left');
          //trycker left
          document.getElementById("left").click();
      }
      else if(event.keyCode == 38) {
          console.log('up');
          //trycker up
          document.getElementById("up").click();
      }
      else if(event.keyCode == 39) {
          console.log('right');
          //trycker right
          document.getElementById("right").click();
      }
      else if(event.keyCode == 40) {
          console.log('down');
          //trycker down
          document.getElementById("down").click();
      }else if(event.keyCode == 65) {
          console.log('left');
          //trycker left
          document.getElementById("left").click();
      }
      else if(event.keyCode == 87) {
          console.log('up');
          //trycker up
          document.getElementById("up").click();
      }
      else if(event.keyCode == 68) {
          console.log('right');
          //trycker right
          document.getElementById("right").click();
      }
      else if(event.keyCode == 83) {
          console.log('down');
          //trycker down
          document.getElementById("down").click();
      }
      else if(event.keyCode == 49) {
          console.log('1');
          //trycker 1
          document.getElementById("1").click();
      }
      else if(event.keyCode == 50) {
          console.log('2');
          //trycker 2
          document.getElementById("2").click();
      }
      else if(event.keyCode == 51) {
          console.log('3');
          //trycker 3
          document.getElementById("3").click();
      }
      else if(event.keyCode == 52) {
          console.log('4');
          //trycker 4
          document.getElementById("4").click();
      }
      else if(event.keyCode == 53) {
          console.log('5');
          //trycker 5
          document.getElementById("5").click();
      }
      else if(event.keyCode == 13) {
          console.log('place');
          //trycker place
          document.getElementById("place").click();
      }
      else if(event.keyCode == 81) {
          console.log('pickup');
          //trycker pickup
          document.getElementById("pickup").click();
      }
      else if(event.keyCode == 69) {
          console.log('drop');
          //trycker pickup
          document.getElementById("drop").click();
      }
    });
</script>
