<?php include('../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Emp_Home</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Rate_Review.css"> 

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
                    <li class="active"><a href="../Manage_Order/Manage_Order.php">RATE REVIEW</a></li>
                    <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
                </ul>
            </div>
        </div>
    
        <fieldset>
            <div class="header">
                <h1>User Rate Review</h1>
            </div>
            <section class="table">
                <div class="content">
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>User Email</th>
                                <th>Rate Range</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mrs.Sherly</td>
                                <td>sherly99@gmail.com</td>
                                <td>3</td>
                                <td>Overall, it's fine for me. Can't believe I can still find Lethew Jean's recipe over here!</td>
                            </tr>
                            <tr>
                                <td>Mr.Peter</td>
                                <td>peter123@hotmail.com</td>
                                <td>4</td>
                                <td>The website is quite user-friendly for me. Thanks for the book anyway.</td>
                            </tr>
                            <tr>
                                <td>Mrs.Farah</td>
                                <td>farah66@gmail.com</td>
                                <td>5</td>
                                <td>I like the colour of the website. Maybe it's because of the book worm vibe it gives me (I don't know what I'm saying but yes)</td>
                            </tr>
                            <tr>
                                <td>Mrs.Evelyn</td>
                                <td>evelyn14@gmail.com</td>
                                <td>2</td>
                                <td>Everything is fine but I prefer a different colour of website (not offensive)</td>
                            </tr>
                            <tr>
                                <td>Mr.Johnathan</td>
                                <td>johnathan@hotmail.com</td>
                                <td>5</td>
                                <td>The website design is cute for me. The book displays like a deck of cards! Cool!</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <fieldset>

            <button class="print" onclick="printRate()">Print</button>
        
            </body>
        </html>