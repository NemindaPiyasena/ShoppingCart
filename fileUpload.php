<?php
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
        include('database.php');
        $fileName = $_FILES['picture']['name'];
        $mime = $_FILES['picture']['type'];
        $profilepic = file_get_contents($_FILES['picture']['tmp_name']);
        $userId = $_SESSION['user_id'];
        $query = "UPDATE users SET `profilepic` = :profilepic, `filename` = :filename, `mime` = :mime WHERE `user_id` = :user_id";
        $statement = $connection->prepare($query);
        $statement->bindParam(':profilepic', $profilepic);
        $statement->bindParam(':filename', $fileName);
        $statement->bindParam(':mime', $mime);
        $statement->bindParam(':user_id', $userId);
        if($statement->execute()) {
            $_SESSION['mime'] = $mime;
            $_SESSION['item'] = $profilepic;
            $data = array('status' => true);
        } else {
            $data = array('status' => false);
        }
        echo json_encode($data);
    } else {
        $data = array('status' => false);
        echo json_encode($data);
    }
?>