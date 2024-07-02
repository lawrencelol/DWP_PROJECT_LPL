<?php
session_start();
include('../../Main Page/Login/connection.php'); // Adjust the path to your actual connection.php location

// Check if the connection to the database is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Main Page/Login/Login.php");
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

// Fetch current user information including phone number
$result = mysqli_query($connect, "SELECT * FROM user_register WHERE id = $user_id");

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Fetch order information for the current user
    $order_query = "SELECT * FROM orders WHERE user_id = $user_id";
    $order_result = mysqli_query($connect, $order_query);
    $orders = mysqli_fetch_all($order_result, MYSQLI_ASSOC);

    // Function to sanitize input data
    function sanitize($data) {
        global $connect;
        return mysqli_real_escape_string($connect, htmlspecialchars(strip_tags(trim($data))));
    }

    // Process form submission
if (isset($_POST["done"])) {
    // Sanitize user inputs
    $username = sanitize($_POST["username"]);
    $birthday = sanitize($_POST["birthday"]);
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);
    $conpassword = sanitize($_POST["conpassword"]);
    $phone = sanitize($_POST["phone"]);
    $profilePIC = $row['profile_picture']; // Default to the current profile picture

    // Handle file upload
    if (isset($_FILES['profilepicture']) && $_FILES['profilepicture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profilepicture']['tmp_name'];
        $fileName = $_FILES['profilepicture']['name'];
        $fileSize = $_FILES['profilepicture']['size'];
        $fileType = $_FILES['profilepicture']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Directory where the file is to be saved
            $uploadFileDir = '../../../user images/';
            $newFileName = $user_id . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profilePIC = $newFileName;
            } else {
                echo '<script type="text/javascript">alert("Error uploading the file");</script>';
            }
        }
    }

    // Approve the profile update if the passwords match
    if ($conpassword == $password) {
        // Update user information in the table user_register
        $query = "UPDATE user_register SET username='$username', birthday='$birthday', email='$email', phone='$phone', profile_picture='$profilePIC'";
        
        // Check if password fields are not empty to update the password
        if (!empty($password)) {
            $query .= ", userpass='$password'";
        }

        $query .= " WHERE id = $user_id";

        if (mysqli_query($connect, $query)) {
            echo '<script type="text/javascript">
                alert("Your Profile Successfully Updated");
                window.location.href = "userprofile.php"; // Redirect to profile page after update
            </script>';
        } else {
            echo '<script type="text/javascript">alert("Error updating profile: ' . mysqli_error($connect) . '");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Your password does not match the confirm password");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        footer{
            display: flex;
            justify-content: space-around;
            background-color: #000000;
            bottom: 0;
            width: 100%;
            text-align: center;
            color: white;
            padding-top: 16px;
            padding-bottom: 16px;
            margin-bottom: 0%;
        }

        .profile{
            display: flex;
            justify-content: center;
            align-self: center ;
            background-color: #a9adb0;
            width: 70%;
            height: 2000px;
            max-height: 100%;
            transform: translateX(22%);
            border-radius: 10px;
            padding: 20px 0px;
            box-shadow: 0px 0px 15px black;
            
        }

        header li {
            display: inline;
            padding-left: 20px;
        }

        span{
            padding-left: 5px;
        }

    </style>
    <link rel="stylesheet" href="userprofile.css">
</head>
<body>
    <!-- Header -->
    <header>
        <img src="logo.png">
        <p>User Profile</p>
        <ul>
            <li><a href="../../Main Page/Main_Page/index.php">Back<span>&#x200B;</span>To<span>&#x200B;</span>Home</a></li>
            <li><a href="../../Landing_Page/Landing.php">Log<span>&#x200B;</span>Out</a></li>
        </ul>
    </header>

    <br><br><br><br><br><br>

    <!-- User Personal Info -->
    <section class="profile">
        <img src="<?php echo "../../../user images/" . $row['profile_picture']; ?>" alt="Profile Picture">
        <div class="info">
            <h2 class="information">Personal Information</h2>
            <div>
                <h2>Username: </h2>
                <p><?php echo $row['username']; ?></p>
                <h2>Birthday: </h2>
                <p><?php echo $row['birthday']; ?></p>
                <h2>Phone.no: </h2>
                <p><?php echo $row['phone']; ?></p>
                <h2>Email address: </h2>
                <p><?php echo $row['email']; ?></p>
            </div>
            <button class="edit">Edit User Info</button>
            <h2 class="information-1">Order Information</h2>
            <table class="order">
                <tr>
                    <th>Order ID</th>
                    <th>Book Name</th>
                    <th>Total (RM)</th>
                    <th>Order Date</th>
                </tr>
                <?php if (!empty($orders)): ?>
                    <?php 
                        $totalPrice = 0;
                        foreach ($orders as $order): 
                            $totalPrice += $order['Price'];
                    ?>
                        <tr>
                            <td><?php echo $order['order_id']; ?></td>
                            <td><?php echo $order['Book_Name']; ?></td>
                            <td><?php echo $order['Price']; ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2"><strong>Total Orders:</strong></td>
                        <td colspan="2"><?php echo count($orders); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Total Cost:</strong></td>
                        <td colspan="2">RM <?php echo number_format($totalPrice, 2); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Oops! You haven't ordered any books yet! It's time to SHOPPING!</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </section>

    <!-- Edit profile popup -->
    <div class="popup">
        <div class="close">&times;</div>
        <div class="form">
            <h3>Update Profile Info</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="editinfo">
                    <label for="profilepicture">Profile Picture</label>
                    <input type="file" id="profilepicture" name="profilepicture" placeholder="Insert Your Profile Picture Here">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter New Username" value="<?php echo $row['username']; ?>">
                    <br>
                    <label for="birthday">Birthday</label>
                    <br>
                    <input type="date" id="birthday" name="birthday" value="<?php echo $row['birthday']; ?>">
                    <br><br>
                    <label for="phone">Phone.no</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter New Phone Number" value="<?php echo $row['phone']; ?>">
                    <br><br>
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
            <h2>Facing problems? Contact us over here!</h2>
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
        document.querySelector(".popup .close").addEventListener("click", function(){document.querySelector(".popup").classList.remove("active");});
    </script>
</body>
</html>
<?php
} else {
    // Handle case where user ID does not exist
    echo "User not found.";
}
?>