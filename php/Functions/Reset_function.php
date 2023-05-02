<?php
    function reset_func()
    {
        include "Database/Database_login.php";

        $playerY = 5;
        $playerX = 5;
        $holding = "";
        $num = 0;
        $current_floor = 1;
        $inventory = array();
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
                $sql = "UPDATE `player` SET 
                `playerY` = '".$playerY."', 
                `playerX` = '".$playerX."', 
                `floor` = '".$current_floor."', 
                `inventory` = '".$num."', 
                `holding` = '".$holding."', 
                `inventory` = '".json_encode($inventory)."' 
                WHERE `player`.`id` = ".$row["id"].";";
                $updateResult = $conn->query($sql);
                if ($updateResult === false) 
                {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        }
    }
?>