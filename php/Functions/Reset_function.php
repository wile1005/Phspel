<?php
    function reset_func()
    {
        include "Database/Database_login.php";
        
        $playerY = 5;
        $playerX = 5;
        $num = 0;
        $current_floor = 1;
        $inventory = array_fill(0,7,"null");
        function in_range($var, $min, $max) 
        {
            return ($var >= $min && $var <= $max);
        }
        generate_world();
        $sql = "SELECT `id` FROM `player`;";
        $result = $conn->query($sql);

        if ($result === false) 
        {
            echo "Error: " . mysqli_error($conn);
        } else 
        {
            while($row = $result->fetch_assoc()) 
            {
                //Nollställer alla spelare
                $sql = "UPDATE `player` SET `playerY` = '".$playerY."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) 
                {
                    echo "Error: " . mysqli_error($conn);
                }

                $sql = "UPDATE `player` SET `floor` = '".$current_floor."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) 
                {
                    echo "Error: " . mysqli_error($conn);
                }
                
                $sql = "UPDATE `player` SET `playerX` = '".$playerX."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) 
                {
                    echo "Error: " . mysqli_error($conn);
                }
                
                $sql = "UPDATE `player` SET `inventory` = '".$num."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) 
                {
                    echo "Error: " . mysqli_error($conn);
                }

                $sql = "UPDATE `player` SET `inventory` = '".json_encode($inventory)."' WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) 
                {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    }
?>