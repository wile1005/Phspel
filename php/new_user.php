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
                <h2>Create new user</h2>
                <p>Username</p>
                <input class="input" type="text" name="name" value="">
                <p>Password</p>
                <input class="input" type="text" name="password" value="">
                <input class="button" id="submit" type="submit" name="submit" value="Create new user">
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

                    if(isset($_POST["name"])&&$_POST["name"]!=""&&isset($_POST["password"])&&$_POST["password"]!="")
                    {
                        $sql = "SELECT `name`,`password`,`id` FROM `player`";
                        $result = $conn->query($sql);
                        if (!$result) 
                        {
                            echo "Error: " . mysqli_error($conn);
                        } else 
                        {
                            $user_exists = false;
                            $row = $result->fetch_assoc();
                            
                            //checks if user exists
                            if($row["name"] == $_POST["name"]) {
                                $user_exists = true;
                            }
                        }
                        if($user_exists!=true)
                        {
                            //insert variables
                            $name = ucfirst($_POST["name"]);
                            if (preg_match('/[^\w]/', $name) || $name !== strip_tags($name))
                            {
                                echo "Username is not fine 😪";
                            }else
                            {
                                $password = hash('sha256',$_POST["password"]);

                                //inserts new user into database
                                $stmt = $conn->prepare("INSERT INTO player (`name`, `password`) VALUES (?, ?)");
                                $stmt->bind_param("ss", $name, $password);
                                $stmt->execute();
                                $newPlayerId = $stmt->insert_id;
                                $stmt->close();

                                //sets user id
                                $_SESSION["id"]=$newPlayerId;
                                $_SESSION["ui"]="none";
                                $_SESSION["debug_mode"]=false;

                                //sends user to get player initializesed
                                header("location:Initialize_new_player.php");
                            }
                        }else
                        {
                            echo "Username is already taken";
                        }
                    }else
                    {
                        echo"<p>Fill in all fourms<p>";
                    }
                ?>
                <a href="login.php">already have an account?</a>
            </form>
        </main>
    </body>
</html>