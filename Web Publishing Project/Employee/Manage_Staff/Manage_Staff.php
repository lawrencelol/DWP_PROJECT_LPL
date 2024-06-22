<?php include('../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Emp_Staff</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Manage_Staff.css"> 
    </head>

    <body>
        <div class="selection">
            <div class="Logo">
                <img src="Logo.png" />
            </div>
            <div class="bar">
                <ul>
                    <li><a href="../Employee_Home_Page/Home_Page_EMP.php">DASHBOARD</a></li>
                    <li class="active"><a href="../Manage_Staff/Manage_Staff.php">STAFF</a></li>
                    <li><a href="../Manage_USER/Manage_USER.php">USER</a></li>
                    <li><a href="../Manage_Category/Category.php">CATEGORY</a></li>
                    <li><a href="../Stock/stock.php">STOCK</a></li>
                    <li><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                    <li><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                    <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
                </ul>
            </div>
        </div>

        <div class="container">
            <h1>Staff Management</h1>
            <form class="form" id="addStaffForm">
                <h2>Add New Staff</h2>
                <label for="staffName">Name:</label>
                <input type="text" id="staffName" name="staffName" required>
                <label for="staffEmail">Email:</label>
                <input type="email" id="staffEmail" name="staffEmail" required>
                <label for="Emp_password">Password</label>
                <input type="text" id="staffpass" name="staffpass" required>
                <button type="submit">Add Staff</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>DELETE</th>
                        <th>UPDATE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dot Jason</td>
                        <td>Iwillmakeyoutribble@hahaha.com</td>
                        <td>Dot1234</td>
                        <td id="remove"><button>❌</button></td>
                        <td id="Update"><button>⚙️</button></td>
                    </tr>

                    <tr>
                        <td>Johnson no son</td>
                        <td>Johnonnoson@hahaha.com</td>
                        <td>Johnson5678</td>
                        <td id="remove"><button>❌</button></td>
                        <td id="Update"><button>⚙️</button></td>
                    </tr>

                    <tr>
                        <td>Ex Sam</td>
                        <td>samenamewithsomephp@hahaha.com</td>
                        <td>Ex2024</td>
                        <td id="remove"><button>❌</button></td>
                        <td id="Update"><button>⚙️</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script src="script.js"></script>
    </body>
</html>