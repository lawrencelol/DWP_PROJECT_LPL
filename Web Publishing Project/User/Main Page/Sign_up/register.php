<?php 

include "../../../connection.php";

if(isset($_POST['submitbtn'])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $conpass = $_POST["conpass"];

        $checkEmail = "SELECT * From user_account where UserEmail='$email'";
        $result = $connect -> query($checkEmail);
        if($result->num_rows>0){
            echo "Email Address Already Exists !";
        }else{
            $insertQuery = "INSERT INTO user_account(Username, User_Password, UserEmail) VALUES ('$username','$pass','$email')";
            if($connect->query($insertQuery) == TRUE){
                header("location: ../Login/Login.php");
            }else{
                echo "Error: ". $connect->error;
            }
        }
}

?>