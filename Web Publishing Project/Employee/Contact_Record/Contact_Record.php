<?php include('../../connection.php')?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    font-family: 'Poppins';
}

body{
    margin: 0;
    display: flex;
    background:linear-gradient(25deg, #f6e7ca, #e0a456,#ed9017);
}

.selection {
    width: 200px;
    background-color: #3f290d;
    color: white;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 0px;
    border-radius: 30px;
    margin: 20px;
    padding-right: 10px;
    padding-left: 10px;
}


.Logo p{
    display: flex;
    margin: 5px 10px 5px;
    font-weight: 500;
    font-size: 12.5px;
    margin-top: 25px;
    transform: translateX(6px);
}

.Logo img{
    padding: 10px 3px;
    float: left;
    display: flex;
    height: 60px;
}

.selection .bar img {
    width: 100px;
    margin-bottom: 20px;
}

.selection ul {
    list-style: none;
    padding: 0;
    width: 100%;
}

.selection ul li {
    width: 180px;
}

.selection ul li a {
    display: block;
    padding: 15px 20px;
    color: white;
    text-decoration: none;
    width: 100%;
    box-sizing: border-box;
}

.selection ul li.active a,
.selection ul li a:hover {
    background-color: #ed9017;
    color: white;
    border-radius: 10px;
}

.selection ul li.active a:hover{
    background-color: #ed9017;
    color: white;
    border-radius: 10px;
}
.selection ul li a:hover {
    background-color: rgb(136, 136, 136);
}

h1
{
    color: #3f290d;
    font-size: 40px;
}

fieldset
{
    border: transparent;
}

table
{
    background-color: white;
    border-radius: 5px;
}

th
{
    color: #3f290d;
    text-align: center;
    padding: 15px;
    background-color: #cec7c7;
    border-radius: 5px;
}

.name
{
    width: 150px;
}

.tel
{
    width: 130px;
}

.email
{
    width: 320px;
}

.message
{
    width: 800px;
}

td
{
    padding: 15px;
    font-size: 15px;
}

tbody tr
{
    border-radius: 5px;
    background-color: white;
}

tbody tr:nth-child(even)
{    
    background-color:#e9e3e3;
}

tbody tr:hover{
    background-color: #d0cbcb;
}

tbody tr:nth-child(even):hover{
    background-color: #d0cbcb;
}

div.print
{
    margin-top: 25px;
    padding: 20px;
    display: flex;
    justify-content: flex-end;
}

button
{
    width: 100px;
    font-size: 15px;
    border-radius: 3px;
    background-color: #cec7c7;
    border: 2px white solid;
    font-weight: 600;
    color: #3f290d;
}

button:hover
{
    font-weight: 700;
    color: black;
    border: 1px black solid;
    text-transform: uppercase;
}
</style>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Emp_Home</title>
        <link href="" rel="stylesheet">
        <script>
            function printRate() {
                window.print();
            }
        </script>
    </head>

    <body>
        <div class="selection">
            <div class="Logo">
                <img src="Logo.png" />
            </div>
            <div class="bar">
                <ul>
                    <li><a href="../Employee_Home_Page/Home_Page_EMP.php">DASHBOARD</a></li>
                    <li><a href="../Manage_Staff/Manage_Staff.php">STAFF</a></li>
                    <li><a href="../Manage_USER/Manage_USER.php">USER</a></li>
                    <li><a href="../Manage_Category/Category.php">CATEGORY</a></li>
                    <li><a href="../Stock/stock.php">STOCK</a></li>
                    <li><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                    <li><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                    <li class="active"><a href="../Contact_Record/Contact_Record.php">CONTACT</a></li>
                    <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
                </ul>
            </div>
        </div>
    
        <fieldset>
            <h1>Contact Record</h1>
                <table>
                    <thead>
                        <tr>
                            <th class="name">Name</th>
                            <th class="tel">Tel.</th>
                            <th class="email">Email</th>
                            <th class="message">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT Username, Contact_Number, UserEmail, Message FROM contact_record ";
                            $result = mysqli_query($connect, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td class="name">' . $row['Username'] . '</td>';
                                echo '<td class="tel">' . $row['Contact_Number'] . '</td>';
                                echo '<td class="email">' . $row['UserEmail'] . '</td>';
                                echo '<td class="message">' . $row['Message'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </section>
            <fieldset>

            <div class="print">
                <button onclick="printRate()">Print</button>
            </div>
        
            </body>
        </html>