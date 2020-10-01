<?php


    session_start();

    if(isset($_SESSION) && $_SESSION["logged"] == true){
        echo $_SESSION["username"];
        echo $_SESSION["name"];
    } else {
        header("location:login.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <a href="logout.php">Logout</a>
</body>
</html>