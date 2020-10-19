<?php
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        ;
    } else {
        if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_REQUEST["submitBtn"])) {
            include('database.php');
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $email = $_REQUEST['email'];
            $query = "INSERT INTO `users`(`username`, `password`, `email`)
                                    VALUES (:username, :password, :email)";
            $statement = $connection->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            if($statement->execute()) {
                session_start();
                $_SESSION['logged'] = true;
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $email;
                header('location:index.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="main.css?v = <?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css?v = <?php echo time(); ?>">
</head>
<body>
    <!-- <section id="headerSec">
        <img src="images/logo-small.png" alt="euroflora logo">

        <nav>
            <ul>
                <li>
                    <a href="index.html" class="navcontainer">
                        <i class="fa fa-home" aria-hidden="true" style="color: rgb(192, 92, 92);font-size: 20px;"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="contact.html" class="navcontainer">
                        <i class="fa fa-envelope" aria-hidden="true" style="color: rgb(192, 92, 92);font-size: 20px;"></i>
                        Contact us
                    </a>
                </li>
                <li>
                    <a href="index.html" class="navcontainer">
                        <i class="fa fa-th-large" aria-hidden="true" style="color: rgb(192, 92, 92);font-size: 20px;"></i>
                        The florist
                    </a>
                </li>
                <li>
                    <a href="index.html" class="navcontainer">
                        <i class="fa fa-camera" aria-hidden="true" style="color: rgb(192, 92, 92);font-size: 20px;"></i>
                        Gallery
                    </a>
                </li>
                <li>
                    <a href="index.html" class="navcontainer">
                        <i class="fa fa-cogs" aria-hidden="true" style="color: rgb(192, 92, 92);font-size: 20px;"></i>
                        How to order
                    </a>
                </li>
                <li>
                    <a href="index.html" class="navcontainer">
                        <i class="fa fa-phone" aria-hidden="true" style="color: rgb(192, 92, 92);font-size: 20px;"></i>
                        Order by phone
                    </a>
                </li>
                <li>
                    <a href="index.html" class="navcontainer">
                        <i class="fa fa-comment" aria-hidden="true" style="color: rgb(192, 92, 92);font-size: 20px;"></i>
                        Chat
                    </a>
                </li>
            </ul>
        </nav>
    </section> -->

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
                                    echo '<a href="logout.php"><li>Log Out</li></a>';
                                    echo '<hr>';
                                    echo '<a href="profile.php"><li>Go to cart</li></a>';
                                    echo '<hr>';
                                    echo '<a href="profile.php"><li>Notifications</li></a>';
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

    <article id="bodyForMain">
        <article id="firstChild">
            <section class="initialHeader">
                <p><b>Malshan Flora</b> your online Florist to deliver Flowers in Kotikawatta</p>
            </section>
        
            <section id="poster">
                <div id="discriptImg">
                    
                    <div class="innerDiscripter" id="firstPoster">
                        <h3>SEPTEMBER OFFERS: TODAY -15%</h3>
                        <hr \>
                        <p>Delivery service included</p>
                    </div>
                    <img src="images/euroflora-florist-flower-bouquet.jpg" alt="euroflora-florist-flower-bouquet" style="width: 100%;height: 100%;">
                    
                </div>
                <div id="discountImg">

                    <div id="secondPoster" class="innerDiscripter">
                        <p>Bright gerberas or daisies.<br \>alstroemerias and mixed fowers<br \>from 78.80 €</p>
                    </div>
                    <div id="burst-12"><p>-5%</p></div>
                    <img src="images/Cheyanne.jpg" alt="Cheyanne" style="width: 100%;height: 100%;">
                </div>                
            </section>

            <section>
                <p>
                    We offer a same day Flowers and Plants delivery service in Kotikawatta even in a few hours. 
                    From our online Flower shop can order nice Bouquets and Flowers Gifts quickly and easily. 
                    Choose your Bouquet from 68 € delivery included. Payments accepted: Credit Card and Paypal.
                </p>
            </section>

            <table class="product">
                <?php
                    include 'database.php';
                    $query = "SELECT * FROM products";
                    $statement = $connection->prepare($query);
                    $statement->execute();
                    $rows = $statement->rowCount();

                    $tableRows = ceil($rows / 4);

                    for($i=0;$i<$tableRows;$i++) {
                        echo "<tr>";
                        for($j=0;$j<4;$j++) {
                            $row = $statement->fetch();
                            echo "<td class='card'><a href='items.php?productId=".$row['product_id']."' >";
                            echo "<img src='data:".$row['mime'].";base64,".base64_encode($row['item'])."' class='productImage'>";
                            echo "<h3 class='cardHeader'>".$row['name']."</h3>";
                            echo "<p class='cardDiscriptor'>".$row['description']."</p>";
                            if($row['price'] != $row['previous_price']) {
                                echo "<p class='previousPrice'><s>".$row['previous_price']." €</s></p>";
                            }
                            echo "<p class='card-price'> From".$row['price']." € </p>";
                            echo "<i class='fa fa-info-circle' style='font-size:36px;color:rgb(145, 68, 68);'></i>";
                            /*if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
                                echo "<a href='addToCart.php?product_id=".$row['product_id']."' method='post'>" . "Add to Cart" . "</a>";
                            }*/
                            echo "</a></td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </table>

        </article>
    </article>
    <script src="app.js?v=<?php echo time();?>"></script>
</body>
</html>