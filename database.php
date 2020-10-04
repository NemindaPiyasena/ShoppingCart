<?php

    try{

        $servername = "localhost";
        $username = "root";
        $password = "";
        $connection = new PDO("mysql:host=$servername;dbname=shoppingcart", $username, $password);
    } catch(PDOException $e) {
        echo $e;
    }

?>