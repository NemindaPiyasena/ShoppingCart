<?php
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
        include('database.php');
        $email = $_SESSION['email'];
        $query = "SELECT user_id FROM users WHERE email=:email";
        $statement = $connection->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $row = $statement->fetch();
        $userId = $row['user_id'];
        $query = "SELECT * FROM `cart` WHERE user_id = :user_id";
        $statement = $connection->prepare($query);
        $statement->bindparam(':user_id', $userId);
        $statement->execute();
        $rows = $statement->rowCount();
    } else {
        header('location:index.php');
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>

    

    <div class="container">
        <div class="profile-header">
            <div class="profile-img">
                <img src="images/profilePic.jpg" alt="profilePic" width="200px">
            </div>
            <div class="profile-nav-info">
                <h3 class="user-name">Bright Code</h3>
                <div class="address">
                    <p class="state">
                        New York,
                    </p>
                    <span class="country">USA.</span>
                </div>
            </div>
            <div class="profile-option">
                <div class="notification">
                    <i class="fa fa-bell"></i>
                    <span class="alert-message">1</span>
                </div>
            </div>
        </div>
        <div class="main-bd">

            <div class="left-side">
                <div class="profile-side">
                    <p class="mobile-number">
                        <i class="fa fa-phone"></i>
                        +12345678910
                    </p>
                    <p class="user-mail">
                        <i class="fa fa-envelope"></i>
                        Brightisaac80gmail.com
                    </p>
                    <div class="user-bio">
                        <h3>Bio</h3>
                        <p class="bio">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                            Quos facilis incidunt fugit nostrum enim hic?
                        </p>
                    </div>
                    <div class="profile-btn">
                        <button class="chatbtn">
                            <i class="fa fa-comment"></i>
                            Chat
                        </button>
                        <button class="createbtn">
                            <i class="fa fa-plus"></i>
                            Create
                        </button>
                    </div>
                    <div class="user-rating">
                        <h3 class="rating">4.5</h3>
                        <div class="rate">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="no-user">
                                <span>123</span>
                                &nbsp;&nbsp;
                                reviews
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-side">
                <div class="nav">
                    <ul>
                        <li class="user-post active" onclick="tabs(0)">My Cart</li>
                        <li class="user-review" onclick="tabs(1)">User Reviews</li>
                        <li class="user-settings" onclick="tabs(2)">Account Settings</li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="profile-posts tab profile">
                        <?php
                            for($i=0; $i<$rows; $i++) {
                                echo "<div class='profile'>";
                                    echo "<div class='cart-left'>";
                                        echo "<img src='images/profilePic.jpg'>";
                                    echo "</div>";
                                    echo "<div class='cart-right'>";
                                        echo "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum magnam sapiente asperiores, reprehenderit non dolorem quia ut voluptatibus molestias enim unde at tempora dolorum aperiam corrupti quasi. Culpa saepe ipsam, porro excepturi dolorum amet reprehenderit iure incidunt necessitatibus atque autem architecto inventore cumque molestias quis, deserunt perferendis nostrum molestiae numquam facilis dicta officia minima? Beatae nobis obcaecati corporis eius qui reiciendis quaerat numquam. Vel repellat soluta delectus, id sit ratione?</p>                                <p>name</p>";
                                        echo "<p>Data</p>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<hr>";
                            } 
                        ?>                   
                    </div>
                    <div class="profile-reviews tab profile">
                        <div class="profile">
                            <span>Account Settings</span>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum magnam sapiente asperiores, reprehenderit non dolorem quia ut voluptatibus molestias enim unde at tempora dolorum aperiam corrupti quasi. Culpa saepe ipsam, porro excepturi dolorum amet reprehenderit iure incidunt necessitatibus atque autem architecto inventore cumque molestias quis, deserunt perferendis nostrum molestiae numquam facilis dicta officia minima? Beatae nobis obcaecati corporis eius qui reiciendis quaerat numquam. Vel repellat soluta delectus, id sit ratione?</p>
                        </div>
                    </div>
                    <div class="profile-settings tab">
                        <div class="profile">
                            <span>Account Settings</span>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum magnam sapiente asperiores, reprehenderit non dolorem quia ut voluptatibus molestias enim unde at tempora dolorum aperiam corrupti quasi. Culpa saepe ipsam, porro excepturi dolorum amet reprehenderit iure incidunt necessitatibus atque autem architecto inventore cumque molestias quis, deserunt perferendis nostrum molestiae numquam facilis dicta officia minima? Beatae nobis obcaecati corporis eius qui reiciendis quaerat numquam. Vel repellat soluta delectus, id sit ratione?</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="profile.js?v=<?php echo time();?>"></script>
</body>
</html>