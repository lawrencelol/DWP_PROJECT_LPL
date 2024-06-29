<?php
session_start();
include('../../../connection.php'); // Adjust the path to your actual connection.php location

// Check if the connection to the database is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve cart items for the current user
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($connect, $query);

if (!$result) {
    echo "Error: " . mysqli_error($connect);
    exit();
}

// Fetch current user information
$result = mysqli_query($connect, "SELECT * FROM user_register WHERE id = $user_id");
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Function to sanitize input data
    function sanitize($data) {
        global $connect;
        return mysqli_real_escape_string($connect, htmlspecialchars(strip_tags(trim($data))));
    }

    // Process form submission
    if (isset($_POST["done"])) {
        // Sanitize user inputs
        $profilePIC = sanitize($_POST["profilepicture"]);
        $username = sanitize($_POST["username"]);
        $email = sanitize($_POST["email"]);
        $password = sanitize($_POST["password"]);
        $conpassword = sanitize($_POST["conpassword"]);

        // Approve the profile update if the passwords match
        if ($conpassword == $password) {
            // Update user information in the table user_register
            $query = "UPDATE user_register SET username='$username', userpass='$password', email='$email', profile_picture='$profilePIC' WHERE id = $user_id";
            if (mysqli_query($connect, $query)) {
                ?>
                <script type="text/javascript">
                    alert("Your Profile Successfully Updated");
                    window.location.href = "userprofile.php"; // Redirect to profile page after update
                </script>
                <?php
            } else {
                ?>
                <script type="text/javascript">
                    alert("Error updating profile: <?php echo mysqli_error($connect); ?>");
                </script>
                <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("Your password does not match the confirm password");
            </script>
            <?php
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="userprofile.css"> 
</head> 
<body>
    <!-- Header -->
    <header>
        <img src="logo.png">
        <p>User Profile</p>
        <ul>
            <li><a href="../../Main Page/Main_Page/index.php">Back To Home</a></li>
        </ul>
    </header>

    <br><br><br><br><br><br>

    <!-- User Personal Info -->
    <section class="profile">
        <img src=<?php echo "../../../images/".$row['profile_picture']?> alt="Profile Picture">
        <div class="info">
            <h2 class="information">Personal Information</h2>
            <h2>Username: </h2>
            <p><?php echo $row['username']; ?></p>
            <h2>Password: </h2>
            <p><?php echo $row['userpass']; ?></p>
            <h2>Email address: </h2>
            <p><?php echo $row['email']; ?></p>
            <button class="edit">Edit User Info</button>
            <h2 class="information-1">Order Information</h2>
            <!-- Replace with actual order data retrieved from database -->
            <table class="order">
                <tr>
                    <th>Order ID</th>
                    <th>Book Name</th>
                    <th>Total (RM)</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                </tr>
                <!-- Example rows (replace with dynamic data from database) -->
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

    <!-- Edit profile popup -->
    <div class="popup">
        <div class="close">&times;</div>
        <div class="form">
            <h3>Update Profile Info</h3>
            <form method="POST" action="">
                <div class="editinfo">
                    <label for="profilepicture">Profile Picture</label>
                    <input type="file" id="profilepicture" name="profilepicture" placeholder="Insert Your Profile Picture Here">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter New Username" value="<?php echo $row['username']; ?>">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter New Email Address" value="<?php echo $row['email']; ?>">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="10" placeholder="Enter New Password">
                    <label for="conpassword">Confirm Password</label>
                    <input type="password" id="conpassword" name="conpassword" minlength="10" placeholder="Enter Confirm Password">
                    <button type="submit" name="done" class="done">Done</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
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

    <!-- Script to handle edit profile popup -->
    <script>
        document.querySelector(".edit").addEventListener("click", function(){document.querySelector(".popup").classList.add("active");});
        document.querySelector(".popup .close").addEventListener("click", function(){document.querySelector(".popup").classList.remove("active");})
    </script>
</body>
</html>
<?php
} else {
    // Handle case where user ID does not exist
    echo "User not found.";
}
?>
