<?php 
    include 'database.php';
    if(isset($_REQUEST["fileSubmitBtn"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileType = $_FILES["fileToUpload"]["type"];
        $fileData = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
        $productName = $_REQUEST["name"];
        $description = $_REQUEST["discription"];
        $longdescription = $_REQUEST["longdiscription"];
        $price = $_REQUEST["price"];
        $peviousPrice = $_REQUEST["previous_price"];

        $sql = "INSERT INTO `products`(`name`, `filename`, `mime`, `item`, `price`, `previous_price`, `description`, `longdescription`) 
                            VALUES (:name, :filename, :mime, :item, :price, :previous_price, :description, :longdescription)";
        if($stmt=$connection->prepare($sql)){
            $stmt->bindParam(":mime",$fileType);
            $stmt->bindParam(":item",$fileData);
            $stmt->bindParam(":filename",$fileName);
            $stmt->bindParam(":name", $productName);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":previous_price", $peviousPrice);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":longdescription", $longdescription);
            if($stmt->execute()){
                header("location:blob.php?msg=1");
            }
            else {
                echo "error";
            }
        }

    }
    








?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File upload</title>
</head>
<body>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
    <label>product name:</label>
    <input type="text" name="name"><br>
    <label>product description:</label>
    <input type="text" name="discription"><br>
    <label>long description:</label>
    <input type="text" name="longdiscription"><br>
    <label>product price:</label>
    <input type="text" name="price"><br>
    <label>previous price:</label>
    <input type="text" name="previous_price"><br>
    <label>Select image to upload:</label>
    <input type="file" name="fileToUpload"><br>

    <input type="submit" value="Upload Image" name="fileSubmitBtn">
    </form>

    <div class="grid-container">
        <?php
            $sql2 = "SELECT * FROM cart";
            if($stat = $connection->prepare($sql2)){
                $stat->execute();
                while($row = $stat->fetch()){
                    echo "<img src='data:".$row['mime'].";base64,".base64_encode($row['item'])."'>";
                }
            }
        ?>
    </div>
    
</body>
</html>