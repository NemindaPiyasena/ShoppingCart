<?php
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_REQUEST["submitBtn"])) {
        echo "passed 0";
        include('database.php');
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $email = $_REQUEST['email'];
        echo $email;
        echo $username;
        echo $password;
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $connection->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        if($statement->rowCount() == 0) {
            echo "passed 1";
            $query = "INSERT INTO users (`username`, `password`, `email`)
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
        } else {
            // echo "<script type='text/javascript'>
            //     const email = document.getElementById('email');
            //     document.write(showError(email, 'There is already an account created from this email'));
            //     </script>";
            echo "eeee";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Document</title>
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
                <li><a href="#" class="nav-links">Home</a></li>
                <li><a href="#" class="nav-links">Services</a></li>
                <li><a href="#" class="nav-links">About Us</a></li>
                <li><a href="#" class="nav-links">Contact Us</a></li>
                <li><a href="#" class="nav-links nav-links-btn">Sign Up</a></li>
            </ul>
        </nav>
    </div>
    <button class="main-btn"><a href="#">Get Started</a></button>

    <!-- Modal -->
    <div class="modal" id="email-modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <div class="modal-content-left">
                <img id="modal-img" src="images/pic2.svg" alt="">
            </div>
            <div class="modal-content-right">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="modal-form" id="form">
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
                <span class="modal-input-login">Allready have an account? Login <a href="#">here</a></span>
                </form>
            </div>
        </div>
    </div>
    <script src="app.js?v=<?php echo time(); ?>"></script>
</body>
</html>