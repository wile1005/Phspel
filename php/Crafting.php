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
        </div>
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