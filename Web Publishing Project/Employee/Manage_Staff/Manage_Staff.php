<?php
// Include database connection
include('../../connection.php');

// Function to sanitize inputs
function sanitize($connect, $data) {
    return mysqli_real_escape_string($connect, $data);
}

// Function to generate admin ID
function generateAdminID() {
    return 'ADM' . substr(md5(time() . mt_rand()), 0, 3);
}

// Add admin functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add_admin') {
        // Sanitize and validate inputs
        $name = sanitize($connect, $_POST['admin_Name']);
        $email = sanitize($connect, $_POST['admin_Email']);
        $password = sanitize($connect, $_POST['admin_Password']);
        $phone = sanitize($connect, $_POST['admin_Phone']);
        $birthday = sanitize($connect, $_POST['admin_Birthday']);
        
        // Generate admin ID
        $admin_id = generateAdminID();

        // Insert data into the database using prepared statement
        $stmt = mysqli_prepare($connect, "INSERT INTO admin_register (admin_id, admin_name, admin_email, admin_password, admin_phone, admin_birthday) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssssss', $admin_id, $name, $email, $password, $phone, $birthday);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("New admin added successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($connect) . '");</script>';
        }

        mysqli_stmt_close($stmt);

    } elseif ($action == 'update_admin') {
        // Sanitize and validate inputs
        $admin_id = sanitize($connect, $_POST['admin_id']);
        $name = sanitize($connect, $_POST['admin_Name']);
        $email = sanitize($connect, $_POST['admin_Email']);
        $password = sanitize($connect, $_POST['admin_Password']);
        $phone = sanitize($connect, $_POST['admin_Phone']);
        $birthday = sanitize($connect, $_POST['admin_Birthday']);
        
        // Update data in the database using prepared statement
        $stmt = mysqli_prepare($connect, "UPDATE admin_register SET admin_name = ?, admin_email = ?, admin_password = ?, admin_phone = ?, admin_birthday = ? WHERE admin_id = ?");
        mysqli_stmt_bind_param($stmt, 'ssssss', $name, $email, $password, $phone, $birthday, $admin_id);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Admin updated successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($connect) . '");</script>';
        }

        mysqli_stmt_close($stmt);
    }
}

// Delete admin functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete_admin') {
    $admin_id = sanitize($connect, $_POST['admin_id']);

    $sql = "DELETE FROM admin_register WHERE admin_id = '$admin_id'";
    if (mysqli_query($connect, $sql)) {
        echo "Admin deleted successfully!";
    } else {
        echo "Error deleting admin: " . mysqli_error($connect);
    }
    exit;
}

// Fetch admins functionality
$sql = "SELECT admin_id, admin_name, admin_email, admin_password, admin_phone, admin_birthday FROM admin_register";
$result = mysqli_query($connect, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="Manage_Staff.css">
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="selection">
        <div class="Logo">
            <img src="Logo.png" />
        </div>
        <div class="bar">
            <ul>
                <li><a href="../Employee_Home_Page/Home_Page_EMP.php">DASHBOARD</a></li>
                <li class="active"><a href="Manage_Staff.php">ADMIN</a></li>
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

        
    <div class="container">
        <h1>Admin Management</h1>
        <!-- Add Admin Button -->
        <button id="addAdminBtn" style="background: #4c4f75; border-radius: 10px; color: white; padding: 10px; font-weight: 800; font-size: 15px;">Add New Admin</button>

        <!-- The Add Admin Modal -->
        <div id="addAdminModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form class="form" id="addAdminForm" method="post" action="Manage_Staff.php">
                    <h2>Add New Admin</h2>
                    <input type="hidden" name="action" value="add_admin">
                    <label for="admin_Name">Name:</label>
                    <input type="text" id="admin_Name" name="admin_Name" required>
                    <label for="admin_Email">Email:</label>
                    <input type="email" id="admin_Email" name="admin_Email" required>
                    <label for="admin_Password">Password:</label>
                    <input type="text" id="admin_Password" name="admin_Password" required>
                    <label for="admin_Phone">Phone:</label>
                    <input type="text" id="admin_Phone" name="admin_Phone" required>
                    <label for="admin_Birthday">Birthday:</label>
                    <input type="date" id="admin_Birthday" name="admin_Birthday" required>
                    <button type="submit" style="background: #4c4f75; border-radius: 10px; color: white; padding: 10px; font-weight: 800; font-size: 15px;">Add Admin</button>
                </form>
            </div>
        </div>

        <!-- The Update Admin Modal -->
        <div id="updateAdminModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form class="form" id="updateAdminForm" method="post" action="Manage_Staff.php">
                    <h2>Update Admin</h2>
                    <input type="hidden" name="action" value="update_admin">
                    <input type="hidden" id="update_admin_id" name="admin_id">
                    <label for="update_admin_Name">Name:</label>
                    <input type="text" id="update_admin_Name" name="admin_Name" required>
                    <label for="update_admin_Email">Email:</label>
                    <input type="email" id="update_admin_Email" name="admin_Email" required>
                    <label for="update_admin_Password">Password:</label>
                    <input type="text" id="update_admin_Password" name="admin_Password" required>
                    <label for="update_admin_Phone">Phone:</label>
                    <input type="text" id="update_admin_Phone" name="admin_Phone" required>
                    <label for="update_admin_Birthday">Birthday:</label>
                    <input type="date" id="update_admin_Birthday" name="admin_Birthday" required>
                    <button type="submit" style="background: #4c4f75; border-radius: 10px; color: white; padding: 10px; font-weight: 800; font-size: 15px;">Update Admin</button>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>DELETE</th>
                    <th>UPDATE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr id='admin_" . $row['admin_id'] . "'>";
                        echo "<td>" . $row['admin_name'] . "</td>";
                        echo "<td>" . $row['admin_email'] . "</td>";
                        echo "<td>" . $row['admin_password'] . "</td>";
                        echo "<td>" . $row['admin_phone'] . "</td>";
                        echo "<td>" . $row['admin_birthday'] . "</td>";
                        echo '<td><button onclick="deleteAdmin(\'' . $row['admin_id'] . '\')">❌</button></td>';
                        echo '<td><button onclick="openUpdateAdminModal(\'' . $row['admin_id'] . '\', \'' . addslashes($row['admin_name']) . '\', \'' . addslashes($row['admin_email']) . '\', \'' . addslashes($row['admin_password']) . '\', \'' . addslashes($row['admin_phone']) . '\', \'' . addslashes($row['admin_birthday']) . '\')">⚙️</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No admins found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Get the modals
        var addModal = document.getElementById("addAdminModal");
        var updateModal = document.getElementById("updateAdminModal");

        // Get the button that opens the add modal
        var btn = document.getElementById("addAdminBtn");

        // Get the <span> element that closes the modals
        var spans = document.getElementsByClassName("close");

        // When the user clicks the button, open the add modal 
        btn.onclick = function() {
            addModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modals
        for (let i = 0; i < spans.length; i++) {
            spans[i].onclick = function() {
                addModal.style.display = "none";
                updateModal.style.display = "none";
            }
        }

        // When the user clicks anywhere outside of the modals, close them
        window.onclick = function(event) {
            if (event.target == addModal) {
                addModal.style.display = "none";
            }
            if (event.target == updateModal) {
                updateModal.style.display = "none";
            }
        }

        // Function to open update modal with admin data
        function openUpdateAdminModal(id, name, email, password, phone, birthday) {
            document.getElementById('update_admin_id').value = id;
            document.getElementById('update_admin_Name').value = name;
            document.getElementById('update_admin_Email').value = email;
            document.getElementById('update_admin_Password').value = password;
            document.getElementById('update_admin_Phone').value = phone;
            document.getElementById('update_admin_Birthday').value = birthday;
            updateModal.style.display = "block";
        }

        // JavaScript function to delete admin via AJAX
        function deleteAdmin(admin_id) {
            if (confirm("Are you sure you want to delete this admin?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "Manage_Staff.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        if (xhr.responseText.trim() === "Admin deleted successfully!") {
                            document.getElementById('admin_' + admin_id).remove();
                            alert("Admin deleted successfully!");
                        } else {
                            alert("Error: " + xhr.responseText);
                        }
                    }
                };
                xhr.send("action=delete_admin&admin_id=" + admin_id);
            }
        }
    </script>
</body>
</html>

<?php
mysqli_close($connect);
?>
