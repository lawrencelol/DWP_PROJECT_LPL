<?php 

include "../../connection.php";

if(isset($_POST['loginbtn'])){
    $ID = $_POST['ID'];
    $pass = $_POST['password'];

    $sql="SELECT * FROM employee_account where EmpID='$ID' and Emp_password='$pass'";
    $result =  $connect->query($sql);
    if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['User_Password']=$row['password'];
        header("Location: ../Employee_Home_Page/Home_Page_EMP.php");
        exit();
    }else{
        echo "Not found, Incorrect Password";
    }
}
?>