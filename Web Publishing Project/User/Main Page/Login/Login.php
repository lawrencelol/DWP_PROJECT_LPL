<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='style.css'>
</head>

<body>

    <form action="#" class="Login-form">
    <img src="logo.png">
    <h1 class="login-title">LOGIN</h1>
    
    <div class="input-box">
        <i class="bx bxs-user"></i>
        <input type="text" placeholder="Username">
    </div>
    <div class="input-box">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" placeholder="Password"> 
    </div>

    <div class="remember-box">
        <label fr="remember">
            <input type="checkbox" id="rememeber">
            Remember me
        </label>
        <a herf="#">Forget Password?</a>
    </div>

        <a class="login-ptn" href="../Main_Page/index.php">
        Login
        </a>
    
    <p class="register">
        Don't have any account?
        <a href="../Sign_up/Sign-Up.php">Register</a>
    </p>    

</form>
</body>
</html>