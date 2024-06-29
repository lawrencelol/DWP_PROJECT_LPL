<?php include('../../connection.php')?>

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

            <label class="print">
                <button onclick="printRate()">Print</button>
            </label>
        
            </body>
        </html>