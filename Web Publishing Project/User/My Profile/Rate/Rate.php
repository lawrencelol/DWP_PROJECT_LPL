<?php include('../../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Stock</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="Rate.css">
    </head>

    <body>

        <header>
            <img src="logo.png" >
            <p>Rate Us</p>
            <ul>
                <li><a href="../../My Profile/About Us/About_Us_Page.php">< Back To About Us</a></li>
                <li><a href="../../My Profile/User Profile/userprofile.php">< Back To My Profile</a></li>
            </ul>
        </header>

        <section>
            <form action="#" class="rating-frm">
                <div class="rating">
                    <input type="number" name="rating" hidden>
                    <i class='bx bx-star star'></i>
                    <i class='bx bx-star star'></i>
                    <i class='bx bx-star star'></i>
                    <i class='bx bx-star star'></i>
                    <i class='bx bx-star star'></i>
                </div>
            </form>

            <label for="Username">Username</label>
            <textarea name="Username" placeholder="Type your username here..."></textarea>
            <!-- <input type="text" placeholder="Type your username here...">     -->
            <label for="comment">Your Comment:</label>
            <!-- <input type="text" placeholder="Type your comment here...."> -->
            <textarea name="comment" cols="30"  rows="5" placeholder="Type your comment here..."></textarea>
            
            <div class="btn">
            <button type="submit" class="submit_btn">Submit</button>
            <button type="button" class="cancel" onclick="history.back();">Cancel</button>
            </div>
        </div>
        </section>

        <script src="rate.js"></script>

        <footer>
        </footer>
    </body>
</html>