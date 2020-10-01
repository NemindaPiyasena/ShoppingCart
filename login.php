<?php
    session_start();
    $username = $password = "";
    $username_err = $password_err = "";
    if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
        header("location:profile.php");
    } else {
        include("database.php");
        if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_REQUEST["submitBtn"])) {
            if(empty(trim($_REQUEST["username"]))) {
                $username_err = "Please enter a username";
            } else {
                $username = $_REQUEST["username"];
            }
            if(empty(trim($_REQUEST["password"]))) {
                $password_err = "Please enter the password";
            } else {
                $password = $_REQUEST["password"];
            }

            if (empty($username_err) && empty($password_err)) {
                $query = "SELECT * FROM users WHERE username = :username AND password = :password";
                $statement = $connection->prepare($query);
                $statement->bindParam(":username", $username);
                $statement->bindParam(":password", $password);
                $statement->execute();
                if($statement->rowCount()==1) {
                    $result = $statement->fetch();
                    $_SESSION["username"] = $result["username"];
                    $_SESSION["name"] = $result["displayname"];
                    $_SESSION["logged"] = true;
                    header("location:profile.php");
                }else {

                    
                    echo "The username and password you entered does not match";
                }
            }

        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
        <input type="text" placeholder="enter username" name="username"><br />
        <p><?php echo $username_err; ?></p>
        <input type="password" name="password" id="password" placeholder="enter the password"><br />
        <p><?php echo $password_err; ?></p>
        <input type="submit" value="Login" name="submitBtn">
    
    </form>
    
</body>
</html>