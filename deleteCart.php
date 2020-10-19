<?php
    session_start();
    include('database.php');
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
        $userId = $_SESSION['user_id'];
        $productId = $_REQUEST['product_id'];
        $query = "DELETE FROM `cart` WHERE user_id = :user_id AND product_id = :product_id";
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
