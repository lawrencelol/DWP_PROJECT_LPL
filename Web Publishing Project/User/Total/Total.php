<?php
include('../../connection.php');

session_start();

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$result = mysqli_query($connect, $query);

if (!$result)
{
    echo "Error fetching order details: " . mysqli_error($connect);
    exit();
}

$orders = [];
while ($row = mysqli_fetch_assoc($result))
{
    $orders[] = $row;
}

$total = 0;
foreach ($orders as $order)
{
    $total += $order['Price'];
}
$total = number_format($total, 2);

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="" rel="stylesheet">
    <link rel="stylesheet" href="Total.css">
</head>
<body>
    <div class="receipt">
        <button class="backtoHome"><a href="../Main Page/Main_Page/index.php">Back To Home</a></button>        
        <h1 class="header">Order History</h1>
        <hr>
        <div class="orderInfo">
            <p><b>&ensp;Date: &nbsp;</b><?php echo !empty($orders) ? $orders[0]['order_date'] : ''; ?></p>
            <p><b>&ensp;Username: &nbsp;</b><?php echo !empty($orders) ? $orders[0]['username'] : ''; ?></p>
        </div>
        <hr><br>
    
        <table>
            <thead>
                <tr>
                    <th class="id">Order ID</th>
                    <th class="bImg">Book Image</th>
                    <th class="bName">Book Name</th>
                    <th class="bType">Book Category</th>
                    <th class="recName">Receiver Name</th>
                    <th class="recEmail">Receiver Email</th>
                    <th class="date">Order Date</th>
                    <th class="price">Price (RM)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)) { ?>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td class="no"><?php echo $order['order_id']; ?></td>
                            <td class="bImg"><img src='../../images/<?php echo $order['Book_Name']; ?>.png' alt='book'></td>
                            <td class="bName"><?php echo $order['Book_Name']; ?></td>
                            <td class="bType"><?php echo $order['Category']; ?></td>
                            <td class="recName"><?php echo $order['receiver_name']; ?></td>
                            <td class="recEmail"><?php echo $order['receiver_email']; ?></td>
                            <td class="date"><?php echo $order['order_date']; ?></td>
                            <td class="price"><?php echo $order['Price']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="8">No orders found for user ID: <?php echo $user_id; ?></td>
                    </tr>
                <?php } ?>
                <tr class="subTotal">
                    <td colspan="7" class="total">TOTAL(RM):</td>
                    <td class="totalValue"><?php echo $total; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="print">
            <button class="print" onclick="printReceipt()"><img src="printer.png"></button>
        </div>
    </div>

    <footer>
        <p>Thank you for your purchase. For any inquiries, contact us at <a href="mailto:lplbookstore@gmail.com">lplbookstore@gmail.com</a>.</p>
    </footer>
    <script>
        function printReceipt() {
            window.print();
        }
    </script>
</body>
</html>
