<?php
include('../../connection.php');

//I use this array to save the total sales for each month
$monthlySales = array_fill(1, 12, 0);

//Calculate the total sales for each month in the current year
$currentYear = date('Y');
$queryMonthlySales = "
    SELECT MONTH(order_date) as month, SUM(Price) as totalSales 
    FROM orders
    WHERE YEAR(order_date) = '$currentYear'
    GROUP BY MONTH(order_date)";
$resultMonthlySales = mysqli_query($connect, $queryMonthlySales);

while ($row = mysqli_fetch_assoc($resultMonthlySales)) {
    $monthlySales[(int)$row['month']] = (float)$row['totalSales'];
}

//Prepare data for the bar chart  
$months = json_encode(array_keys($monthlySales));
$sales = json_encode(array_values($monthlySales));

//I use this array to save the total sales of each book category
$categorySales = [];

//Get total sales by book category
$queryCategorySales = "
    SELECT Category, SUM(Price) AS totalSales
    FROM orders
    GROUP BY Category";
$resultCategorySales = mysqli_query($connect, $queryCategorySales);

while ($row = mysqli_fetch_assoc($resultCategorySales)) {
    $categorySales[$row['Category']] = (float)$row['totalSales'];
}

//Prepare data for the pie chart
$categoryLabels = json_encode(array_keys($categorySales));
$categoryData = json_encode(array_values($categorySales));

//Variables 
$totalSales = 0;
$salesChange = 0;
$totalOrders = 0;
$ordersChange = 0;
$totalRates = 0;
$ratesChange = 0;
$totalComments = 0;
$commentsChange = 0;

//Get current month and year
$currentMonth = date('m');
$currentYear = date('Y');

//Get previous month and year
$prevMonth = date('m', strtotime('-1 month'));
$prevYear = date('Y', strtotime('-1 month'));

//Get total sales for current month
$queryTotalSales = "
    SELECT SUM(Price) as totalSales 
    FROM orders
    WHERE MONTH(order_date) = '$currentMonth' 
    AND YEAR(order_date) = '$currentYear'";
$resultTotalSales = mysqli_query($connect, $queryTotalSales);
$rowTotalSales = mysqli_fetch_assoc($resultTotalSales);
$totalSales = $rowTotalSales['totalSales'] ?? 0;

//Get total sales for previous month
$queryPrevTotalSales = "
    SELECT SUM(Price) as totalSales 
    FROM orders
    WHERE MONTH(order_date) = '$prevMonth' 
    AND YEAR(order_date) = '$prevYear'";
$resultPrevTotalSales = mysqli_query($connect, $queryPrevTotalSales);
$rowPrevTotalSales = mysqli_fetch_assoc($resultPrevTotalSales);
$prevTotalSales = $rowPrevTotalSales['totalSales'] ?? 0;

//Calculate sales change percentage
if ($prevTotalSales != 0) {
    $salesChange = (($totalSales - $prevTotalSales) / $prevTotalSales) * 100;
    $salesChange = number_format($salesChange, 2); 
    $salesChange = ($salesChange >= 0 ? '+' : '-') . abs($salesChange) . '%';
} else {
    $salesChange = 'There are no sales'; 
}

//Get total orders for current month
$queryTotalOrders = "
    SELECT COUNT(order_id) as totalOrders 
    FROM orders
    WHERE MONTH(order_date) = '$currentMonth' 
    AND YEAR(order_date) = '$currentYear'";
$resultTotalOrders = mysqli_query($connect, $queryTotalOrders);
$rowTotalOrders = mysqli_fetch_assoc($resultTotalOrders);
$totalOrders = $rowTotalOrders['totalOrders'] ?? 0;

//Get total orders for previous month
$queryPrevTotalOrders = "
    SELECT COUNT(order_id) as totalOrders 
    FROM orders
    WHERE MONTH(order_date) = '$prevMonth' 
    AND YEAR(order_date) = '$prevYear'";
$resultPrevTotalOrders = mysqli_query($connect, $queryPrevTotalOrders);
$rowPrevTotalOrders = mysqli_fetch_assoc($resultPrevTotalOrders);
$prevTotalOrders = $rowPrevTotalOrders['totalOrders'] ?? 0;

//Calculate orders change percentage
if ($prevTotalOrders != 0) {
    $ordersChange = (($totalOrders - $prevTotalOrders) / $prevTotalOrders) * 100;
    $ordersChange = number_format($ordersChange, 2); 
    $ordersChange = ($ordersChange >= 0 ? '+' : '-') . abs($ordersChange) . '%';
} else {
    $ordersChange = 'There are no orders'; 
}

//Get total rates for current month
$queryTotalRates = "
    SELECT COUNT(RateID) as totalRates 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$currentMonth' 
    AND YEAR(Rate_Date) = '$currentYear'";
$resultTotalRates = mysqli_query($connect, $queryTotalRates);
$rowTotalRates = mysqli_fetch_assoc($resultTotalRates);
$totalRates = $rowTotalRates['totalRates'] ?? 0;

//Get total rates for previous month
$queryPrevTotalRates = "
    SELECT COUNT(RateID) as totalRates 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$prevMonth' 
    AND YEAR(Rate_Date) = '$prevYear'";
$resultPrevTotalRates = mysqli_query($connect, $queryPrevTotalRates);
$rowPrevTotalRates = mysqli_fetch_assoc($resultPrevTotalRates);
$prevTotalRates = $rowPrevTotalRates['totalRates'] ?? 0;

//Calculate rates change percentage
if ($prevTotalRates != 0) {
    $ratesChange = (($totalRates - $prevTotalRates) / $prevTotalRates) * 100;
    $ratesChange = number_format($ratesChange, 2); 
    $ratesChange = ($ratesChange >= 0 ? '+' : '-') . abs($ratesChange) . '%';
} else {
    $ratesChange = 'No user rated'; 
}

//Get total comments for current month
$queryTotalComments = "
    SELECT COUNT(Comment) as totalComments 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$currentMonth' 
    AND YEAR(Rate_Date) = '$currentYear'";
$resultTotalComments = mysqli_query($connect, $queryTotalComments);
$rowTotalComments = mysqli_fetch_assoc($resultTotalComments);
$totalComments = $rowTotalComments['totalComments'] ?? 0;

//Get total comments for previous month
$queryPrevTotalComments = "
    SELECT COUNT(Comment) as totalComments 
    FROM ratingreview 
    WHERE MONTH(Rate_Date) = '$prevMonth' 
    AND YEAR(Rate_Date) = '$prevYear'";
$resultPrevTotalComments = mysqli_query($connect, $queryPrevTotalComments);
$rowPrevTotalComments = mysqli_fetch_assoc($resultPrevTotalComments);
$prevTotalComments = $rowPrevTotalComments['totalComments'] ?? 0;

//Calculate comments change percentage
if ($prevTotalComments != 0) {
    $commentsChange = (($totalComments - $prevTotalComments) / $prevTotalComments) * 100;
    $commentsChange = number_format($commentsChange, 2); 
    $commentsChange = ($commentsChange >= 0 ? '+' : '-') . abs($commentsChange) . '%';
} else {
    $commentsChange = 'No comment'; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <!-- This is the function to print the Dashboard -->
    <script>
        function printDash() {
            window.print();
        }
    </script>
    <link rel="stylesheet" href="Home_Page_EMP.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- The admin tab bar -->
    <div class="selection">
                <div class="Logo">
                    <img src="Logo.png" />
                </div>
                <div class="bar">
                    <ul>
                        <li class="active"><a href="../Employee_Home_Page/Home_Page_EMP.php">DASHBOARD</a></li>
                        <li><a href="../Manage_Staff/Manage_Staff.php">ADMIN</a></li>
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
    <!-- This is the Dashboard -->
    <div class="dashboard">
        <div class="header">
            <h1>Welcome to the Dashboard</h1>
        </div>
        <!-- This is where I show The Total Sales, Orders, Rates, and Comments every month -->
        <div class="box">
            <div>
                <h4>Total Sales</h4>
                <br>
                <p class="total-value">RM <?= number_format($totalSales, 2) ?></p>
                <br>
                <p class="change-value"><?= $salesChange ?> from previous month</p>
            </div>
            <div>
                <h4>Total Orders</h4>
                <br>
                <p class="total-value"><?= $totalOrders ?></p>
                <br>
                <p class="change-value"><?= $ordersChange ?> from previous month</p>
            </div>
            <div>
                <h4>Total Rates</h4>
                <br>
                <p class="total-value"><?= $totalRates ?></p>
                <br>
                <p class="change-value"><?= $ratesChange ?> from previous month</p>
            </div>
            <div>
                <h4>Total Comments</h4>
                <br>
                <p class="total-value"><?= $totalComments ?></p>
                <br>
                <p class="change-value"><?= $commentsChange ?> from previous month</p>
            </div>
        </div>

        <!-- This is the Bar Chart and Pie Chart -->
        <div class="chart-container">
            <div class="canvas-container">
                <h3>MONTHLY SALES</h3>
                <canvas id="monthlySalesChart"></canvas>
            </div>
            <div class="canvas-container">
                <h3>BOOK CATEGORY TOTAL SALES</h3>
                <canvas id="categorySalesChart"></canvas>
            </div>
        </div>
        <button class="print_btn" onclick="printDash()">Print Report</button>
    </div>

    <script>
    // Monthly Sales Bar Chart
    var ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');
    var monthlyChart = new Chart(ctxMonthly, {
        type: 'bar',
        data: {
            labels: <?= $months ?>,
            datasets: [{
                label: 'Sales (RM)',
                data: <?= $sales ?>,
                backgroundColor: '#F5C63C', 
                borderColor: '#ED9017',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Sales (RM)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                }
            }
        }
    });

    // Pie Chart for Category Sales
    var ctxCategory = document.getElementById('categorySalesChart').getContext('2d');
    var categoryChart = new Chart(ctxCategory, {
        type: 'pie',
        data: {
            labels: <?= $categoryLabels ?>,
            datasets: [{
                label: 'Sales (RM)',
                data: <?= $categoryData ?>,
                backgroundColor: ['#F5C63C', '#ED9017', '#3f290d', '#ffffff', '#cccccc'], // Change pie chart colors here
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': RM' + tooltipItem.raw.toFixed(2);
                        }
                    }
                }
            },
            elements: {
                arc: {
                    borderWidth: 0 
                }
            },
            layout: {
                padding: {
                    top: 20,
                    bottom: 20,
                    left: 20,
                    right: 20
                }
            },
            aspectRatio: 1.5, //the roundness of the pie
            radius: '80%', //the size of the pie chart
        }
    });
    </script>

</body>
</html>
