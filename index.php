<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="main.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="navBar" id="navBarId">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="blob.php">Upload image</a></li>
            <li class="icon"><a href="javascript:void();" onclick="navBarFunction();"><i class="fa fa-bars"></i></a></li>
        </ul>
    </div>

    <table class="product">

        <?php 
        
            include 'database.php';
            session_start();

            $query = "SELECT * FROM products";
            $statement = $connection->prepare($query);
            $statement->execute();
            $rows = $statement->rowCount();

            $tableRows = ceil($rows / 4);

            for($i=0;$i<$tableRows;$i++) {
                echo "<tr>";
                for($j=0;$j<4;$j++) {
                    $row = $statement->fetch();
                    echo "<td id='tdd'>";
                    echo "<img src='data:".$row['mime'].";base64,".base64_encode($row['item'])."' class='pimg'>";
                    echo "<h3>".$row['name']."</h3>";
                    echo "<p>".$row['description']."</p>";
                    echo "<p class='card-price'> From".$row['price']." € </p>";
                    echo "<i class='fa fa-info-circle' style='font-size:36px;color:rgb(145, 68, 68);'></i>  ";
                    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
                        echo "<a href='addToCart.php?product_id=".$row['product_id']."' method='post'>" . "Add to Cart" . "</a>";
                    }
                    echo "</td>";
                }

                echo "</tr>";
            }



        
        ?>
    

    

    </table>


    <script src="scripts/index.js"></script>


</body>
</html>