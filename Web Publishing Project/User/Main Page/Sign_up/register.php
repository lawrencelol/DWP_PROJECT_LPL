<?php
// Include database connection
require_once 'connection.php'; // Update with your database connection file

// Define variables and initialize with empty values
$username = $password = $email = "";
$username_err = $password_err = $email_err = "";
$profile_picture = ""; // Initialize profile picture variable

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format.";
        }
    }

    // Check if file was uploaded without errors
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        // Validate uploaded file type
        $file_type = $_FILES['profile_picture']['type'];
        if ($file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/gif' || $file_type == 'image/jpg') {
            // Save uploaded file to directory
            $uploads_dir = '../../../user images/'; // Directory where images will be uploaded
            $tmp_name = $_FILES['profile_picture']['tmp_name'];
            $file_name = basename($_FILES['profile_picture']['name']);
            $profile_picture = $file_name;
            move_uploaded_file($tmp_name, $uploads_dir . $profile_picture);
        } else {
            $profile_picture = null; // Set to null if file type is not allowed
        }
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($email_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO user_register (username, userpass, email, profile_picture) VALUES (?, ?, ?, ?)";

        if ($stmt = $connect->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $username, $password, $email, $profile_picture);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: ../Login/Login.php");
                exit;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    unset($connect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        .right-side {
            position: relative;
            width: 250px;
            margin-right: 15%;
        }

        .dheader {
            position: relative;
            color: white;
            display: flex;
            width: 10px;
            transform: translateY(40px);
        }

        h3 {
            font-weight: bold;
            font-size: 15px;
        }

        hr {
            background-color: white;
            border: none;
            height: 5px;
            border-radius: 20px;
        }

        .description {
            font-weight: 800;
            font-size: 15px;
            color: white;
        }

        .description i {
            color: white;
            background-color: green;
            border-radius: 99px;
            margin-right: 10px
        }

        .show-bar {
            justify-content: space-between;
            margin-left: 15%;
            background-color: #00000060;
            display: flex;
            padding: 50px;
            width: 70%;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 10px rgba(0, 0, 0, 0.15);
        }

        .Signfrm {
            background: #A9ADB08b;
            border: 3px solid #A9ADB01b;
            padding: 20px;
            border-radius: 16px;
            backdrop-filter: blur(15px);
            text-align: center;
            color: white;
            width: 400px;
            box-shadow: 0px 0px 20px 10px rgba(0, 0, 0, 0.15);
            justify-self: center;
        }
    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Sign.css">
</head>
<body>
    <div class="show-bar">
        <div class="left-side">
            <div class="dheader">
                <img src="logo.png">
                <h3>Look Pick Learn</h3>
            </div>
            <hr>
            <div class="description">
                <h2 style="color: white; font-size: 25px; font-weight: 600;">Become one of the LPL bookworm! 🐛</h2>
                <p><br>Pick your book, easy to use</p>
                <p><br><i class='bx bx-check-circle'></i>Look for A Book</p>
                <p><i class='bx bx-check-circle'></i>Pick it up</p>
                <p><i class='bx bx-check-circle'></i>Learn it</p>
            </div>
        </div>

        <div class="right-side">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="Signfrm" method="post" enctype="multipart/form-data">
                <h2 style="color:white; font-size:25px; font-weight: 700px; text-align:center; margin-bottom:5px;">Sign Up</h2>
                <p style="color:white; font-size:15px; font-weight: 700px; text-align:center; margin-bottom:20px;">Please fill this form to create an account.</p>

                <div class="input-box">
                    <label>Username</label>
                    <i class='bx bx-user' style="font-size: 25px; bottom: 35px"></i>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    <?php echo (!empty($username_err)) ? '<div>' . $username_err . '</div>' : ''; ?>
                </div>

                <div class="input-box">
                    <label>Email</label>
                    <i class='bx bx-envelope' style="font-size: 25px; bottom: 35px"></i>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <?php echo (!empty($email_err)) ? '<div>' . $email_err . '</div>' : ''; ?>
                </div>

                <div class="input-box">
                    <label>Password</label>
                    <i class='bx bxs-lock-alt' style="font-size: 25px; bottom: 35px"></i>
                    <input type="password" name="password" required>
                    <?php echo (!empty($password_err)) ? '<div>' . $password_err . '</div>' : ''; ?>
                </div>

                <div class="input-box">
                    <label>Profile Picture</label>
                    <i class='bx bx-image' style="font-size: 25px; bottom: 35px"></i>
                    <input type="file" name="profile_picture" accept="image/*">
                </div>

                <div>
                    <input type="submit" class="Submit-btn" value="Submit">
                </div>
                <p>Already have an account? <a href="../Login/Login.php">Login here</a>.</p>
            </form>
        </div>
    </div>
</body>
</html>
