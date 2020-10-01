<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="main.css" type="text/css">
</head>
<body>
    <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Sign Up</a></li>
        <li><a href="blob.php">Upload image</a></li>
    </ul>

    <div class="product">

        <?php 
        
            include 'database.php';

            $query = "SELECT * FROM products";
            $statement = $connection->prepare($query);
            $statement->execute();
            $rows = $statement->rowCount();

            for($i=1; $i<=$rows; $i++) {
                $row = $statement->fetch();
                echo "<img src='data:".$row['mime'].";base64,".base64_encode($row['item'])."'>";
            }



        
        ?>
    

    

    </div>


</body>
</html>