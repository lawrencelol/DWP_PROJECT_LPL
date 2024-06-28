<?php 

include "../../../connection.php";

if(isset($_POST['loginbtn'])){
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $sql="SELECT * FROM user_account where Username='$username' and User_Password='$pass'";
    $result =  $connect->query($sql);
    if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['User_Password']=$row['pass'];
        header("Location: ../Main_Page/index.php");
        exit();
    }else{
        echo "Not found, Incorrect Password";
    }
}
?>