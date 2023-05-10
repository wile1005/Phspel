<?php
    if(isset($_SESSION["id"]))
    {
        header("location:index.php");
    }
?>
<html lang="en" dir="ltr">
  <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="../scss/phspel.css">
  </head>
  <body>
    <main>
        <iframe src='Spel.php' title='description'></iframe>
        <div id ="GFX" class='GFX_result'></div>
        <div id ="ui" class="Ui"></div>
        <?php include 'Javascript.php';?>
    </main>   
</html>