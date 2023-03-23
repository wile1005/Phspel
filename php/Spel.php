<html lang="en" dir="ltr">
  <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="../scss/phspel.css">
  </head>
  <body>
    <div id="wrap">
        <div id="spel">

            <form class="" method="post">
                <h1>PHsPel</h1>
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
                    //debug läget (visar mer info)
                    $debug = true;

                    // includar andra php filer (funktioner)
                    include "World_generator.php";
                    include "Movecheck_function.php";
                    include "Reset_function.php";
                    include "Place_function.php";
                    include "Hit_function.php";

                    //startar sessionen
                    session_start();
                    $_SESSION["selected_world"]=1;
                    
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

                    //hämtar player variabler (playerX, playerY, inventory från player)
                    $sql = "SELECT `id`,`playerX`,`playerY`,`inventory`,`num`,`craftmode` FROM `player`";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc())
                    {
                        if($row["id"]===$_SESSION["id"])
                        {
                            $playerX = $row["playerX"];
                            $playerY = $row["playerY"];
                            $num = $row["num"];
                            $craftmode = $row["craftmode"];
                            $inventory = json_decode($row["inventory"]);
                        }
                    }

                    // hämtar mapen
                    $sql = "SELECT `map`,`background`,`id` FROM `world`";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc())
                    {
                        if($_SESSION["selected_world"]==$row["id"])
                        {
                            $map = json_decode($row["map"]);
                            $background = json_decode($row["background"]);
                        }
                    }


                    echo "<P>";
                    //rörelsekod för spelet
                    if(array_key_exists('upp', $_POST))
                    {
                    //Rörelse kod för up
                        if (movecheck($map, $playerX-1, $playerY)==true)
                        {
                            $playerX -= 1;
                        }else
                        {
                            $inventory = hit($map,$playerX-1,$playerY,$inventory,$num);
                        }

                    }else if(array_key_exists('down', $_POST))
                    {
                    //Rörelse kod för ner
                        if (movecheck($map, $playerX+1, $playerY)==true)
                        {
                            $playerX += 1;
                        }else
                        {
                            $inventory = hit($map,$playerX+1,$playerY,$inventory,$num);
                        }

                    }else if(array_key_exists('left', $_POST))
                    {
                    //Rörelse kod för vänster
                        if (movecheck($map, $playerX, $playerY-1)==true)
                        {
                            $playerY -= 1;
                        }else
                        {
                            $inventory = hit($map,$playerX,$playerY-1,$inventory,$num);
                        }

                    }else if(array_key_exists('right', $_POST))
                    {
                    //Rörelse kod för höger
                        if (movecheck($map, $playerX, $playerY+1)==true)
                        {
                            $playerY += 1;
                        }else
                        {
                            $inventory = hit($map,$playerX,$playerY+1,$inventory,$num);
                        }
                    }

                    //ändrar vilken inventory slot som är selectad
                    foreach($_POST as $key => $value) 
                    {
                        if(is_numeric($key)) {
                            $num = $key - 1;
                            break;
                        }
                    }


                    if(array_key_exists('place', $_POST))
                    {
                        $inventory = place($inventory,$map,$playerX,$playerY,$num);
                    }

                    echo "</P>";
                    echo "<br>";
                    echo "<div class='result'></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div>";       

                    //crafting meny
                    include 'Crafting.php';    
                    $inventory = craft($inventory,$craftmode);  

                    //updaterar spelar positionen
                    $sql = "UPDATE `player` SET `playerY` = '".$playerY."' WHERE `player`.`id` = ".$_SESSION["id"].";";
                    $result = $conn->query($sql);
                    $sql = "UPDATE `player` SET `playerX` = '".$playerX."' WHERE `player`.`id` = ".$_SESSION["id"].";";
                    $result = $conn->query($sql);

                    //updaterar spelarens inventory och num
                    $sql = "UPDATE `player` SET `inventory` = '".json_encode($inventory)."' WHERE `player`.`id` = ".$_SESSION["id"].";";
                    $result = $conn->query($sql);
                    $sql = "UPDATE `player` SET `num` = '".$num."' WHERE `player`.`id` = ".$_SESSION["id"].";";
                    $result = $conn->query($sql);

                    if($debug==true)
                    {
                        $sql = "SELECT `playerX`,`playerY`,`inventory`,`id` FROM `player`;";
                        $result = $conn->query($sql);

                        if ($result === false) 
                        {
                            echo "Error: " . mysqli_error($conn);
                        } else 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                if($_SESSION["id"]==$row["id"])
                                {
                                    echo("ID: ".$row["id"]);
                                    echo(", Position: ".$row["playerX"]."x,".$row["playerY"]."y, ");
                                    echo("Inventory: ".$row["inventory"]." ");
                                    echo("num: ".$num." ");
                                    echo("Craftmode: ".$craftmode);
                                }
                            }
                        }
                    }   
                ?>
                <?php include 'Javascript.php';?>
            </div>
        </div>
    </body>   
</html>