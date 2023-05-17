//refreshar class ="result" (gfx.php) varje 100ms
function refresh_gfx() {
    jQuery.ajax({
        url:'GFX/GFX.php',
        type:'POST',
        success:function(results) {
            jQuery(".GFX_result").html(results);
        }
    });
}
timer = setInterval(refresh_gfx,100);

//refreshar class ="ui" (ui.php) varje 100ms
function refresh_ui() {
    jQuery.ajax({
        url:'Ui/Ui.php',
        type:'POST',
        success:function(results) {
            jQuery(".Ui").html(results);
        }
    });
}
timer = setInterval(refresh_ui,100);


//Event listner som tittar ifall tangenter på tangentbordet klickas på
//Om en tangent klickas på trycks form knappen även
document.addEventListener('keydown', function(event) 
{
    switch(event.key)
    {
        case "a":
        case "ArrowLeft":
            //trycker left
            console.log('left');
            document.getElementById("left").click();
            break;

        case "w":
        case "ArrowUp":
            //trycker up
            console.log('up');
            document.getElementById("up").click();
            break;
        
        case "d":
        case "ArrowRight":
            //trycker right
            console.log('right');
            document.getElementById("right").click();
            break;
        
        case "s":
        case "ArrowDown":
            //trycker down
            console.log('down');
            document.getElementById("down").click();
            break;

        case "Enter":
            //trycker enter
            console.log('enter');
            document.getElementById("enter").click();
            break;
        
        case "x":
            //öppnar inventoriet
            console.log('inventory');
            document.getElementById("inventory").click();
            break;
        
        case "z":
            //öppnar crafting menyn
            console.log('crafting');
            document.getElementById("crafting").click();
            break;
        
        case "Escape":
            //öppnar escape menyn
            console.log('escape');
            document.getElementById("escape").click();
            break;
        
        case "t":
        case "c":
            //öppnar chaten
            console.log('chat');
            document.getElementById("chat").click();
            break;
    }
});