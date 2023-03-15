<?php
    if(array_key_exists('place', $_POST))
    {
      for ($i=0; $i < 5; $i++)
      {
        if ($inventory[$i]=="workbench"&&$map[$playerX][$player_Y]!=3 && $_SESSION["num"] == $i)
        {
          $inventory[$i] = "null";
          $map[$playerX][$playerY]=3;
          break;
        }elseif ($inventory[$i]=="Furnace"&&$map[$playerX][$playerY]!=9 && $_SESSION["num"] == $i)
        {
          $inventory[$i] = "null";
          $map[$playerX][$playeY]=9;
          break;
        }
      }
    }
?>