<?php
    session_start();
    include('database.php');
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
        if(!isset($_SESSION['user_id'])){
            $email = $_SESSION['email'];
            $query = "SELECT user_id FROM users WHERE email=:email";
            $statement = $connection->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->execute();
            $row = $statement->fetch();
            $userId = $row['user_id'];
        } else {
            $userId = $_SESSION['user_id'];
        }
        $productId = $_SESSION['productId'];
        $query = "INSERT INTO `cart`(`user_id`, `product_id`) VALUES (:user_id, :product_id)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':user_id', $userId);
        $statement->bindParam(':product_id', $productId);
        if($statement->execute()) {
            $data = array("status" => true);
        } else {
            $data = array("status" => false);
        }
        echo json_encode($data);
    } else {
        $data = array("status" => false);
        echo json_encode($data);
    }
?>
