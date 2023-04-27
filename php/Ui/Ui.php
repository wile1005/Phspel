<?php
    //loggar in i databasen
    include "../Database/Database_login.php";

    //startar sessionen
    if(session_status()!=2)
    {
        session_start();
    }

    $sql = "SELECT `craftmode`,`inventory`,`num`,`id` FROM `player` WHERE `player`.`id` = ".$_SESSION["id"].";";
    $result = $conn->query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    $craftmode = $row["craftmode"];
    $num = $row["num"];
    $inventory=json_decode($row["inventory"]);


    echo"<div id='healthbar'></div>";//fixa en healthbar

    if($_SESSION["showui"]==true)
    {
        echo"<div id='inventory'>";
        foreach($inventory as $index=>$item)
        {
            if($index == $num)
            {
                echo"<p>>".$item."<</p>";
            }else
            {
                echo"<p>".$item."</p>";
            }
        }
        echo"</div>";
    }
?>