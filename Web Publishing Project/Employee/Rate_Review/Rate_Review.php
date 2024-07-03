<?php include('../../connection.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emp_Home</title>
    <link href="" rel="stylesheet">
    <link rel="stylesheet" href="Rate_Review.css"> 

    <script>
        // Function to print the rate table
        function printRate() {
            window.print();
        }
    </script>
</head>

<body>
    <!-- This is the tab bar -->
    <div class="selection">
        <div class="Logo">
            <img src="Logo.png" />
        </div>
        <div class="bar">
            <ul>
                <li><a href="../Employee_Home_Page/Home_Page_EMP.php">DASHBOARD</a></li>
                <li><a href="../Manage_Staff/Manage_Staff.php">ADMIN</a></li>
                <li><a href="../Manage_USER/Manage_USER.php">USER</a></li>
                <li><a href="../Manage_Category/Category.php">CATEGORY</a></li>
                <li><a href="../Stock/stock.php">STOCK</a></li>
                <li><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                <li class="active"><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                <li><a href="../Contact_Record/Contact_Record.php">CONTACT</a></li>
                <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
            </ul>
        </div>
    </div>

    <!-- This is the rate record table -->
    <fieldset>
        <div class="header">
            <h1>User Rate Review</h1>
        </div>
        <section class="table">
            <div class="content">
                <table>
                    <thead>
                        <tr>
                            <th>User Email</th>
                            <th>Rating</th>
                            <th class="short-comment">Comment</th>
                            <th>Rate Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT UserEmail, Rating, Comment, Rate_Date FROM ratingreview";
                        $result = mysqli_query($connect, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['UserEmail'] . "</td>";
                                echo "<td>" . $row['Rating'] . "</td>";
                                echo "<td class='short-comment'>" . $row['Comment'] . "</td>";
                                echo "<td>" . $row['Rate_Date'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No reviews found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <button class="print" onclick="printRate()">Print</button>
    </fieldset>
</body>
</html>