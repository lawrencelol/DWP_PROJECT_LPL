<?php 
include('../../connection.php');

// Fetch order data from the database
$query = "SELECT order_id, Book_Name, Price, username, receiver_name, receiver_email, order_date FROM orders";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emp_Order</title>
    <link href="" rel="stylesheet">
    <link rel="stylesheet" href="Manage_Order.css"> 

</head>

<script>
    function printOrder() {
        window.print();
    }
</script>

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
                <li class="active"><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                <li><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                <li><a href="../Contact_Record/Contact_Record.php">CONTACT</a></li>
                <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
            </ul>
        </div>
    </div>

    <fieldset>
        <div class="header">
            <h1>Order Review</h1>
        </div>
        <section class="table">
        <table>
            <thead>
                <tr class="header">
                    <th class="orderId">Order Id</th>
                    <th class="bName">Book Name</th>
                    <th class="total">Price (RM)</th>
                    <th class="userName">Username</th>
                    <th class="userInfo">Receiver Name</th>
                    <th class="userInfo">Receiver Email</th>
                    <th class="orderDate">Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    $row_class = 'odd';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='{$row_class}'>";
                        echo "<td class='orderId'>{$row['order_id']}</td>";
                        echo "<td class='bName'>{$row['Book_Name']}</td>";
                        echo "<td class='total'>{$row['Price']}</td>";
                        echo "<td class='userName'>{$row['username']}</td>";
                        echo "<td class='userInfo'>{$row['receiver_name']}</td>";
                        echo "<td class='userInfo'>{$row['receiver_email']}</td>";
                        echo "<td class='orderDate'>{$row['order_date']}</td>";
                        echo "</tr>";

                        // Alternate row class
                        $row_class = ($row_class == 'odd') ? 'even' : 'odd';
                    }
                } else {
                    echo "<tr><td colspan='7'>No orders found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </section>
        <button class="print" onclick="printOrder()">Print</button>
    </fieldset>
</body>
</html>
