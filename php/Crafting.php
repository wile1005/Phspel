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
          function craft($inventory,$craftmode)
          {
            //crafting meny och logic
            if(array_key_exists('plank', $_POST))
            {
              for ($i=0; $i <5 ; $i++)
              {
                if ($inventory[$i]=="log")
                {
                  $inventory[$i] ="plank";
                  break;
                }
              }
            }else if(array_key_exists('workbench', $_POST))
            {
              for ($i=0; $i <5 ; $i++)
              {
                if ($inventory[$i]=="plank")
                {
                  for ($j=0; $j < 5; $j++)
                  {
                    if ($inventory[$i]=="plank"&&$inventory[$j]=="plank"&& $i!=$j)
                    {
                      $inventory[$i] ="workbench";
                      $inventory[$j] ="null";
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
                echo ($craftmode);
                if ($inventory[$i]=="plank"&&$craftmode=="bench")
                {
                  $inventory[$i] ="stick";
                  break;
                }
              }
            }else if(array_key_exists('sword', $_POST))
            {
              for ($i=0; $i <5 ; $i++)
              {
                if ($inventory[$i]=="plank"&&$craftmode=="bench")
                {
                  for ($j=0; $j < 5; $j++)
                  {
                    if ($inventory[$i]=="plank"&&$inventory[$j]=="stick"&& $i!=$j)
                    {
                      $inventory[$i] ="sword";
                      $inventory[$j] ="null";
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
                if ($inventory[$i]=="plank"&&$craftmode=="bench")
                {
                  for ($j=0; $j < 5; $j++)
                  {
                    if ($inventory[$i]=="plank"&&$inventory[$j]=="stick"&& $i!=$j)
                    {
                      $inventory[$i] ="Wood_pickaxe";
                      $inventory[$j] ="null";
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
                if ($inventory[$i]=="stone"&&$craftmode=="bench")
                {
                  for ($j=0; $j < 5; $j++)
                  {
                    if ($inventory[$j]=="stick")
                    {
                      for ($k=0; $k < 5; $k++)
                      {
                        if ($inventory[$k]=="Wood_pickaxe")
                        {
                          $inventory[$i] ="stone_pickaxe";
                          $inventory[$j] ="null";
                          $inventory[$k] ="null";
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
                if ($inventory[$i]=="stone")
                {
                  for ($j=0; $j < 5; $j++)
                  {
                    if ($inventory[$i]=="stone"&&$inventory[$j]=="stone"&& $i!=$j)
                    {
                      $inventory[$i] = "Furnace";
                      $inventory[$j] = "null";
                      break;
                    }
                  }
                  break;
                }
              }
            }

            return($inventory);
          }
          ?>
        </div>