<html lang="en" dir="ltr">
  <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="../scss/phspel.css">
  </head>
  <body>
    <main>
        <div class='GFX_result'></div>
        <iframe src='Spel.php' title='description'></iframe>
        <div id="game">
            <?php
                if(isset($_SESSION["id"])==true)
                {
                    header("location:Index.php");
                }
            ?>
            <?php include 'Crafting.php';?>
            <div id="chat">
                <div class='Chat_result'></div>
                <?php include 'chat/Send_message.php'?>
            </div>
            <?php include 'Javascript.php';?>
        </div>
    </main>   
</html>