<?php
    session_start();
    include "database.php";
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
        if(!isset($_SESSION['user_id'])){
            echo "Done";
        }
        echo $_REQUEST['product_id'];
        $query = "INSERT INTO `cart`(`user_id`, `product_id`) VALUES (:user_id, :product_id)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':user_id', $_SESSION['user_id']);
        $statement->bindParam(':product_id', $_REQUEST['product_id']);
        if($statement->execute()) {
            echo 'successful';
        } else {
            echo "error";
        }


    }


?>