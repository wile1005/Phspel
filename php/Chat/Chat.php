<div id="messages">
    <?php
        include "../Database_login.php";
        $sql = "SELECT `message`,`id` FROM `chat` ORDER BY id DESC LIMIT 10";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) 
        {
            echo "<p>".$row["message"] . "</p>";
        }
    ?>
</div>