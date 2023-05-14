<form method='post'>
    <input type='text' name='message' value=''/>
    <input type='submit' class='button' value='Send message' />
</form>
<?php
    include "Database/Database_login.php";
    include "Chat_filter.php";

    $sql = "SELECT `name` FROM `player` WHERE `player`.`id` = ".$_SESSION["id"]."";
    $result = $conn->query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
    $new_message = $row["name"];

    if(isset($_POST["message"]) && $_POST["message"] !== $_SESSION["old_message"])
    {
        $new_message .= ": ".$_POST["message"];
        $_SESSION["old_message"] = $new_message;

        filter($new_message);

        $stmt = $conn->prepare("INSERT INTO chat (`Message`) VALUES (?)");
        $stmt->bind_param("s", $new_message);
        $stmt->execute();
        $stmt->close();
    }
?> 