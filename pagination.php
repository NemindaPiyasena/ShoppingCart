<?php

    //connect to database
    include 'database.php';
    //determine the number of items per page
    $numbersOfItemsPerPage = 10;
    $numberOfLinksPerPage = 10;

    //find the number of items available in the database
    $query = "SELECT * FROM city";
    $statement = $connection->prepare($query);
    $statement->execute();
    $rows = $statement->rowCount();

    //find the number of pages

    $numberOfPages = ceil($rows/$numbersOfItemsPerPage);


    //determine the page number where the user is currently at

    if(!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    //determine the sql LIMIT starting number for the results on the displaying page

    $limitStartingNumber = ($page-1)*$numbersOfItemsPerPage;


    //retrieve the selected results from the table and display them
    $query = "SELECT * FROM city LIMIT ".$limitStartingNumber.", ".$numbersOfItemsPerPage;
    $statement = $connection->prepare($query);
    $statement->execute();
    $rows = $statement->rowCount();
    for($i=0;$i<$rows;$i++){
        $row = $statement->fetch();
        echo $row["Name"].' '.$row["CountryCode"].'<br />';
    }

    //create links to pages
    $linkLimit = $page + $numberOfLinksPerPage;
    $next = $page+1;
    $previous = $page-1;
    echo '<a href="pagination.php?page='.$previous.'">'.'Previous </a>';
    for(; $page<$linkLimit; $page++) {
        echo '<a href="pagination.php?page='.$page.'">'.$page.'</a>';
    }

    echo '<a href="pagination.php?page='.$next.'">'.'Next </a>';
    
?>
