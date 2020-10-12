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
    <link rel="stylesheet" href="style.css">
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
                <li><a href="#" class="nav-links">Home</a></li>
                <li><a href="#" class="nav-links">Services</a></li>
                <li><a href="#" class="nav-links">About Us</a></li>
                <li><a href="#" class="nav-links">Contact Us</a></li>
                <li><a href="#" class="nav-links nav-links-btn">Sign Up</a></li>
            </ul>
        </nav>
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
    <script src="app.js"></script>
</body>
</html>