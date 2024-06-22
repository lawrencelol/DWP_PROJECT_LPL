<?php include('../../../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Display</title>
    <link rel='stylesheet' href='BookDisplay.css'>
</head>
<body>

<!--这里是上方标签-->
<header>
    <img src="logo.png" >
    <h1>Welcome To Our Bookshelf!</h1>
    <ul>
        <li><a href="../../../Main Page/Main_Page/index.php">HOME</a></li>
        <li>
            <div class="dropdown">
                <span>CATEGORY</span>
                <div class="choice">
                <a href="#picturebook" class="selections">Picture Book</a>
                <a href="#novel" class="selections">Novel</a>
                <a href="#guidebook" class="selections">Guidebook</a>
                </div>
            </div>
        </li>
        <li><a href="../../../Cart/Cart.php">CART</a></li>
    </ul>
</header>


<!--这里是品牌头-->
<p><br><br><br><br></p>
<section class="slogan">
    <img src="bookshelf.png">
</section>


<!--这里是书籍展示-->

<!--这里是儿童读物-->
<p id="picturebook"><br><br><br><br>
<h3 class="desc_h3">PICTURE BOOK</h3>
<p class="desc_p">Teaching a toddler is a challenge, since the wisest sentence coming out from a toddler’s mouth is either “Gugugaga” or “Gagageegee”. But fear not, a picture book with colourful illustrations and basic vocabulary is all you need! Let them become Einstein from a young age! </p> 

<section class="book">
    <div class="picturebook">
    <div>
        <img src="Flippy The Silly Little Fish.png" alt="Flippy The Silly Little Fish">
        <h3>Flippy The Silly Little Fish</h3>
        <p>RM 12.00</p>
        <a class="view" href="../Book 1/Book_1.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
    <div>
        <img src="That Thing Under My Bed.png" alt="That Thing Under My Bed">
        <h3>That Thing Under My Bed</h3>
        <p>RM 15.00</p>
        <a class="view" href="../Book 2/Book_2.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
    <div>
        <img src="Me and My Pet Dinosaur.png" alt="Me and My Pet Dinosaur">
        <h3>Me and My Pet Dinosaur</h3>
        <p>RM 10.00</p>
        <a class="view" href="../Book 3/Book_3.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
    </div>
</section>

<!--这里是小说-->
<p id="novel"><br><br><br><br></p>
    <h3 class="desc_h3">NOVEL</h3>
    <p class="desc_p">Imagine diving into the world of a novel. It's like embarking on an epic adventure without ever leaving your chair. Whether you're uncovering secrets in a mystery, exploring distant galaxies in sci-fi, or falling in love in a romance, a novel lets your mind explore endless possibilities.</p> 

<section class="book">
    <div class="novel">
    <div>
        <img src="Children of The Star.png" alt="Children of The Star">
        <h3>Children of The Star</h3>
        <p>RM 20.00</p>
        <a class="view" href="../Book 4/Book_4.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
    <div>
        <img src="Twins.png" alt="Twins">
        <h3>Twins</h3>
        <p>RM 22.00</p>
        <a class="view" href="../Book 5/Book_5.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
    <div>
        <img src="My Mind is A Mess.png" alt="My Mind is A Mess">
        <h3>My Mind is A Mess</h3>
        <p>RM 36.00</p>
        <a class="view" href="../Book 6/Book_6.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div>
    </div> 
</section>

<!--这里是教材书-->
    <p id="guidebook"><br><br><br><br></p>
    <h3 class="desc_h3">GUIDEBOOK</h3>
    <p class="desc_p">When it comes to mastering a new skill or hobby, nothing beats a guidebook. Think of it as your personal mentor, patiently walking you through each step with clear instructions and helpful tips. Whether you're looking to cook gourmet meals, build a birdhouse, or start a garden, a guidebook provides you with the knowledge and confidence to succeed. </p> 

<section class="book">
    <div class="guidebook">
    <div>
        <img src="100 Ways To Bake.png" alt="100 Ways To Bake">
        <h3>100 Ways To Bake</h3>
        <p>RM 40.00</p>
        <a class="view" href="../Book 7/Book_7.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
    <div>
        <img src="Knit It.png" alt="Knit It">
        <h3>Knit It</h3>
        <p>RM 48.00</p>
        <a class="view" href="../Book 8/Book_8.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
    <div>
        <img src="Cook Like A Pro.png" alt="Cook Like A Pro">
        <h3>Cook Like A Pro</h3>
        <p>RM 70.00</p>
        <a class="view" href="../Book 9/Book_9.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
    <div>
        <img src="Know Your Plants.png" alt="Know Your Plants">
        <h3>Know Your Plants</h3>
        <p>RM 50.00</p>
        <a class="view" href="../Book 10/Book_10.php"><button class="button type1"><span class="cart-txt">View Details</span></button></a>
    </div> 
</section>

    
</body>
</html>