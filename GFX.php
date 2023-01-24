<script type="text/javascript">
setInterval(() => {
}, 1000);
</script>
<div id="GFX">
  <?php
  session_start();
  Gfx($_SESSION["map"], $_SESSION["player_X"], $_SESSION["player_Y"]);



  //grafiken till spelet
  function Gfx($array, $playerX, $playerY)
  {
    $playersx=[];
    $playersy=[];

    //loggar in i databas
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
    //selectar spelar tabelen och tar playery och playerx variablarna
    $sql = "SELECT `playerx`,`playery` FROM `player`";
    $result = $conn->query($sql);
    //uptaterar spelar tabelens x och y värde
    $sql = "UPDATE `player` SET `playerx` = '$playerX', `playery` = '$playerY' WHERE `player`.`id` = '".$_SESSION["playerid"]."';";
    $result = $conn->query($sql);
    //???
    $sql = "SELECT `playerx`,`playery`,`id` FROM `player`;";
    $result = $conn->query($sql);
    //tittar igenom tabelen efter SPELAREN och tar denns x och y
    while($row = $result->fetch_assoc())
    {
      if ($row["id"]==$_SESSION["playerid"])
      {
        $localx =($row["playerx"]);
        $localy =($row["playery"]);
      }
    }
    $array2 = $array[1];
    $result = $conn->query($sql);
    //ska fixa ike  lokala spelare
    while($row = $result->fetch_assoc())
    {
      $playersx[$row["id"]]=($row["playerx"]);
      $playersy[$row["id"]]=($row["playery"]);
    }
    $result = $conn->query($sql);
    //tar hur många spelare som finns
    $sql = "SELECT MAX(`id`) FROM `player`";
    while($row = $result->fetch_assoc())
    {
        $playernum=($row["id"]);
    }

    //SPELARENS SYNFÄLLT
      for ($X=-2+$playerX; $X < 3+$playerX; $X++)
      {
          for ($Y=-2+$playerY; $Y < 3+$playerY; $Y++)
          {
            //ÄR SYNFÄLLT UTANFÖR ARRAY???
            if ($X > -1 && $Y > -1 && $X < count($array) && $Y < count($array2))
            {
              //kollar igenom alla spelarnas id
              for ($id=1; $id < $playernum+1; $id++)
              {
                //om spelare finns på X oxh y cordinaten skriv ut spelare
                if ($playersx[$id]==$X && $playersy[$id]==$Y)
                {
                  if ($array[$X][$Y]==3)
                  {
                    $_SESSION["craftmode"]="bench";
                    echo "<img src='image/crafting.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                  }elseif ($array[$X][$Y]==9)
                  {
                    $_SESSION["craftmode"]="furnace";
                    echo "<img src='image/furnacing.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                  }else
                  {
                    if ($id==$_SESSION["playerid"])
                    {
                      $_SESSION["craftmode"]="null";
                    }
                    echo "<img src='image/Player.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                  }
                  $playerprint = true;
                  break;
                  //om spelare inte finns på X oxh y cordinaten skriv ut annat
                }else
                {
                  $playerprint=false;
                }
              }
              //om spelare inte finns på X oxh y cordinaten skriv ut annat
              if ($playerprint == false)
              {
                if ($array[$X][$Y] == 1)
                {
                  echo "<img src='image/grass".rand(1,2).".png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }elseif ($array[$X][$Y] == 2)
                {
                  echo "<img src='image/tree.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }elseif ($array[$X][$Y] == 3)
                {
                  echo "<img src='image/workbench_place.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }elseif ($array[$X][$Y] == 4)
                {
                  echo "<img src='image/stone_floor.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }elseif ($array[$X][$Y] == 5)
                {
                  echo "<img src='image/stone_wall.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }elseif ($array[$X][$Y] == 6)
                {
                  echo "<img src='image/iron_ore.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }elseif ($array[$X][$Y] == 7)
                {
                  echo "<img src='image/redstone_ore.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }elseif ($array[$X][$Y] == 8)
                {
                  echo "<img src='image/bedrock.jpg' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }elseif ($array[$X][$Y] == 9)
                {
                  echo "<img src='image/furnace_place.png' alt='' id='".$_SESSION["background"][$X][$Y]."' >";
                }else
                {
                  if ($id==$_SESSION["playerid"])
                  {
                    $value = $array[$X][$Y];
                    echo $value;
                    break;
                  }
                }
              }

            }


          }
          echo "<br>";
      }//'".json_encode($_SESSION["map"])."'

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
      echo "<br>";
      for ($i=0; $i < 5; $i++)
      {
        if ($i==$_SESSION["num"])
        {
          echo "<img src='image/selector_arrow.jpg' alt=''>";
        }else
        {
          echo "<img src='image/selector_slot.jpg' alt=''>";
        }

      }
  }
  ?>
</div>
