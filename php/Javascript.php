<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>

<script>
  //refreshar class ="messages" varje 100ms (funkar)
    function refresh_time() {
        jQuery.ajax({
            url:'Chat/Chat.php',
            type:'POST',
            success:function(results) {
                jQuery(".Chat_result").html(results);
            }
        });
    }
    timer = setInterval(refresh_time,500);
</script>

<script>
  //refreshar class ="result" (gfx.php) varje 100ms
    function refresh_time() {
        jQuery.ajax({
            url:'GFX/GFX.php',
            type:'POST',
            success:function(results) {
                jQuery(".GFX_result").html(results);
            }
        });
    }
    timer = setInterval(refresh_time,100);
</script>

<script>
  //refreshar class ="result" (gfx.php) varje 100ms
    function refresh_time() {
        jQuery.ajax({
            url:'Ui/Ui.php',
            type:'POST',
            success:function(results) {
                jQuery(".Ui").html(results);
            }
        });
    }
    timer = setInterval(refresh_time,500);
</script>

<script type="text/javascript">
    //Event listner som tittar ifall tangenter på tangentbordet klickas på
    //Om en tangent klickas på trycks form knappen även

    document.addEventListener('keydown', function(event) {
      if(event.keyCode == 37) {
          console.log('left');
          //trycker left
          document.getElementById("left").click();
      }else if(event.keyCode == 38) 
      {
          console.log('up');
          //trycker up
          document.getElementById("up").click();
      }else if(event.keyCode == 39) 
      {
          console.log('right');
          //trycker right
          document.getElementById("right").click();
      }else if(event.keyCode == 40) 
      {
          console.log('down');
          //trycker down
          document.getElementById("down").click();
      }else if(event.keyCode == 65) 
      {
          console.log('left');
          //trycker left
          document.getElementById("left").click();
      }else if(event.keyCode == 87) 
      {
          console.log('up');
          //trycker up
          document.getElementById("up").click();
      }else if(event.keyCode == 68) 
      {
          console.log('right');
          //trycker right
          document.getElementById("right").click();
      }else if(event.keyCode == 83) 
      {
          console.log('down');
          //trycker down
          document.getElementById("down").click();
      }else if(event.keyCode == 13) 
      {
          console.log('enter');
          //trycker enter
          document.getElementById("enter").click();
      }else if(event.keyCode == 88) 
      {
          console.log('inventory');
          //trycker pickup
          document.getElementById("inventory").click();
      }else if(event.keyCode == 90) 
      {
          console.log('crafting');
          //trycker pickup
          document.getElementById("crafting").click();
      }else if(event.keyCode == 27) 
      {
          console.log('escape');
          //trycker pickup
          document.getElementById("escape").click();
      }
    });
</script>