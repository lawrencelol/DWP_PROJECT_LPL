<?php include('../../../connection.php');

//remember me function
if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
}else{
    $username = $password = "";
}

if(isset($_REQUEST['remember'])){
    setcookie('username',$_REQUEST['username'],time()+20);
    setcookie('password',$_REQUEST['password'],time()+20); //20 seconds
}
?>

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

    <form action="Log-in.php" class="Login-form" method="POST">
    <img src="logo.png">
    <h1 class="login-title">LOGIN</h1>
    
    <div class="input-box">
        <i class="bx bxs-user"></i>
        <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
    </div>
    <div class="input-box">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>"> 
    </div>

    <div class="remember-box">
        <label fr="remember">
            <input type="checkbox" id="remember" name="remember">
            Remember me
        </label>
        <a herf="#">Forget Password?</a>
    </div>

        <button class="login-ptn" name="loginbtn">
        Login
        </button>
    
    <p class="register">
        Don't have any account?
        <a href="../Sign_up/Sign-Up.php">Register</a>
    </p>    

</form>
</body>
</html>