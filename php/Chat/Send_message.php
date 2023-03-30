<form class='' method='post'>
    <input type='submit' class='button' value='Send message' />
    <input type='text' name='message' value=''/>
</form>
<?php
    include "Chat_filter.php";
    //kollar så att inputen inte är tom
    if(isset($_POST['message']) && !empty($_POST['message']))
    {
        //lägger in message i chat databasen
        $sql = "SELECT `id`,`name`FROM `player` WHERE `id` = ".$_SESSION["id"]."";
        $result = $conn->query($sql);
        $row = $result -> fetch_array(MYSQLI_ASSOC);

        $message = $row["name"].": ";
        $message .= $_POST["message"];

        //chat_filter($message);
        $stmt = $conn->prepare("INSERT INTO chat (`message`) VALUES (?)");
        $stmt->bind_param("s", $message);
        $stmt->execute();
        $stmt->close();
        $result = $conn->query($sql);
    }
?>