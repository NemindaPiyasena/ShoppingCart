<?php
    session_start();
    if(isset($_REQUEST['productId'])) {
        $_SESSION['productId'] = $_REQUEST['productId'];
    }
    include 'database.php';
    $query = "SELECT * FROM products WHERE product_id = ".$_SESSION['productId'];
    $statement = $connection->prepare($query);
    $statement->execute();
    $row = $statement->fetch();
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
                    $_SESSION['mime'] = $row['mime'];
                    $_SESSION['item'] = $row['item'];
                    header('location:items.php');
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['name']?></title>
    <link rel="stylesheet" href="main.css?v = <?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="items.css?v = <?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css?v = <?php echo time(); ?>">
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
                                    if($_SESSION['mime'] == null) {
                                        echo '<a href="profile.php" class="profile-link"><img src="images/defaultProfilePic.jpg" alt="" id="profile-img"></a>';
                                    } else {
                                        echo "<a href='profile.php' class='profile-link'><img src='data:".$_SESSION['mime'].";base64,".base64_encode($_SESSION['item'])."' alt='' id='profile-img'></a>";
                                    }
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

    <section>        
        <article id="mainBody">
            <div id="left" class="common">
                <?php
                    echo "<img src='data:".$row['mime'].";base64,".base64_encode($row['item'])."' >";
                ?>
                <p>Price(delivery included)</p>
                <hr \>
                <form>
                    <div class="borders" id="option1">
                        <input id="standard" type="radio" name="time" value=<?php echo $row['price']; ?> checked="true" onfocus="setTotal(id);" >
                        <label for="standard">Standard <?php echo $row['price']; ?> € </label>
                        <i class="fa fa-info-circle" style="font: size 16px;color:rgb(145, 68, 68);padding: 0%;"></i>
                    </div>
                    <div class="borders"  id="option2">
                        <input id="delux" type="radio" name="time" value=<?php echo $row['price']+20; ?> onfocus="setTotal(id);" >
                        <label for="delux">Delux <?php echo $row['price']+20; ?> € </label>
                        <i class="fa fa-info-circle" style="font: size 16px;color:rgb(145, 68, 68);padding: 0%;"></i>
                    </div>
                    <div class="borders" id="option3">
                        <input id="premium" type="radio" id="option3" name="time" value=<?php echo $row['price']+40; ?> onfocus="setTotal(id);" >
                        <label for="premium">Premium <?php echo $row['price']+40; ?> € </label>
                        <i class="fa fa-info-circle" style="font: size 16px;color:rgb(145, 68, 68);padding: 0%;"></i>
                    </div>
                </form>

                <input type="text" readonly value="Total 78.90 €(delivery included)" id="total" >
                <p><?php echo $row['name']." " ?><input type="text" id="currentItem" value=<?php echo $row['price']; ?> readonly > €</p>
                
            </div>



            <div id="right" class="common">
                <?php
                    echo "<div id='cart-show'>";
                        echo "<h2 class='initialHeader' id='item-title'>".$row['name']."</h2>";
                        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
                            echo "<a id='add-cart-btn'>Add to cart</a>";
                        }
                    echo "</div>";
                ?>
                <p>
                    <?php
                        echo "<b>".$row['longdescription']."</b>"
                    ?>
                </p>
                <p>
                    <i class="fa fa-info-circle" style="font-size:24px;color:rgb(145, 68, 68);padding-top: 1%;"></i>
                    Seasonal Flowers or Plants may be changed if unavailable. 
                    However, we will try to stick to the type of the chosen flowers as much as possible. 
                    The vase is not included. The picture usually referring the "Deluxe" arrangement. 
                </p>
                <hr \>

                <form>
                    <div class="formElements">
                        <label for="delDate" class="leftF">Delivery date*</label>
                        <input type="date" id="delDate" name="delDate">
                    </div>
                    <div class="formElements">
                        <label class="leftF">Delivery time</label>
                        <div>
                            <input type="radio" id="working" name="time" value="0" checked="true" onfocus="setDelivery(id);">
                            <label for="working">Working Day - Free(9.00 a.m.-9.00 p.m.) </label><i class="fa fa-info-circle" style="font: size 16px;color:rgb(145, 68, 68);padding: 0%;"></i><br \>
                            <input type="radio" id="holiday" name="time" value="4" onfocus="setDelivery(id);">
                            <label for="holiday">Sunday and Public Holidays 4.00 € </label><i class="fa fa-info-circle" style="font-size:16px;color:rgb(145, 68, 68);padding: 0%;"></i>
                        </div>
                    </div>
                    <div class="formElements">
                        <label for="quantity" class="leftF">Quantity*</label>
                        <input type="text" id="quantity" name="quantity">
                    </div>
                    <div class="formElements">
                        <div class="leftF">
                            <label for="message">Message</label>
                            <p style="padding-top: 6%;color: rgb(192, 92, 92);font-size: smaller;">Out of ideas? Choose a <br \>message!</p>
                        </div>
                        <div>
                            <textarea name="message" id="message" cols="60" rows="10" onkeyup="setRemaining();" onkeydown="setRemaining();" maxlength="600"></textarea>
                            <p class="hintsR"><input type="text" id="remain" class="hintsR" value="600" readonly /> characters remaining</p>
                        </div>
                    </div>
                    <div class="formElements">
                        <label for="signature" class="leftF">Signature</label>
                        <div>
                            <input type="text" id="signature" name="signature">
                            <p class="hintsR">if the message is not signed, it will be delivered anonymously</p>
                        </div>
                    </div>
                    
                    <div id="submitBtn"><input type="submit" value="Continue" style="background-color: rgb(145, 68, 68);" id="sButton"></div>

                </form>
                
            </div>


        </article>
    </section>

    <script src="items.js?v<?php echo time();?> "></script>
    <script src="app.js?v<?php echo time();?>"></script>
    <script src="cart.js?v<?php echo time();?>"></script>

</body>
</html>
