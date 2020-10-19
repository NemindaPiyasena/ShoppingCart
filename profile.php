<?php
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
        include('database.php');
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
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>Profile</title>
</head>
<body>

    <div class="nav-container">
        <nav class="navbar">
            <h1 id="navbar-logo">LUXCO</h1>
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav-menu">
                <li class="nav-container"><a href="#" class="nav-links">Home</a></li>
                <li class="nav-container"><a href="#" class="nav-links">Services</a></li>
                <li class="nav-container"><a href="#" class="nav-links">About Us</a></li>
                <li class="nav-container"><a href="#" class="nav-links">Contact Us</a></li>
                <?php
                    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                        echo '<li class="nav-container detector">';
                            echo '<div class="profile-links-container">';
                                echo '<div class="nav-links profile-links-btn">';
                                echo '<a href="profile.php" class="profile-link"><img src="images/profilePic.jpg" alt="" id="profile-img"></a>';
                                    echo '<a href="#" class="dropdown-arrow"><i class="fa fa-caret-down" aria-hidden="true"></i></a>';
                                echo '</div>';
                                echo '<ul class="nav-dropdown-menu">';
                                    echo '<a href="logout.php" style="text-decoration: none;"><li>Log Out</li></a>';
                                    echo '<hr>';
                                    echo '<a href="profile.php" style="text-decoration: none;"><li>Go to cart</li></a>';
                                    echo '<hr>';
                                    echo '<a href="#" style="text-decoration: none;"><li>Notifications</li></a>';
                                echo '</ul>';
                            echo '</div>';
                        echo '</li>';
                    } else {
                        echo "<li><a href='#' class='nav-links nav-links-btn main-btn detector' method='post'>Sign Up</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal" id="email-signup-modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <div class="modal-content-left">
                <img class="modal-img" src="images/pic2.svg" alt="">
            </div>
            <div class="modal-content-right">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="modal-form" id="form">
                <h1>Get started with us today! Create your account by filling out the information below.</h1>
                <div class="form-validation">
                    <input type="text" class="modal-input" id="name" name="username" placeholder="Enter your name">
                    <p>Error Message</p>
                </div>
                <div class="form-validation">
                    <input type="email" class="modal-input" id="email" name="email" placeholder="Enter your email">
                    <p>Error Message</p>
                </div>
                <div class="form-validation">
                    <input type="password" class="modal-input" id="password" name="password" placeholder="Enter your password">
                    <p>Error Message</p>
                </div>
                <div class="form-validation">
                    <input type="password" class="modal-input" id="password-confirm" name="password" placeholder="Confirm your password">
                    <p>Error Message</p>
                </div>
                <input type="submit" class="modal-input-btn" value="Sign Up" name="submitBtn">
                <span class="modal-input-login">Allready have an account? Login <a href="#" id="login-link-btn">here</a></span>
                </form>
            </div>
        </div>
    </div>

    <!-- Login -->
    <div class="login-modal" id="email-login-modal">
        <div class="modal-content">
            <span class="login-close-btn">&times;</span>
            <div class="modal-content-left">
                <img class="modal-img" src="images/pic2.svg" alt="">
            </div>
            <div class="modal-content-right">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="modal-form" id="login-form">
                <h1>Login now!. See what you have done with your account</h1>
                <div class="form-validation">
                    <input type="email" class="modal-input" id="login-email" name="loginEmail" placeholder="Enter your email">
                    <p>Error Message</p>
                </div>
                <div class="form-validation">
                    <input type="password" class="modal-input" id="login-password" name="loginPassword" placeholder="Enter your password">
                    <p>Error Message</p>
                </div>
                <input type="submit" class="modal-input-btn" value="Login" name="submitBtn">
                </form>
            </div>
        </div>
    </div>

    <article class="main">
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
                        <div class="profile-posts tab">
                            <?php
                                if($rows > 0) {
                                    for($i=0; $i<$rows; $i++) {
                                        $row = $statement->fetch();
                                        $productId = $row['product_id'];
                                        $query = "SELECT * FROM `products` WHERE product_id = :product_id";
                                        $productResult = $connection->prepare($query);
                                        $productResult->bindParam(':product_id', $productId);
                                        $productResult->execute();
                                        $row = $productResult->fetch();
                                        echo "<div class='profile'>";
                                            echo "<div class='cart-left'>";
                                                echo "<img src='data:".$row['mime'].";base64,".base64_encode($row['item'])."'>";
                                            echo "</div>";
                                            echo "<div class='cart-right'>";
                                                echo "<h2>".$row['name']."</h2>";
                                                echo "<p>".$row['description']."</p>";
                                                echo "<p>".$row['longdescription']."</p>";
                                                echo "<p>".$row['price']." € </p>";
                                                echo "<a name='".$productId."' onclick='deleteItem(name);' "."class='delete-cart-btn'>Delete</a>";
                                            echo "</div>";
                                        echo "</div>";
                                        echo "<hr>";
                                    }
                                } else {
                                    echo "<p style='text-align:center;'>There is no items in your cart. Browse through our site and look for somthing cool!. We are sure that you will find what you are exactly looking for.</p>";
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
    </article>
    
    <script src="profile.js?v=<?php echo time();?>"></script>
    <script src="app.js?v=<?php echo time();?>"></script>
</body>
</html>
