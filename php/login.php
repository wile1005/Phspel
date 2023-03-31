<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../scss/login.css">
    <link rel="stylesheet" href="../scss/main.css">
  </head>
    <body>
        <main> 
            <form id="login" action="" method="post">
                <h2>login</h2>
                <p>Username</p>
                <input class="input" type="text" name="name" value="">
                <p>Password</p>
                <input class="input" type="text" name="password" value="">
                <input class="button"id="submit" type="submit" name="submit" value="login">
                <?php
                    session_start();
                    //loggar in i databas
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "phspel";
                    //connects to mysqli server
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error)
                    {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT `name`,`password`,`id` FROM `player`";

                    if(isset($_POST["name"])&&$_POST["name"]!=""&&isset($_POST["password"])&&$_POST["password"]!="")
                    {
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc())
                        {
                            if ($row["name"]==ucfirst($_POST["name"])&&$row["password"]==hash('sha256',$_POST["password"]))
                            {
                                $_SESSION["id"]=$row["id"];
                                header("location:phspel.php");
                            }
                        }
                        echo"<p>wrong password or name<p>";
                    }else
                    {
                        echo"<p>Fill in all forms<p>";
                    }
                ?>
                <a href="new_user.php">dont have an account?</a>
            </form>
        </main>
    </body>
</html>