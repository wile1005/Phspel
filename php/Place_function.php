<?php
    function place($inventory,$map,$playerX,$playerY)
    {
        //bla bla bla loggin till mysql
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

        for ($i=0; $i < count($inventory); $i++)
        {
            if ($inventory[$i]=="workbench"&&$map[$playerX][$playerY]!=3 && $_SESSION["num"] == $i)
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

        $sql = "UPDATE `world` SET `map` = '".json_encode($map)."' WHERE `world`.`id` = 1;";
        $result = $conn->query($sql);
        
        $sql = "UPDATE `player` SET `inventory` = '".json_encode($inventory)."' WHERE `player`.`id` = ".$_SESSION["id"].";";
        $result = $conn->query($sql);

        return($inventory);
    }
?>