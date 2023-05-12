<?php
    session_start();
    if(!isset($_SESSION["id"]))
    {
        header("location:index.php");
    }
    if($_SESSION["id"]=="logout")
    {
        session_destroy();
        header("location:index.php");
    }
?>
<html lang="en" dir="ltr">
  <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="../scss/phspel.css">
        <script src="Javascript.js" defer></script>
        <script src="https://code.jquery.com/jquery-latest.min.js" defer></script>
  </head>
  <body>
    <main>
        <iframe src='Spel.php' title='description' class='Ui_layer'></iframe>
        <div id ="GFX" class='GFX_result Ui_layer'></div>
        <div id ="ui" class='Ui Ui_layer'></div>
        <div id ="send_message" class='Ui_layer'><?php include "Chat/Send_message.php"; ?></div> 
    </main>   
</html>