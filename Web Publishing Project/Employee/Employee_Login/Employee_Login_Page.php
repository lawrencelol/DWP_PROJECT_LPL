<?php include('../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='Employee_Login.css'>
</head>

<body>
    <form action="#" class="Login-form">
    <h1 class="login-title">ADMIN</h1>
    
    <div class="input-box">
        <i class="bx bxs-user"></i>
        <input type="text" placeholder="User ID">
    </div>
    <div class="input-box">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" placeholder="Password"> 
    </div>

    <div class="Forget_Pass">
        <a herf="#">Forget Password?</a>
    </div>

    <a href="../Employee_Home_Page/Home_Page_EMP.php"><div class="login-ptn">Login</div></a>

</form>
</body>
</html>