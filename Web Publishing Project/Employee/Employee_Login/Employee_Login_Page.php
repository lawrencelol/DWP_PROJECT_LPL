<?php include('../../connection.php');

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $admin_pass = $_POST["admin_pass"];

    $stmt = $connect->prepare("SELECT admin_id FROM admin_register WHERE admin_id = ? AND admin_password = ?");
    $stmt->bind_param("ss", $id, $admin_pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['id']; // Store the user ID in the session
        header("Location: ../Employee_Home_Page/Home_Page_EMP.php"); // Redirect to user profile page
        exit(); // Ensure no further code is executed after redirection
    } else {
        $error_message = "Invalid id or password.";
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

        img{
            height: 80px;
            z-index: 1;
            margin-bottom: 60px;
            transform: translateX(-3px);
        }
    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='Employee_Login.css'>
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
                        <h3 style="color:white; font-size:25px; font-weight: 700px; text-align:center; margin-bottom:5px;">Admin Login</h3>
                        
                        <div class="input-box">
                            <label>Admin ID</label>
                            <i class='bx bx-user' style="font-size: 25px; bottom: 35px"></i>
                            <input type="id" name="id" placeholder="Enter your ID" required>
                        </div>

                        <div class="input-box">
                            <label>Password</label>
                            <i class='bx bxs-lock-alt' style="font-size: 25px; bottom: 35px"></i>
                            <input type="password" name="admin_pass" placeholder="Enter your password" required>
                        </div>

                        <input type="submit" name="loginbtn" class="Submit-btn" value="LOGIN" />
                        
                        <div class="bottom-selection">
                            <p><a href="forget_password.php">Forgot your password?</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>