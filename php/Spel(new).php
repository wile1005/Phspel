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
                    // includar andra php filer (funktioner)
                    include "Movecheck.php";
                    include "Worldgen.php";

                    //startar sessionen
                    session_start();
                    $_SESSION["playerid"]=1;
                    $map = generate_world();
                    
                    //connectar till databasen
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "phspel";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error)
                    {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    //hämtar player variabler (player_x, player_y, inventory från player)
                    $sql = "SELECT `id`,`playerx`,`playery`,`inventory` FROM `player`";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc())
                    {
                        if($row["id"]==$_SESSION["playerid"])
                        {
                            $player_X=$row["playerx"];
                            $player_Y=$row["playery"];
                        }
                    }

                    echo "<P>";
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
                ?>
	        <div class="result"></div>
            <br>
            <div>
                <?php include "Crafting.php";?>
                <?php include "Javascript.php";?>
            </div>
        </div>
    </body>   
</html>