<?php include('Spel.php')?>
<script>
    var updateGallery = setInterval(function() 
    {
        $('#someDiv').load('Spel.php');
    }, 10000);
</script>