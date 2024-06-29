<?php
include('../../connection.php');

// Get current month
$currentMonth = date('m');
$currentYear = date('Y');

// Fetch total sales
$queryTotalSales = "
    SELECT SUM(Total) as totalSales 
    FROM purchase_history 
    WHERE Order_Status = 'Complete' 
    AND MONTH(Purchase_Date) = '$currentMonth' 
    AND YEAR(Purchase_Date) = '$currentYear'";
$resultTotalSales = mysqli_query($connect, $queryTotalSales);
$rowTotalSales = mysqli_fetch_assoc($resultTotalSales);
$totalSales = $rowTotalSales['totalSales'] ?? 0;

// Fetch total orders
$queryTotalOrders = "
    SELECT COUNT(OrderID) as totalOrders 
    FROM purchase_history 
    WHERE MONTH(Purchase_Date) = '$currentMonth' 
    AND YEAR(Purchase_Date) = '$currentYear'";
$resultTotalOrders = mysqli_query($connect, $queryTotalOrders);
$rowTotalOrders = mysqli_fetch_assoc($resultTotalOrders);
$totalOrders = $rowTotalOrders['totalOrders'] ?? 0;

// Fetch total rates
$queryTotalRates = "
    SELECT COUNT(RateID) as totalRates 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$currentMonth' 
    AND YEAR(Rate_Date) = '$currentYear'";
$resultTotalRates = mysqli_query($connect, $queryTotalRates);
$rowTotalRates = mysqli_fetch_assoc($resultTotalRates);
$totalRates = $rowTotalRates['totalRates'] ?? 0;

// Fetch total comments
$queryTotalComments = "
    SELECT COUNT(Comment) as totalComments 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$currentMonth' 
    AND YEAR(Rate_Date) = '$currentYear'";
$resultTotalComments = mysqli_query($connect, $queryTotalComments);
$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
$totalComments = $rowTotalComments['totalComments'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emp_Home</title>
        <link rel="stylesheet" href="Home_Page_EMP.css"> 
        <script>
            function printDashboard() {
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
                    <li class="active"><a href="../Employee_Home_Page/Home_Page_EMP.php">DASHBOARD</a></li>
                    <li><a href="../Manage_Staff/Manage_Staff.php">STAFF</a></li>
                    <li><a href="../Manage_USER/Manage_USER.php">USER</a></li>
                    <li><a href="../Manage_Category/Category.php">CATEGORY</a></li>
                    <li><a href="../Stock/stock.php">STOCK</a></li>
                    <li><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                    <li><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                    <li><a href="../Contact_Record/Contact_Record.php">CONTACT</a></li>
                    <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
                </ul>
            </div>
        </div>

        <div class="dashboard">
            <div class="header">
                <h1>Dashboard</h1>
            </div>
            <div class="box">
                <div>
                    <h3>Total Sales</h3>
                    <h4>RM <?= number_format($totalSales, 2) ?></h4>
                    <p><strong>+6%</strong> This month</p>
                </div>
                <div>
                    <h3>Total Orders</h3>
                    <h4><?= $totalOrders ?></h4>
                    <p><strong>+6%</strong> This month</p>
                </div>
                <div>
                    <h3>Total Rates</h3>
                    <h4><?= $totalRates ?></h4>
                    <p><strong>+4%</strong> This month</p>
                </div>
                <div>
                    <h3>Total Comments</h3>
                    <h4><?= $totalComments ?></h4>
                    <p><strong>+2%</strong> This month</p>
                </div>
            </div>
            <div class="chart">
                <div id="bar">
                    <img src="bar.png">
                </div>
                <div id="donut">
                    <img src="donut.png">
                </div>
            </div>
        </div>
        <button class="print" onclick="printDashboard()">Print</button>
    </body>
</html>
