<?php 
    include 'database.php';
    if(isset($_REQUEST["fileSubmitBtn"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileType = $_FILES["fileToUpload"]["type"];
        $fileData = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
         $sql = "INSERT INTO `cart`(`mime`, `item`, `name`) VALUES (:mime,:item,:name)";
        if($stmt=$connection->prepare($sql)){
            $stmt->bindParam(":mime",$fileType);
            $stmt->bindParam(":item",$fileData);
            $stmt->bindParam(":name",$fileName);
            if($stmt->execute()){
                header("location:blob.php?msg=1");
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
    Select image to upload:
    <input type="file" name="fileToUpload">
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