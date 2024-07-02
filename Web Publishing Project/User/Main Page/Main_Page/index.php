<?php
session_start();
include("../../../connection.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home page</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Home.css"> 
    </head> 

    <body>
        
    <!-- tab selection -->
        <header>
            <img src="logo.png">
            <p>Home Page</p>
            <ul>
                <li><a href="../../Menu/Books/Display/BookDisplay.php">BOOKSHELF</a></li>
                <li><a href="../../Cart/Cart.php">CART</a></li>
                <li><a href="../../My Profile/User Profile/userprofile.php">MY<span style="padding-left:5px;">&#x200B;</span>PROFILE</a></li>
                <li><a href="../../My Profile/About Us/About_Us_Page.php">ABOUT<span style="padding-left:5px;">&#x200B;</span>US</a></li>
                <li><a href="../../Landing_Page/Landing.php">Log<span style="padding-left:5px;">&#x200B;</span>Out</a></li>
            </ul>
        </header>

        <body class="slider_body">
        <div class="main">
            <input type="radio" name="slider" id="slide-1" checked>
            <input type="radio" name="slider" id="slide-2">
            <input type="radio" name="slider" id="slide-3">
            <input type="radio" name="slider" id="slide-4">
            <input type="radio" name="slider" id="slide-5">

            <div class="cards">

                <label for="slide-1" id="slide1">
                    <div class="card">
                        <img class="bg-img" src="flippybackground.png" />
                        <div class="image">
                            <img src="Flippy The Silly Little Fish.png" alt="Flippy The Silly Little Fish">
                        </div>

                        <div class="infos">
                            <span class="name">Flippy The Silly Little Fish</span>
                            <span class="lorem">Your kids are invited to meet those spectacular sea creatures with Flippy!</span>

                            <!-- Book view -->
                            <a href="../../Menu/Books/BookDetail/BookDetail.php?id=1" class="btn-details">View Details</a> <!-- Add BookID here -->
                        </div>
                    </div>
                </label>

                <label for="slide-2" id="slide2">
                    <div class="card">
                        <img class="bg-img" src="dinosaurbackground.png" /> <!--background image-->
                        <div class="image">
                            <img src="Me and My Pet Dinosaur.png" alt="Me and My Pet Dinosaur"/>
                        </div>

                        <div class="infos">
                            <span class="name">Me and My Pet Dinosaur</span>
                            <span class="lorem">Introducing Lilith and her pet... A Dinosaur!</span>

                            <!-- Book view -->
                            <a href="../../Menu/Books/BookDetail/BookDetail.php?id=3" class="btn-details">View Details</a> <!-- Add BookID here -->
                        </div>
                    </div>
                </label>

                <label for="slide-3" id="slide3">
                    <div class="card">
                        <img class="bg-img" src="twinsbackground.png" /> <!--background image-->
                        <div class="image">
                            <img src="Twins.png" alt="picture-3">
                        </div>

                        <div class="infos">
                            <span class="name">Twins</span>
                            <span class="lorem">"You're my Sister?!"<br>"Yeah, but dead."</span>

                            <!-- Book view -->
                            <a href="../../Menu/Books/BookDetail/BookDetail.php?id=5" class="btn-details">View Details</a> <!-- Add BookID here -->
                        </div>
                    </div>
                </label>

                <label for="slide-4" id="slide4">
                    <div class="card">
                        <img class="bg-img" src="starbackground.png" /> <!--background image-->
                        <div class="image">
                            <img src="Children of The Star.png" alt="Children of The Star">
                        </div>

                        <div class="infos">
                            <span class="name">Children of The Star</span>
                            <span class="lorem">Don't cry. I'll guide you to home.</span>

                            <!-- Book view -->
                            <a href="../../Menu/Books/BookDetail/BookDetail.php?id=4" class="btn-details">View Details</a> <!-- Add BookID here -->
                        </div>
                    </div>
                </label>

                <label for="slide-5" id="slide5">
                    <div class="card">
                        <img class="bg-img" src="messbackground.png" /> <!--background image-->
                        <div class="image">
                            <img src="My Mind is A Mess.png" alt="My Mind is A Mess">
                        </div>

                        <div class="infos">
                            <span class="name">My Mind is A Mess</span>
                            <span class="lorem">The strings in my mind have been tangled for so long, and I don't know what to do.</span>

                            <!-- Book view -->
                            <a href="../../Menu/Books/BookDetail/BookDetail.php?id=6" class="btn-details">View Details</a> <!-- Add BookID here -->
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </body>

        <footer>
        </footer>
      
    </body>
</html>
