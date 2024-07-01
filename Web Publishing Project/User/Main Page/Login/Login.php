<?php
session_start(); // Start the session at the beginning of the file

include ('../../../connection.php');

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $userpass = $_POST["userpass"];

    $stmt = $connect->prepare("SELECT id FROM user_register WHERE email = ? AND userpass = ?");
    $stmt->bind_param("ss", $email, $userpass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; // Store the user ID in the session
        header("Location: ../Main_Page/index.php"); // Redirect to user profile page
        exit(); // Ensure no further code is executed after redirection
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
    .right-side{
    position: relative;
    width:250px;
    margin-right: 15%;

    }

    .dheader{
    position:relative;
    color: white; 
    display: flex;
    width: 10px;
    transform: translateY(40px);
    }

    h3{
        font-weight: bold;
        font-size: 15px;
    }

    hr{
        background-color: white;
        border: none;
        height: 5px;
        border-radius: 20px;
    }

    .description{
        font-weight: 800;
        font-size: 15px;
        color: white;
    }

    .description i{
        color: white;
        background-color: green;
        border-radius: 99px;
        margin-right: 10px
    }

    .show-bar{
        justify-content: space-between;
        background-color: #00000060;
        display: flex;
        padding: 50px;
        width: 70%;
        border-radius: 10px;
        box-shadow: 0px 0px 20px 10px rgba(0, 0, 0, 0.15);
    }

    .Loginfrm{
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

    .Submit-btn {
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

    .Submit-btn:hover {
        background: #232541;
    }

    .bottom-selection{
        display: flex;
        justify-content: space-between;
        margin: 10px
    }

    .bottom-selection a, .bottom-selection p{
        text-decoration: none;
        color: white;
        font-size: 13px;
    }

    .bottom-selection a:hover{
        text-decoration: underline;
    }

    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
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
                    <img src>
                </div>
            </div>
                
                <div class="right-side">
                    <div id="login-title">
                        <div id="login-form">
                            <?php
                            if (isset($error_message)) {
                                echo "<p style='color: red; text-align: center;'>$error_message</p>";
                            }
                            ?>
                            <form name="loginfrm" method="post" class="Loginfrm" action="">
                                <h3 style="color:white; font-size:25px; font-weight: 700px; text-align:center; margin-bottom:5px;">Login</h3>
                                <div class="input-box">
                                    <label>Username</label>
                                    <i class='bx bx-user' style="font-size: 25px; bottom: 35px"></i>
                                    <input type="username" name="username" placeholder="Enter your username" required>
                                </div>

                                <div class="input-box">
                                    <label>Password</label>
                                    <i class='bx bxs-lock-alt' style="font-size: 25px; bottom: 35px"></i>
                                    <input type="password" name="userpass" placeholder="Enter your password" required>
                                </div>

                                <input type="submit" name="loginbtn" class="Submit-btn" value="LOGIN" />
                            <div class="bottom-selection">
                                <p>No Account?<a href="../Sign_up/register.php"> Register Now!</a></p>
                                <p><a href="forget_password.php">Forgot your password?</a></p>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>