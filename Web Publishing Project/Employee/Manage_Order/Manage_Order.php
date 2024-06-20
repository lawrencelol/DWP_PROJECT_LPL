<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Emp_Order</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Manage_Order.css"> 
    </head>

    <script>
        function printOrder()
        {
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
                    <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
                </ul>
            </div>
        </div>

        <fieldset>
            <div class="header">
                <h1>Order Review</h1>
            </div>
            <table>
                <thead>
                    <tr class="header">
                        <th class="orderId">Order Id</th>
                        <th class="bName">Book Name</th>
                        <th class="total">Total (RM)</th>
                        <th class="userName">Username</th>
                        <th class="userInfo">User Details</th>
                        <th class="oderDate">Order Date</th>
                        <th class="oderStatus">Order Status</th>
                        <!-- <th class="printDel"></th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd">
                        <td class="orderId">0111</td>
                        <td class="bName">100 Ways To Bake</td>
                        <td class="total">40.00</td>
                        <td class="userName">Mrs. Sherly</td>
                        <td class="userInfo">Email: sherly99@gmail.com</td>
                        <td class="orderDate">31 May 2024</td>
                        <td class="orderStatus"><label class="completed">Completed</label></td>
                    </tr>
                    <tr class="even">
                        <td class="orderId">0112</td>
                        <td class="bName">Me And My Pet Dinosaur<br>That Thing Under My Bed</td>
                        <td class="total">25.00</td>
                        <td class="userName">Mr. Peter</td>
                        <td class="userInfo">Email: peter123@hotmail.com</td>
                        <td class="orderDate">31 May 2024</td>
                        <td class="orderStatus"><label class="completed">Completed</label></td>
                       
                    </tr>
                    <tr class="odd">
                        <td class="orderId">0113</td>
                        <td class="bName">Twins</td>
                        <td class="total">22.00</td>
                        <td class="userName">Mrs. Farah</td>
                        <td class="userInfo">Email: farah66@gmail.com</td>
                        <td class="orderDate">31 May 2024</td>
                        <td class="orderStatus"><label class="completed">Completed</label></td>
                        
                    </tr>
                    <tr class="even">
                        <td class="orderId">0114</td>
                        <td class="bName">Knit It<br>Twins<br>That Thing Under My Bed</td>
                        <td class="total">85.00</td>
                        <td class="userName">Boothill</td>
                        <td class="userInfo">Email: boothill@gmail.com</td>
                        <td class="orderDate">31 May 2024</td>
                        <td class="orderStatus"><label class="completed">Completed</label></td>
                        
                    </tr>
                    <tr class="odd">
                        <td class="orderId">0115</td>
                        <td class="bName">Flippy The Silly Little Fish<br>Me and My Pet Dinosaur</td>
                        <td class="total">22.00</td>
                        <td class="userName">Mr. Johnathan</td>
                        <td class="userInfo">Email: johnathan@hotmail.com</td>
                        <td class="orderDate">31 May 2024</td>
                        <td class="orderStatus"><label class="processing">Processing</label></td>
                        
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </body>
</html>