<?php include('../../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Receipt</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Total.css">
    </head> 

    <script>
        function printDashboard()
        {
            window.print();
        }
    </script>
    
    <body>
        <div class="receipt">
            <button class="backtoHome"><a href="../Main Page/Main_Page/index.php">Back To Home</a></button>
            <h1 class="header">RECEIPT</h1>
            <div class="orderInfo">
                <p>Order Id: 0115</p>
                <p>Date: May 31, 2024</p>
            </div>
            <div class="userInfo">
                <p class="name">Mr. Johnathan</p>
                <p>johnathan@hotmail.com</p>
            </div>
            <hr>
            <h1 class="orderSummary">Order Summary</h1>
            <hr>
            <table class="orderSummary">
                <thead>
                    <tr class="header">
                        <th class="no">No.</th>
                        <th class="bImg">Book Image</th>
                        <th class="bName">Book Name</th>
                        <th class="price">Price (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="book">
                        <td class="no">01.</td>
                        <td class="bImg"><img src="Flippy.png" alt="book"></td>
                        <td class="bName">Flippy The Shilly Little Fish</td>
                        <td class="price">15.00</td>
                    </tr>
                    <tr class="book">
                        <td class="no">02.</td>
                        <td class="bImg"><img src="Me and My Pet Dinosaur.png" alt="book"></td>
                        <td class="bName">Me and My Pet Dinosaur</td>
                        <td class="price">10.00</td>
                    </tr>
                    <tr class="subTotal">
                        <td colspan="3"class="subTotal">Sub Total:</td>
                        <td class="valueSub">25.00</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <button class="print" onclick="printDashboard()"><img src="printer.png"></button>
            </div>
        </div>

    
        <footer>
            <p>Thank you for your purchase. For any inquiries, contact us at <a href="mailto:lplbookstore@gmail.com">lplbookstore@gmail.com</a>.</p>
        </footer>
    </body>
</html>

