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
        <?php
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
        $sql = "SELECT `playername`,`id`,`playerx`,`playery`,`perms`FROM `player`";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc())
        {
          echo '<div id="user">';
          echo '<div id="user_info">';
          echo ("<h1>User:".$row["playername"]."</h1>");
          echo "<br>";
          echo ("id:".$row["id"]);
          echo "<br>";
          echo ("Position:".$row["playerx"].",".$row["playery"]);
          echo "<br>";
          echo ("perms:".$row["perms"]);
          echo '</div>';
          echo '<div id="user_edit">';
          echo "<h1>User edit</h1>";
          echo '<form class="" action="" method="post">
                  <p>edit username</p>
                  <input type="text" name="new_username" value="">
                  <p></p>
                  <p>edit position</p>
                  <input type="text" name="new_position" value="">
                  <p></p>
                  <p>edit perms</p>
                  <input type="text" name="new_position" value="">
                </form>';
          echo '</div>';
          echo '<div id="user_actions">';
          echo "<h1>User actions</h1>";
          echo '<form class="" action="" method="post">
                  <input type="submit" name="submit" value="Remove user">
                  <p></p>
                  <input type="submit" name="submit" value="Join as user">
                </form>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </body>
</html>
