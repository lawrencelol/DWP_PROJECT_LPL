<?php include('../../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="userprofile.css"> 
    </head> 

<body>
        
    <!-- tab -->
    <header>
        <img src="logo.png" >
            <p>User Profile</p>
                <ul>
                    <li><a href="../../Main Page/Main_Page/index.php">Back To Home</a></li>
                </ul>
    </header>

    <br><br><br><br><br><br>

    <!-- User Personal Info -->
    <section class="profile">
        <img src="profilepic.png">
        <div class="info">
            <h2 class="information">Personal Information</h2>
            <h2>Username: </h2>
            <p>Boothill</p>
            <h2>Password: </h2>
            <p>666ihateyouaventurine</p>
            <h2>Email address: </h2>
            <p>boothill@gmail.com</p>
            <button class="edit">Edit User Info</button>
            <h2 class="information-1">Order Information</h2>
                <table class="order">
                    <tr>
                        <th>Order ID</th>
                        <th>Book Name</th>
                        <th>Total (RM)</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                    </tr>
                    <tr>
                        <td>0114</td>
                        <td>Knit It</td>
                        <td>48.00</td>
                        <td>31 May 2024</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>0114</td>
                        <td>Twins</td>
                        <td>22.00</td>
                        <td>31 May 2024</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>0114</td>
                        <td>That Thing Under My Bed</td>
                        <td>15.00</td>
                        <td>31 May 2024</td>
                        <td>Completed</td>
                    </tr>
                </table>
                <a href="../../Landing_Page/Landing.php"><button class="log-out">Log Out</button></a>
        </div>
    </section>

    <!-- allow user to edit their profile -->
    <div class="popup">
        <div class="close">&times;</div>
        <div class="form">
            <h3>Update Profile Info</h3>
            <div class="editinfo">
                <label for="profilepic">Profile Picture</label>
                <input type="file" id="profilepicture" placeholder="Insert Your Profile Picture Here">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Enter New Username">
                <label for="email">Email Address</label>
                <input type="email" id="email" placeholder="Enter New Email Address">
                <label for="password">Password</label>
                <input type="password" id="password" minlength="10" placeholder="Enter New Password">
                <label for="conpassword">Confirm Password</label>
                <input type="password" id="conpassword" minlength="10" placeholder="Enter Confirm Password">
                <button class="done">Done</button>
            </div>
        </div>
    </div>

    <!-- allow user to contact and rate -->
    <footer>
        <div>
            <h2>Facing problems? Contact us overhere!</h2>
            <a href="../Contact Us/Contact_Us_Page.php">Contact Us</a>
        </div>
        <div>
            <h2>Feel free to rate our system here!</h2>
            <a href="../Rate/Rate.php">Rate Us</a>
        </div>
    </footer>

    <!-- javascript the form only popup when click the button -->
    <script>
        document.querySelector(".edit").addEventListener("click", function(){document.querySelector(".popup").classList.add("active");});
        document.querySelector(".popup .close").addEventListener("click", function(){document.querySelector(".popup").classList.remove("active");})
    </script>

</body>
</html>