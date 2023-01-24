<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <div id="wrap2">
      <div id="meny">
        <a href="Start.php">loggin</a>
        <form class="" action="" method="post">
          <h1>Admin loggin</h1>
          <p>Username</p>
          <input type="text" name="name" value="">
          <p></p>
          <p>password</p>
          <input type="text" name="password" value="">
          <p></p>
          <input type="submit" name="submit" value="enter">
        </form>
        <?php
        if (isset($_POST["name"])&&$_POST["name"]!=""&&isset($_POST["password"])&&$_POST["password"]!="")
        {
          if ($_POST["name"]=="Viking"&&$_POST["password"]=="1235")
          {
            header("location:admin.php");
          }else
          {
              echo "Wrong password or username";
          }
        }else
        {
          echo "Fill in all fields";
        }
        ?>
      </div>
    </div>
  </body>
</html>
