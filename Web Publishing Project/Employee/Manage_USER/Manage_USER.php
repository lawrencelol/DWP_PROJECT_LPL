<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Emp_USER</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Manage_USER.css"> 
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
                    <li class="active"><a href="../Manage_USER/Manage_USER.php">USER</a></li>
                    <li><a href="../Manage_Category/Category.php">CATEGORY</a></li>
                    <li><a href="../Stock/stock.php">STOCK</a></li>
                    <li><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                    <li><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                    <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
                </ul>
            </div>
        </div>

        <div class="container">
            <h1>User Management</h1>
            <form class="form" id="addStaffForm">
                <h2>Add New User</h2>
                <label for="staffName">Username:</label>
                <input type="text" id="staffName" name="staffName" required>
                <label for="staffEmail">Email:</label>
                <input type="email" id="staffEmail" name="staffEmail" required>
                <button type="submit">Add User</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dot Jason</td>
                        <td>Iwillmakeyoutribble@hahaha.com</td>
                        <td class="remove"><button>❌</button></td>
                    </tr>

                    <tr>
                        <td>Dot Jason</td>
                        <td>Iwillmakeyoutribble@hahaha.com</td>
                        <td class="remove"><button>❌</button></td>
                    </tr>
                    
                    <tr>
                        <td>Dot Jason</td>
                        <td>Iwillmakeyoutribble@hahaha.com</td>
                        <td class="remove"><button>❌</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script src="script.js"></script>
    </body>
</html>