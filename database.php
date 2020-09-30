<?php

    $username = "root";
    $password = "";
    $server = "mysql:host=localhost;dbname=shoppingcart";

    try {
        $connection = new PDO($server, $username, $password);
        echo 'Database connection successful';
    } catch(PDOException $e) {
        $errorMessage = $e->getMessage();
        include('database_error.php');
        exit();
    }

?>