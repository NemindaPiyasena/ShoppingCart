<?php
    session_start();
    include('database.php');
    $email = $_REQUEST['loginEmail'];
    $password = $_REQUEST['loginPassword'];
    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $satatement = $connection->prepare($query);
    $satatement->bindParam(':email', $email);
    $satatement->bindParam(':password', $password);
    $satatement->execute();
    if($satatement->rowCount() == 1) {
        $row = $satatement->fetch();
        $_SESSION['logged'] = true;
        $_SESSION['password'] = $row['password'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_id'] = $row['user_id'];
        $data = array("status" => true);
    } else {
        $data = array("status" => false);
    }
    echo json_encode($data);
?>
