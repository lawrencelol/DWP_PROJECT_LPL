<?php
session_start();

include('../../connection.php');

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["reset_submit"])) {
        // Password reset submission
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        // Validate and process password reset
        if ($new_password === $confirm_password) {
            // Directly update the password without hashing (this is not recommended in production)
            $hashed_password = $new_password; // Do not hash, store as plain text (not recommended)

            // Retrieve the admin_id from session
            if (isset($_SESSION['reset_admin_id'])) {
                $admin_id = $_SESSION['reset_admin_id'];

                // Update password in the database
                $stmt = $connect->prepare("UPDATE admin_register SET admin_password = ? WHERE admin_id = ?");
                $stmt->bind_param("ss", $hashed_password, $admin_id);
                $stmt->execute();
                
                // Set success message
                $_SESSION['password_reset_success'] = true;

                // Redirect to login page after successful reset
                header("Location: Employee_Login_Page.php"); 
                exit();
            } else {
                $error_message = "Session expired. Please try again.";
            }
        } else {
            $error_message = "Passwords do not match. Please try again.";
        }
    } elseif (isset($_POST["forgot_submit"])) {
        // Forgot password submission
        $admin_id = $_POST["admin_id"];

        // Check if admin_id exists
        $stmt = $connect->prepare("SELECT admin_id FROM admin_register WHERE admin_id = ?");
        $stmt->bind_param("s", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // admin_id exists, proceed to reset password
            $_SESSION['reset_admin_id'] = $admin_id; // Store admin_id in session for password reset process
            header("Location: forget_password.php?action=reset"); // Redirect to password reset form
            exit();
        } else {
            $error_message = "Admin ID not found. Please enter a valid Admin ID.";
        }

        $stmt->close();
    }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        /* Paste your styles from your provided CSS here */
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
            margin-right: 10px;
        }
        .show-bar {
            justify-content: space-between;
            background-color: #00000060;
            display: flex;
            padding: 50px;
            width: 70%;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 10px rgba(0, 0, 0, 0.15);
        }
        .Loginfrm {
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
        .reset-btn {
            width: 100%;
            padding: 10px 0;
            background: #4c4f75;
            border: none;
            border-radius: 99px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        .reset-btn:hover {
            background: #232541;
        }
        .bottom-selection {
            display: flex;
            justify-content: space-between;
            margin: 10px;
        }
        .bottom-selection a, .bottom-selection p {
            text-decoration: none;
            color: white;
            font-size: 13px;
        }
        .bottom-selection a:hover {
            text-decoration: underline;
        }

        .input-box{
            margin: 20px 0;
            position: relative;
        }

        .input-box input {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            padding: 12px 12px 12px 45px;
            border-radius: 99px;
            outline: 3px solid transparent;
            transition: 0.3s;
            font-size: 17px;
            color: white;
            font-weight: 600;
        }

        .input-box input::placeholder {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            font-weight: 500;
        }

        .input-box input:focus{
            outline: 3px solid rgba(255, 255, 255, 0.3);
        }
        .input-box input::-ms-reveal {
            filter: invert(100%); 
        }

        .input-box i {
            border: none;
            position: absolute;
            left: 15px;
            top: 50%;
            font-size: 30px;
            color: rgba(255, 255, 255, 0.8);
        }

        body {
            background-image: url(Admin-bg.jpg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            background-size: cover;
            background-position: center;
        }
    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Employee_Login.css"> <!-- Ensure your additional styles are also linked here -->
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
            <h2 style="color: white; font-size: 25px; font-weight: 600;">Features in Admin Module</h2>
                <p><br><i class='bx bx-check-circle'></i>Edit account</p>
                <p><i class='bx bx-check-circle'></i>Manage Books</p>
                <p><i class='bx bx-check-circle'></i>Check Sales Report</p>
            </div>
        </div>
        <div class="right-side">
            <h2 style="color:white; font-size:25px; font-weight: 700px; text-align:center; margin-bottom:5px;">Password Reset</h2>
            <?php
            if (isset($_GET["action"]) && $_GET["action"] === "reset") {
                // Display password reset form
                ?>
                <form method="post" action="" class="Loginfrm">
                    <div class="input-box">
                        <label>New Password:</label>
                        <input type="password" name="new_password" placeholder="Type here" required><br>
                    </div>

                    <div class="input-box">
                        <label>Confirm Password:</label>
                        <input type="password" name="confirm_password" placeholder="Type here" required><br>
                    </div>

                    <input type="submit" name="reset_submit" class="reset-btn" value="Reset Password">
                </form>
                <?php
            } else {
                // Display forgot password form
                ?>
                <form method="post" action="" class="Loginfrm">
                    <div class="input-box">
                        <label>Enter your Admin ID:</label>
                        <input type="text" name="admin_id" placeholder="Type here" required><br>
                    </div>
                        <input type="submit" name="forgot_submit" class="reset-btn" value="Submit">
                    
                </form>
                <?php
            }

            if (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>
        </div>
    </div>

    <script>
        // JavaScript for displaying success message if redirected with success indicator
        <?php
        if (isset($_SESSION['password_reset_success']) && $_SESSION['password_reset_success']) {
            echo "alert('New password saved');";
            unset($_SESSION['password_reset_success']); // Clear the success indicator
        }
        ?>
    </script>
</body>
</html>
