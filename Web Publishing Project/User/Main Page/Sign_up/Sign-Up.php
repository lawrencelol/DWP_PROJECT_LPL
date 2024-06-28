<?php include ('../../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>Sign Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='Sign.css'>
</head>

<body>
    <form action="register.php" class="Sign-form" method="POST">
    <img src="logo.png">
    <h1 class="sign-title">Sign Up</h1>
    
    <div class="input-box">
        <i class="bx bxs-user"></i>
        <input type="text" name="username" placeholder="Username">
    </div>
    <div class="input-box">
        <i class="bx bxs-user"></i>
        <input type="text" name="email" placeholder="Email">
    </div>
    <div class="input-box">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" name="pass" placeholder="Password"> 
    </div>
    <div class="input-box">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" name="conpass" placeholder="Confirm Password">
    </div>

    <p>&nbsp;</p>
    <button class="Submit-btn" name="submitbtn">Submit</button>
        <p>&nbsp;</p>

    <p class="Back-btn">
        <a href="../Login/Login.php">Back</a>
    </p>


</form>
</body>
</html>