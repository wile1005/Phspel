<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../scss/css.css">
  </head>
  <body>
    <div id="wrap2">
      <div id="meny">
        <a href="admin_loggin.php" id="admin">Admin</a>
        <h1>Loggin</h1>

        <form class="" action="" method="post">
          <p>Username</p>
          <input type="text" name="name" value="">
          <p></p>
          <p>Password</p>
          <input type="text" name="password1" value="">
          <p></p>
          <input type="submit" name="submit" value="join">
          <br>
          <h1>New user</h1>
          <p>Username</p>
          <input type="text" name="new_user" value="">
          <p></p>
          <p>Password</p>
          <input type="text" name="password2" value="">
          <p></p>
          <input type="submit" name="submit" value="enter">
        </form>

        <?php
        if (isset($_POST["name"])&&$_POST["name"]!=""||isset($_POST["new_user"])&&$_POST["new_user"]!="")
        {
          //startar sessionen
          session_start();

          //skapar variablar
          $_SESSION["name"] = $_POST["name"];
          $_SESSION["maxplayer"]=0;
          $name_taken = false;
          include"Database_login.php";

          //tittar om spelaren finns och om lösenordet matchar sickas den till spelet
          $sql = "SELECT `playername`,`password`,`id`FROM `player`";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc())
          {
            if ($row["playername"]==$_SESSION["name"]&&$_POST["name"]!=""&&$row["password"]==$_POST["password1"])
            {
              $_SESSION["id"]=$row["id"];
              header("location:Phspel.php");
            }
          }

          //går igenom alla spelare och tittat vilket id som inte finns
          $temp = 0;
          $result = $conn->query($sql);
          $sql = "SELECT MAX(`id`) FROM `player`";
          while($row = $result->fetch_assoc())
          {
              $temp++;
              if($temp==$row["id"])
              {
                  $_SESSION["maxplayer"]=($row["id"])+1;
              }
          }          
          
          //tittar om spelaren redan finns
          $sql = "SELECT `playername`,`id`FROM `player`";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc())
          {
            if ($row["playername"]==$_POST["new_user"]&&$_POST["new_user"]!="")
            {
              $name_taken = true;
            }
          }

          //om spelaren redan finns skriver den ut en text och om den inte redan finns så gör den en ny spelare
          if ($name_taken == true)
          {
            $name_taken = false;
            echo "name was already taken";
          }else if ($name_taken == false&&$_POST["new_user"]!=""&&$_POST["password2"]!=""&&$_SESSION["maxplayer"]!=0)
          {
            $sql = "INSERT INTO `player` (`id`,`playername`, `password`, `playerX`, `playerY`,`perms`) VALUES ('".($_SESSION["maxplayer"])."','".$_POST["new_user"]."','".$_POST["password2"]."', '2', '2','none')";
            $result = $conn->query($sql);
            echo "New user created!";
          }else
          {
            echo "Fill in all fields";
          }
        }else
        {
          echo "no name given";
        }
        ?>
      </div>
    </div>
  </body>
</html>
