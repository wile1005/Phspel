<?php
header("location:login.php");

//finns säkert något smart att ta härifrån
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
  $sql = "SELECT `name`,`password`,`id`FROM `player`";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc())
  {
    if ($row["name"]==$_SESSION["name"]&&$_POST["name"]!=""&&$row["password"]==$_POST["password1"])
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
  $sql = "SELECT `name`,`id`FROM `player`";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc())
  {
    if ($row["name"]==$_POST["new_user"]&&$_POST["new_user"]!="")
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
    $sql = "INSERT INTO `player` (`id`,`name`, `password`, `playerX`, `playerY`,`perms`) VALUES ('".($_SESSION["maxplayer"])."','".$_POST["new_user"]."','".$_POST["password2"]."', '2', '2','none')";
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