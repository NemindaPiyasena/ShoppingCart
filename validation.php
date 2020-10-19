<?php
    include('database.php');
    $email = $_REQUEST['email'];
    $query = "SELECT * FROM users WHERE email = :email";
    $statement = $connection->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();
    if($statement->rowCount() > 0) {
        $data = array("status" => false);
    } else {
        $data = array("status" => true);
    }
    echo json_encode($data);
?>
