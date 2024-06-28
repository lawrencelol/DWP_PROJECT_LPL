<?php include('../../../connection.php');

if (isset($_POST['submitbtn'])) {
    $bN = $_POST['name'];
    $bT = $_POST['tel'];
    $bE = $_POST['email'];
    $bM = $_POST['message'];

    $insert_query = "INSERT INTO contact_record (Username, Contact_Number, UserEmail, Message) VALUES ('$bN', '$bT', '$bE', '$bM')";

    if (mysqli_query($connect, $insert_query))
    {
        echo "<script>alert('Submitted successfully!'); window.location.href='Contact_Us_Page.php';</script>";
        exit();
    }
    else
    {
        echo "<script>alert('Error inserting data: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*
{
    margin: 0;
    font-family: "Poppins";
}

header {
    z-index: 2;
    color: #cec1b2;
    background: fixed;
    background-color: #3b3e61;
    box-shadow: 0px 0px 12px 0px #000000;
    position: fixed;
    top: 0;
    left: 0;
    height: 100px;
    width: 100%;
}

header img {
    height: 100px;
    margin-left: 10px;
    margin-top: 5px;
}

header p {
    position: relative;
    color: #cec1b2;
    font-size: 40px;
    font-weight: 500;
    transform: translateY(-58px);
    text-align: center;
    top: -30px;
}

header ul {
    text-decoration: none;
    color: #cec1b2;
    font-weight: bold;
    position: absolute;
    top: 0;
    right: 0;
    line-height: 85px;
    transform: translateX(0);
    list-style-type: none;
    padding: 0;
    margin: 0;
    word-spacing: 5px;
    margin-right: 20px;
}

header a {
    color: #cec1b2;
    text-decoration: none;
}

header a:hover {
    text-decoration: none;
}

header li {
    display: inline;
    padding-left: 25px;
}

.selections {
    color: #cec1b2;
    background-color: #4c4f75;
    padding: 0px;
    text-decoration: none;
    display: block;
}

.selections:hover {
    background-color: #f9f9f9;
    color: #4c4f75;
    opacity: 0.6;
}

fieldset.userdata
{
    width: 400px;
    border: transparent;
    margin: 0 auto;
    margin-top: 20px;
}

form table th
{
    font-style: italic;
    font-size: 15px;
    font-weight: 600;
    padding: 30px;
    color: #3b3e61;
}

body
{
    background-image:linear-gradient(25deg, #f6e7ca, #f1daad, #e0a456);
}

form
{
    margin: 100px 0 80px;
    line-height: 30px;
}

tr img
{
    transform: translateX(-5px) translateY(5px);
}

tr.user
{
    display: flex;
    margin: 20px;
    padding: 10px;
}

td.name,.tel,.email_user,.message
{
    font-weight: 700;
    font-size: 18px;
    font-family: Arial, Helvetica, sans-serif;
    width: 200px;
}

input,textarea
{
    width: 500px;
    border:2px #4F493F solid;
    padding: 7px ;
    font-size: 14px;
}

button
{
    font-family: 'Poppins';
    width: 80px;
    font-weight: bold;
    border-radius: 5px;
    margin-left: 30px;
    padding: 8px;
    transform: translateX(600px);
}

td.button
{
    padding: 50px;
}

button[type="reset"]
{
    border: 2px rgb(220, 87, 87) solid;
}

button[type="reset"]:hover
{
    border: 1px red solid;
    background-color: red;
    color: white;
    font-weight: 600;
}

button[type="submit"]:hover
{
    border: 1px white solid;
    color: #4F493F;
    font-weight: bold;
}

.required
{
    color: red;
    margin: 0;
}

footer
{
    background-color: #A9ADB0;
    border: transparent;
}

fieldset.information
{
    width: 850px;
    margin: 0 auto;
    border: transparent;
    height: 200px;
}

table.information
{
    margin-top: 50px;
    line-height: 2;
}

.information th
{
    font-size: 15px;
    text-align: left;
    width: 500px;
    color: black;
}

.information td
{
    font-size: 14px;
    color: black; 
}

td.email
{
    font-style: italic;
    text-decoration: underline;
}

footer{
    padding-top: 0px;
    margin-top: 0px;
}

footer td{
    bottom: 0;
    font-size: 20px;
    font-weight: 500;

}
</style>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Contact Us Page</title>
        <link href="" rel="stylesheet">
    </head> 

    <body>

        <header>
            <img src="logo.png" >
            <p>Contact Us</p>
                <ul>
                    <li><a href="../../My Profile/About Us/About_Us_Page.php">< Back To About Us</a></li>
                    <li><a href="../../My Profile/User Profile/userprofile.php">< Back To My Profile</a></li>
                </ul>
        </header>

        <fieldset class="userdata">

            <form name="userdata" method="POST" action="">
                <table>
                    <th>Thank You for visiting our website. For any enquiries, please leave your message here.</th>
                    <tr class="user">
                        <td class="name"><img src="User.png">Name<span class="required"> *</span>: </td>
                        <td><input type="text" name="name" required></td>
                    </tr>
                    <tr class="user">
                        <td class="tel"><img src="Phone.png">Contact Number: </td>
                        <td><input type="tel" name="tel" maxlength="11" oninput="formatTel(this)"></td>
                    </tr>
                    <tr class="user">
                        <td class="email_user"><img src="Email.png">Email<span class="required"> *</span>: </td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr class="user">
                        <td class="message"><img src="Message.png">Message<span class="required"> *</span>: </td>
                        <td><textarea name="message" rows="5" required></textarea></td>
                    </tr>
                    <tr>
                        <td class="button" colspan="2">
                            <button type="submit" name="submitbtn"><b>SUBMIT</b></button>
                            <button type="reset"><b>RESET</b></button>
                        </td>
                    </tr>
                </table>
            <form>
        </fieldset>        

        <footer>
            <fieldset class="information">
                <div class="table">
                    <table class="information">
                        <thead>
                            <tr>
                                <th class="contact">Contact Number :</th>
                                <th class="email">Email Address :</th>
                                <th class="officeH">Office Hours :</th>                                
                            </tr>
                        </thead>
                            <footer>
                                <td>012-9375625</td>
                                <td class="email"><a href="lplbookstore@gmail.com">lplbookstore@gmail.com</a></td>
                                <td>Monday - Friday 9.00 am - 5.00 pm</td>
                            </footer>
                    </table>
                </div>
            </fieldset>
        </footer>


        <script>         
        function formatTel(input)
        {
            var tel = input.value.replace(/\D/g, ''); 
            input.value = tel;
        }
        </script>
    </body>
</html>