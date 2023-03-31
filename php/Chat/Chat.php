<div id="messages">
</div>
<?php
    include "../Database_login.php";
    $sql = "SELECT `message`,`id` FROM `chat` ORDER BY id DESC LIMIT 10";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) 
    {
        echo "<p>".$row["message"] . "</p>";
    }
?>
<script>
  //refreshar class ="messages" varje 100ms (funkar inte)
    function refresh_time() {
        jQuery.ajax({
            url:'Chat.php',
            type:'POST',
            success:function(results) {
                jQuery(".messages").html(results);
            }
        });
    }
    timer = setInterval(refresh_time,500);
</script>