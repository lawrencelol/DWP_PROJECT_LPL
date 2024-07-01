<?php
include('../../connection.php');

// Initialize an array to hold sales data for each month
$monthlySales = array_fill(1, 12, 0);

// Get total sales for each month in the current year
$currentYear = date('Y');
$queryMonthlySales = "
    SELECT MONTH(order_date) as month, SUM(o.Price) as totalSales 
    FROM orders o
    JOIN booklist b ON o.Book_Name = b.Book_Name
    WHERE YEAR(order_date) = '$currentYear'
    GROUP BY MONTH(order_date)";
$resultMonthlySales = mysqli_query($connect, $queryMonthlySales);

while ($row = mysqli_fetch_assoc($resultMonthlySales)) {
    $monthlySales[(int)$row['month']] = (float)$row['totalSales'];
}

// Prepare data for JavaScript
$months = json_encode(array_keys($monthlySales));
$sales = json_encode(array_values($monthlySales));

// Initialize variables to avoid undefined variable warnings
$totalSales = 0;
$salesChange = 0;
$totalOrders = 0;
$ordersChange = 0;
$totalRates = 0;
$ratesChange = 0;
$totalComments = 0;
$commentsChange = 0;

// Get current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Get previous month and year
$prevMonth = date('m', strtotime('-1 month'));
$prevYear = date('Y', strtotime('-1 month'));

// Fetch total sales for current month
$queryTotalSales = "
    SELECT SUM(o.Price) as totalSales 
    FROM orders o
    JOIN booklist b ON o.Book_Name = b.Book_Name
    WHERE MONTH(order_date) = '$currentMonth' 
    AND YEAR(order_date) = '$currentYear'";
$resultTotalSales = mysqli_query($connect, $queryTotalSales);
$rowTotalSales = mysqli_fetch_assoc($resultTotalSales);
$totalSales = $rowTotalSales['totalSales'] ?? 0;

// Fetch total sales for previous month
$queryPrevTotalSales = "
    SELECT SUM(o.Price) as totalSales 
    FROM orders o
    JOIN booklist b ON o.Book_Name = b.Book_Name
    WHERE MONTH(order_date) = '$prevMonth' 
    AND YEAR(order_date) = '$prevYear'";
$resultPrevTotalSales = mysqli_query($connect, $queryPrevTotalSales);
$rowPrevTotalSales = mysqli_fetch_assoc($resultPrevTotalSales);
$prevTotalSales = $rowPrevTotalSales['totalSales'] ?? 0;

// Calculate sales change percentage
if ($prevTotalSales != 0) {
    $salesChange = (($totalSales - $prevTotalSales) / $prevTotalSales) * 100;
}

// Fetch total orders for current month
$queryTotalOrders = "
    SELECT COUNT(o.order_id) as totalOrders 
    FROM orders o
    JOIN booklist b ON o.Book_Name = b.Book_Name
    WHERE MONTH(order_date) = '$currentMonth' 
    AND YEAR(order_date) = '$currentYear'";
$resultTotalOrders = mysqli_query($connect, $queryTotalOrders);
$rowTotalOrders = mysqli_fetch_assoc($resultTotalOrders);
$totalOrders = $rowTotalOrders['totalOrders'] ?? 0;

// Fetch total orders for previous month
$queryPrevTotalOrders = "
    SELECT COUNT(o.order_id) as totalOrders 
    FROM orders o
    JOIN booklist b ON o.Book_Name = b.Book_Name
    WHERE MONTH(order_date) = '$prevMonth' 
    AND YEAR(order_date) = '$prevYear'";
$resultPrevTotalOrders = mysqli_query($connect, $queryPrevTotalOrders);
$rowPrevTotalOrders = mysqli_fetch_assoc($resultPrevTotalOrders);
$prevTotalOrders = $rowPrevTotalOrders['totalOrders'] ?? 0;

// Calculate orders change percentage
if ($prevTotalOrders != 0) {
    $ordersChange = (($totalOrders - $prevTotalOrders) / $prevTotalOrders) * 100;
}

// Fetch total rates for current month
$queryTotalRates = "
    SELECT COUNT(RateID) as totalRates 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$currentMonth' 
    AND YEAR(Rate_Date) = '$currentYear'";
$resultTotalRates = mysqli_query($connect, $queryTotalRates);
$rowTotalRates = mysqli_fetch_assoc($resultTotalRates);
$totalRates = $rowTotalRates['totalRates'] ?? 0;

// Fetch total rates for previous month
$queryPrevTotalRates = "
    SELECT COUNT(RateID) as totalRates 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$prevMonth' 
    AND YEAR(Rate_Date) = '$prevYear'";
$resultPrevTotalRates = mysqli_query($connect, $queryPrevTotalRates);
$rowPrevTotalRates = mysqli_fetch_assoc($resultPrevTotalRates);
$prevTotalRates = $rowPrevTotalRates['totalRates'] ?? 0;

// Calculate rates change percentage
if ($prevTotalRates != 0) {
    $ratesChange = (($totalRates - $prevTotalRates) / $prevTotalRates) * 100;
}

// Fetch total comments for current month
$queryTotalComments = "
    SELECT COUNT(Comment) as totalComments 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$currentMonth' 
    AND YEAR(Rate_Date) = '$currentYear'";
$resultTotalComments = mysqli_query($connect, $queryTotalComments);
$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
$totalComments = $rowTotalComments['totalComments'] ?? 0;

// Fetch total comments for previous month
$queryPrevTotalComments = "
    SELECT COUNT(Comment) as totalComments 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$prevMonth' 
    AND YEAR(Rate_Date) = '$prevYear'";
$resultPrevTotalComments = mysqli_query($connect, $queryPrevTotalComments);
$rowPrevTotalComments = mysqli_fetch_assoc($resultPrevTotalComments);
$prevTotalComments = $rowPrevTotalComments['totalComments'] ?? 0;

// Calculate comments change percentage
if ($prevTotalComments != 0) {
    $commentsChange = (($totalComments - $prevTotalComments) / $prevTotalComments) * 100;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emp_Home</title>
    <link rel="stylesheet" href="Home_Page_EMP.css">
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <p><?= ($salesChange >= 0 ? '+' : '') . number_format($salesChange, 2) ?>% This month</p>
            </div>
            <div>
                <h3>Total Orders</h3>
                <h4><?= $totalOrders ?></h4>
                <p><?= ($ordersChange >= 0 ? '+' : '') . number_format($ordersChange, 2) ?>% This month</p>
            </div>
            <div>
                <h3>Total Rates</h3>
                <h4><?= $totalRates ?></h4>
                <p><?= ($ratesChange >= 0 ? '+' : '') . number_format($ratesChange, 2) ?>% This month</p>
            </div>
            <div>
                <h3>Total Comments</h3>
                <h4><?= $totalComments ?></h4>
                <p><?= ($commentsChange >= 0 ? '+' : '') . number_format($commentsChange, 2) ?>% This month</p>
            </div>
            <button class="print_btn" onclick="printDashboard()">Print</button>
        </div>
        <div class="container">
            <h2>Monthly Sales</h2>
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Chart.js script to render the sales chart -->
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= $months ?>,
                datasets: [{
                    label: 'Monthly Sales',
                    data: <?= $sales ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
