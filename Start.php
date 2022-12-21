<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <div id="wrap2">
      <div id="meny">
        <form class="" action="" method="post">
          <p>Username</p>
          <input type="text" name="name" value="">
          <p></p>
          <input type="submit" name="submit" value="join">
        </form>

        <?php
        if (isset($_POST["name"])&&$_POST["name"]!="")
        {
          session_start();
          $_SESSION["name"] = $_POST["name"];;
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
          $sql = "SELECT `playername`,`id`FROM `player`";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc())
          {
            if ($row["playername"]==$_SESSION["name"])
            {
              $_SESSION["playerid"]=$row["id"];
              header("location:Spel.php");
            }
          }
          echo "player does not exist";
        }else
        {
          echo "no name given";
        }
        ?>
      </div>
    </div>
  </body>
</html>
