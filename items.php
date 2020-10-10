<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The smile</title>
    <link rel="stylesheet" href="main.css" type="text/css">
    <link rel="stylesheet" href="thesmile.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <section id="headerSec">
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
    </section>

    <section>        
        <article id="mainBody">
            <?php
            include 'database.php';
            $query = "SELECT * FROM products WHERE product_id = ".$_REQUEST['productId'];
            $statement = $connection->prepare($query);
            $statement->execute();
            $row = $statement->fetch();
            ?>
            <div id="left" class="common">
                <?php
                    echo "<img src='data:".$row['mime'].";base64,".base64_encode($row['item'])."' >";
                ?>
                <p>Price(delivery included)</p>
                <hr \>
                <form>
                    <div class="borders" id="option1" onclick="changeColor(id);">
                        <input type="radio" name="time" value="Standard" checked="true">
                        <label for="option1">Standard 78.90 € </label>
                        <i class="fa fa-info-circle" style="font: size 16px;color:rgb(145, 68, 68);padding: 0%;"></i>
                    </div>
                    <div class="borders"  id="option2" onclick="changeColor(id);">
                        <input type="radio" name="time" value="Delux">
                        <label for="option2">Delux 98.90 € </label>
                        <i class="fa fa-info-circle" style="font: size 16px;color:rgb(145, 68, 68);padding: 0%;"></i>
                    </div>
                    <div class="borders" id="option3" onclick="changeColor(id);">
                        <input type="radio" id="option3" name="time" value="Premium">
                        <label for="option3">Premium 118.90 € </label>
                        <i class="fa fa-info-circle" style="font: size 16px;color:rgb(145, 68, 68);padding: 0%;"></i>
                    </div>
                </form>

                <p style="background-color: rgb(145, 68, 68);padding-top: 1%;width: 60%;";">Total 78.90 €(delivery included)</p>
                <p>The Smile 78.90 €</p>
                
            </div>



            <div id="right" class="common">
                <?php echo "<h2 class='initialHeader'>".$row['name']."</h2>" ?>
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
                            <input type="radio" id="working" name="time" value="working" checked="true">
                            <label for="working">Working Day - Free(9.00 a.m.-9.00 p.m.) </label><i class="fa fa-info-circle" style="font: size 16px;color:rgb(145, 68, 68);padding: 0%;"></i><br \>
                            <input type="radio" id="holiday" name="time" value="holiday">
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
                            <textarea name="message" id="message" cols="60" rows="10"></textarea>
                            <p class="hintsR">250 characters remaining</p>
                        </div>
                    </div>
                    <div class="formElements">
                        <label for="signature" class="leftF">Signature</label>
                        <div>
                            <input type="text" id="signature" name="signature">
                            <p class="hintsR">if the message is not signed, it will be delivered anonymously</p>
                        </div>
                    </div>
                    
                    <div id="submitBtn"><input type="submit" value="Continue" style="background-color: rgb(145, 68, 68);"></div>

                </form>
                
            </div>


        </article>
    </section>



</body>
<script src="thesmile.js"></script>
</html>