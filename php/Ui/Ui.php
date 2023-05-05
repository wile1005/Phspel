<?php
    //loggar in i databasen
    include "../Database/Database_login.php";
    foreach (glob("../Crafting/*.php") as $file) 
    {
        include $file;
    }
    
    //startar sessionen
    if(session_status()!=2)
    {
        session_start();
    }

    //hämtar craftmode inventory num
    $sql = "SELECT `craftmode`,`inventory`,`num`,`id` FROM `player` WHERE `player`.`id` = ".$_SESSION["id"].";";
    $result = $conn->query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    $craftmode = $row["craftmode"];
    $num = $row["num"];
    $inventory=json_decode($row["inventory"]);

    echo"<div id='healthbar'></div>";//fixa en healthbar


    //skriver ut rätt ui beroende på session ui
    if($_SESSION["ui"]=="inventory")
    {
        //kod för inventoriet
        echo"<div id='inventory' class='menu'>";
        echo"<h2>Inventory</h2>";
        for($i=$num-2; $i < count($inventory); $i++)
        {
            if($i>-1&&$i<$num+3)
            {
                echo"<li>";
                echo"<img src=../Images/Icons/".str_replace(" ","_",$inventory[$i][0]).".png>";
                //skriver ut om itemet är selectat
                if($i == $num)
                {
                    echo"<p>".$inventory[$i][1]." ".$inventory[$i][0]." <</p>";
                }else
                {
                    echo"<p>".$inventory[$i][1]." ".$inventory[$i][0]." </p>";
                }
                echo"</li>";
            }
        }
        echo"</div>";
    }elseif($_SESSION["ui"]=="crafting")
    {
        //kod för crafting ui
        echo"<div id='crafting' class='menu'>";
        echo"<h2>Crafting</h2>";
        for($i=$num-2; $i < count($recipes); $i++)
        {
            if($i>-1&&$i<$num+3&&$recipes[$i][1]==$craftmode)
            {
                echo"<li>";
                echo"<img src=../Images/Icons/".str_replace(" ","_",$recipes[$i][0]).".png>";
                //skriver ut om receptet är selectat
                if($i == $num)
                {
                    echo"<p>".$recipes[$i][0]." <</p>";
                }else
                {
                    echo"<p>".$recipes[$i][0]."</p>";
                }
                echo"</li>";
            }
        }
        echo"</div>";
        echo"<div id='required' class='menu'>";
        echo"<h3>costs:<h3>";
        foreach($recipes[$num] as list($required_item,$required_amount))
        {
            if(isset($required_item)&&find_item($inventory,$required_item)!="not found")
            {
                echo"<li>";
                echo"<img src=../Images/Icons/".str_replace(" ","_",$required_item).".png>";
                echo"<p>".$inventory[find_item($inventory,$required_item)][1]."/".$required_amount."</p>";
                echo"</li>";
            }elseif(isset($required_item))
            {
                echo"<li>";
                echo"<img src=../Images/Icons/".str_replace(" ","_",$required_item).".png>";
                echo"<p>0/".$required_amount."</p>";
                echo"</li>";
            }
        }
        echo"</div>";
    }
?>