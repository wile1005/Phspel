<?php
    if(array_key_exists('reset', $_POST))
    {
        session_start();
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

        $playerY = 2;
        $playerX = 2;
        $num = 0;
        $inventory = array("null","null","null","null","null");
        generate_world();

        $sql = "SELECT `id` FROM `player`;";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . mysqli_error($conn);
        } else {
            while($row = $result->fetch_assoc()) {
                //Nollställer alla spelare
                $sql = "UPDATE `player` SET `playerY` = '".$playerY."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) {
                    echo "Error: " . mysqli_error($conn);
                }
                
                $sql = "UPDATE `player` SET `playerX` = '".$playerX."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) {
                    echo "Error: " . mysqli_error($conn);
                }
                
                $sql = "UPDATE `player` SET `inventory` = '".$num."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) {
                    echo "Error: " . mysqli_error($conn);
                }

                $sql = "UPDATE `player` SET `inventory` = '".json_encode($inventory)."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    }
?>