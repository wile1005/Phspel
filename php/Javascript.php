<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
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

<script type="text/javascript">
    //Event listner som tittar ifall tangenter på tangentbordet klickas på
    //Om en tangent klickas på trycks form knappen även

    document.addEventListener('keydown', function(event) {
      if(event.keyCode == 37) {
          console.log('left');
          //trycker left
          document.getElementById("left").click();
      }
      else if(event.keyCode == 38) {
          console.log('up');
          //trycker up
          document.getElementById("up").click();
      }
      else if(event.keyCode == 39) {
          console.log('right');
          //trycker right
          document.getElementById("right").click();
      }
      else if(event.keyCode == 40) {
          console.log('down');
          //trycker down
          document.getElementById("down").click();
      }else if(event.keyCode == 65) {
          console.log('left');
          //trycker left
          document.getElementById("left").click();
      }
      else if(event.keyCode == 87) {
          console.log('up');
          //trycker up
          document.getElementById("up").click();
      }
      else if(event.keyCode == 68) {
          console.log('right');
          //trycker right
          document.getElementById("right").click();
      }
      else if(event.keyCode == 83) {
          console.log('down');
          //trycker down
          document.getElementById("down").click();
      }
      else if(event.keyCode == 49) {
          console.log('1');
          //trycker 1
          document.getElementById("1").click();
      }
      else if(event.keyCode == 50) {
          console.log('2');
          //trycker 2
          document.getElementById("2").click();
      }
      else if(event.keyCode == 51) {
          console.log('3');
          //trycker 3
          document.getElementById("3").click();
      }
      else if(event.keyCode == 52) {
          console.log('4');
          //trycker 4
          document.getElementById("4").click();
      }
      else if(event.keyCode == 53) {
          console.log('5');
          //trycker 5
          document.getElementById("5").click();
      }
      else if(event.keyCode == 54) {
          console.log('6');
          //trycker 6
          document.getElementById("6").click();
      }
      else if(event.keyCode == 55) {
          console.log('7');
          //trycker 7
          document.getElementById("7").click();
      }
      else if(event.keyCode == 13) {
          console.log('place');
          //trycker place
          document.getElementById("place").click();
      }
      else if(event.keyCode == 81) {
          console.log('pickup');
          //trycker pickup
          document.getElementById("pickup").click();
      }
      else if(event.keyCode == 69) {
          console.log('drop');
          //trycker pickup
          document.getElementById("drop").click();
      }
    });
</script>