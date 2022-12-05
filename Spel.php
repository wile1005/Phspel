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
        <form method="post">
                <h1>PhSpel</h1>
                <input id="up" type="submit" name="upp" class="button" value="upp" />
                <input id="down" type="submit" name="down" class="button" value="down" />
                <input id="left" type="submit" name="left" class="button" value="left" />
                <input id="right" type="submit" name="right" class="button" value="right" />
                <input id="place" type="submit" name="place" class="button" value="place" />
                <input id="pickup" type="submit" name="pickup" class="button" value="pickup" />
                <input id="reset" type="submit" name="reset" class="button" value="reset" />
            </form>
        <div class="php">
          <?php
            session_start();

            //offset Variabler
            $X = 0;
            $Y = 0;
            //fixar variabler
            $_SESSION["craftmode"];
            $_SESSION["player_X"];
            $_SESSION["player_Y"];
            $_SESSION["array2D"];
            if ($_SESSION["player_Y"] === null && $_SESSION["player_X"] === null || $_SESSION["array2D"] === null)
            {
              $_SESSION["craftmode"]="null";
              $_SESSION["player_X"]=2;
              $_SESSION["player_Y"]=2;
              //array som är inventory
              $_SESSION["inventory"] = array("null","null","null","null","null");
              //array med kartan i
              //1 = grass
              //2 = tree
              $_SESSION["array2D"] = array(
                  array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 5, 5, 5, 5, 5),
                  array(1, 1, 2, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 4, 5, 5, 5, 5),
                  array(1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 4, 5, 4, 5, 5),
                  array(1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 4, 5, 5),
                  array(1, 1, 2, 2, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4, 5),
                  array(1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 4),
                  array(1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
                  array(1, 1, 2, 2, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
                  array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
                  array(1, 1, 2, 2, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
                  array(1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
              );
            }


            //rörelsekod för spelet
            if(array_key_exists('upp', $_POST))
            {
              //Rörelse kod för ner
              if ($_SESSION["player_X"]!=0 && movecheck($_SESSION["array2D"], $_SESSION["player_X"]-1, $_SESSION["player_Y"])==true)
              {
                echo "walk up";
                $_SESSION["player_X"] -= 1;
              }else
              {
                hit($X-1,$Y);
              }

            }else if(array_key_exists('down', $_POST))
            {
              //Rörelse kod för upp
              if ($_SESSION["player_X"]!=10 && movecheck($_SESSION["array2D"], $_SESSION["player_X"]+1, $_SESSION["player_Y"])==true)
              {
                echo "walk down";
                $_SESSION["player_X"] += 1;
              }else
              {
                hit($X+1,$Y+0);
              }

            }else if(array_key_exists('left', $_POST))
            {
              //Rörelse kod för vänster
              if ($_SESSION["player_Y"]!=0 && movecheck($_SESSION["array2D"], $_SESSION["player_X"], $_SESSION["player_Y"]-1)==true)
              {
                echo "walk left";
                $_SESSION["player_Y"] -= 1;
              }else
              {
                hit($X+0,$Y-1);
              }

            }else if(array_key_exists('right', $_POST))
            {
              //Rörelse kod för höger
              if ($_SESSION["player_Y"]!=17 && movecheck($_SESSION["array2D"], $_SESSION["player_X"], $_SESSION["player_Y"]+1)==true)
              {
                echo "walk right";
                $_SESSION["player_Y"] += 1;
              }else
              {
                hit($X+0,$Y+1);
              }

            }else if(array_key_exists('reset', $_POST))
            {
              session_destroy();
            }

            //placerar object
            if(array_key_exists('place', $_POST))
            {
              for ($i=0; $i < 5; $i++)
              {
                if ($_SESSION["inventory"][$i]=="workbench")
                {
                  $_SESSION["inventory"][$i] = "null";
                  $_SESSION["array2D"][$_SESSION["player_X"]][$_SESSION["player_Y"]]=3;
                  break;
                }
              }
            }

            //plockar upp ett object
            if(array_key_exists('pickup', $_POST))
            {
              
              for ($i=0; $i < 5; $i++)
              {
                if ($_SESSION["inventory"][$i]=="null")
                {
                  $_SESSION["inventory"][$i] = "workbench";
                  $_SESSION["array2D"][$_SESSION["player_X"]][$_SESSION["player_Y"]]=1;
                  break;
                }
              }
            }


            Gfx($_SESSION["array2D"], $_SESSION["player_X"], $_SESSION["player_Y"]);

            //kollar om tilen kan bli slagen
            function hit($X ,$Y)
            {
              echo $Y;
              echo $Y;
              if ($_SESSION["array2D"][$_SESSION["player_X"]+$X][$_SESSION["player_Y"]+$Y]==2)
              {
                $_SESSION["array2D"][$_SESSION["player_X"]+$X][$_SESSION["player_Y"]+$Y]=1;
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "null")
                  {
                    $_SESSION["inventory"][$i] = "log";
                    break;
                  }
                }
                echo "hit tree";
              }
              if ($_SESSION["array2D"][$_SESSION["player_X"]+$X][$_SESSION["player_Y"]+$Y]==5)
              {
                echo "hit stone";
                for ($i=0; $i <5 ; $i++)
                {
                  if ($_SESSION["inventory"][$i] == "Wood_pickaxe")
                  {
                    $_SESSION["array2D"][$_SESSION["player_X"]+$X][$_SESSION["player_Y"]+$Y]=4;
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
            }

            //checkar om spelaren kan ta sig till nästa tile
            function movecheck($array, $playerX, $playerY)
            {
              if ($array[$playerX][$playerY] == 2||$array[$playerX][$playerY]==5)
              {
                return(false);
              }else
              {
                return(true);
              }

            }


            //tror den fixar inventory grafik??? kanske flyttar till gfx funktionen
            for ($i=0; $i < 5; $i++)
            {
              if ($_SESSION["inventory"][$i]=="null")
              {
                echo "<img src='image/slot.jpg' alt=''>";
              }else
              {
                echo "<img src='image/".$_SESSION["inventory"][$i].".jpg' alt=''>";
              }

            }

            //grafiken till spelet
            function Gfx($array, $playerX, $playerY)
            {
              echo "<br>";
                for ($X=-2+$playerX; $X < 3+$playerX; $X++)
                {
                    for ($Y=-2+$playerY; $Y < 3+$playerY; $Y++)
                    {
                      if ($X > -1 && $Y > -1 && $X < 11 && $Y < 18)
                      {
                        if ($playerX == $X && $playerY == $Y)
                        {
                          if ($array[$X][$Y]==3)
                          {
                            $_SESSION["craftmode"]="bench";
                            echo "<img src='image/crafting.jpg' alt=''>";
                          }elseif ($array[$X][$Y]==4)
                          {
                            echo "<img src='image/Player-stone.jpg' alt=''>";
                          }else
                          {
                            $_SESSION["craftmode"]="null";
                            echo "<img src='image/Player.jpg' alt=''>";
                          }
                        }elseif ($array[$X][$Y] == 1)
                        {

                          echo "<img src='image/grass".rand(1,2).".jpg' alt=''>";
                        }elseif ($array[$X][$Y] == 2)
                        {
                          echo "<img src='image/tree.jpg' alt=''>";
                        }elseif ($array[$X][$Y] == 3)
                        {
                          echo "<img src='image/workbench_place.jpg' alt=''>";
                        }elseif ($array[$X][$Y] == 4)
                        {
                          echo "<img src='image/stone_floor.jpg' alt=''>";
                        }elseif ($array[$X][$Y] == 5)
                        {
                          echo "<img src='image/stone_wall.jpg' alt=''>";
                        }else
                        {
                          $value = $array[$X][$Y];
                          echo $value;
                        }
                      }

                    }
                    echo "<br>";
                }
            }
          ?>
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
          }

          ?>
        </div>
      </div>
    </div>
  </body>
</html>

<script type="text/javascript">
    document.addEventListener('keydown', function(event) {
      if(event.keyCode == 37) {
          console.log('left');
          //submit left
          document.getElementById("left").click();
      }
      else if(event.keyCode == 38) {
          console.log('up');
          //submit up
          document.getElementById("up").click();
      }
      else if(event.keyCode == 39) {
          console.log('right');
          //submit right
          document.getElementById("right").click();
      }
      else if(event.keyCode == 40) {
          console.log('down');
          //submit down
          document.getElementById("down").click();
      }
    });
</script>
