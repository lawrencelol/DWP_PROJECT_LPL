<?php
// Include database connection
include('../../connection.php');

// Function to sanitize inputs
function sanitize($connect, $data) {
    return mysqli_real_escape_string($connect, $data);
}

// Function to generate user ID (you may replace this with your own logic)
function generateUserID() {
    // Example logic to generate a unique user ID
    return uniqid('user_', true);
}

// Add user functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add_user') {
        // Sanitize and validate inputs
        $username = sanitize($connect, $_POST['user_Username']);
        $password = sanitize($connect, $_POST['user_Password']);
        $email = sanitize($connect, $_POST['user_Email']);
        $phone = sanitize($connect, $_POST['user_Phone']);
        $birthday = sanitize($connect, $_POST['user_Birthday']);

        // Handle file upload for profile picture
        $profile_picture = ''; // Default value

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['profile_picture']['tmp_name'];
            $upload_dir = '../../user images/'; // Directory where you want to store uploads
            $file_name = basename($_FILES['profile_picture']['name']);
            $profile_picture = $upload_dir . $file_name;

            if (move_uploaded_file($tmp_name, $profile_picture)) {
                // File uploaded successfully
                // You may want to store $profile_picture in your database
            } else {
                echo '<script>alert("Error uploading profile picture.");</script>';
            }
        }

        // Generate user ID
        $id = generateUserID();

        // Insert data into the database using prepared statement
        $stmt = mysqli_prepare($connect, "INSERT INTO user_register (id, username, userpass, email, phone, birthday, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sssssss', $id, $username, $password, $email, $phone, $birthday, $profile_picture);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("New user added successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($connect) . '");</script>';
        }

        mysqli_stmt_close($stmt);

    } elseif ($action == 'update_user') {
        // Sanitize and validate inputs
        $id = sanitize($connect, $_POST['id']);
        $username = sanitize($connect, $_POST['user_Username']);
        $password = sanitize($connect, $_POST['user_Password']);
        $email = sanitize($connect, $_POST['user_Email']);
        $phone = sanitize($connect, $_POST['user_Phone']);
        $birthday = sanitize($connect, $_POST['user_Birthday']);

        // Handle file upload for profile picture (if updating)

        // Update data in the database using prepared statement
        $stmt = mysqli_prepare($connect, "UPDATE user_register SET username = ?, userpass = ?, email = ?, phone = ?, birthday = ?, profile_picture = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'sssssss', $username, $password, $email, $phone, $birthday, $profile_picture, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("User updated successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . mysqli_error($connect) . '");</script>';
        }

        mysqli_stmt_close($stmt);
    }
}

// Delete user functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete_user') {
    $id = sanitize($connect, $_POST['id']);

    $sql = "DELETE FROM user_register WHERE id = '$id'";
    if (mysqli_query($connect, $sql)) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user: " . mysqli_error($connect);
    }
    exit; // Ensure no further code is executed
}

// Fetch users functionality
$sql = "SELECT id, username, userpass, email, phone, birthday, profile_picture FROM user_register";
$result = mysqli_query($connect, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="Manage_USER.css">
    <style>
        /* Modal styling */
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
                <li><a href="../Manage_Staff/Manage_Staff.php">STAFF</a></li>
                <li class="active"><a href="Manage_USER.php">USER</a></li>
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
        <h1>User Management</h1>
        <!-- Add User Button -->
        <button id="addUserBtn" style="background: #4c4f75; border-radius: 10px; color: white; padding: 10px; font-weight: 800; font-size: 15px;">Add New User</button>

        <!-- The Add User Modal -->
        <div id="addUserModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form class="form" id="addUserForm" method="post" action="Manage_USER.php" enctype="multipart/form-data">
                    <h2>Add New User</h2>
                    <input type="hidden" name="action" value="add_user">
                    <label for="user_Username">Username:</label>
                    <input type="text" id="user_Username" name="user_Username" required>
                    <label for="user_Email">Email:</label>
                    <input type="email" id="user_Email" name="user_Email" required>
                    <label for="user_Password">Password:</label>
                    <input type="text" id="user_Password" name="user_Password" required>
                    <label for="user_Phone">Phone:</label>
                    <input type="text" id="user_Phone" name="user_Phone" required>
                    <label for="user_Birthday">Birthday:</label>
                    <input type="date" id="user_Birthday" name="user_Birthday" required>
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture">
                    <button type="submit" style="background: #4c4f75; border-radius: 10px; color: white; padding: 10px; font-weight: 800; font-size: 15px;">Add User</button>
                </form>
            </div>
        </div>

        <!-- The Update User Modal -->
        <div id="updateUserModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form class="form" id="updateUserForm" method="post" action="Manage_USER.php">
                    <h2>Update User</h2>
                    <input type="hidden" name="action" value="update_user">
                    <input type="hidden" id="update_id" name="id">
                    <label for="update_user_Username">Username:</label>
                    <input type="text" id="update_user_Username" name="user_Username" required>
                    <label for="update_user_Email">Email:</label>
                    <input type="email" id="update_user_Email" name="user_Email" required>
                    <label for="update_user_Password">Password:</label>
                    <input type="text" id="update_user_Password" name="user_Password" required>
                    <label for="update_user_Phone">Phone:</label>
                    <input type="text" id="update_user_Phone" name="user_Phone" required>
                    <label for="update_user_Birthday">Birthday:</label>
                    <input type="date" id="update_user_Birthday" name="user_Birthday" required>
                    <label for="update_user_Profile_Picture">Profile Picture:</label>
                    <input type="text" id="update_user_Profile_Picture" name="user_Profile_Picture" required>
                    <button type="submit" style="background: #4c4f75; border-radius: 10px; color: white; padding: 10px; font-weight: 800; font-size: 15px;">Update User</button>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>Profile Picture</th>
                    <th>DELETE</th>
                    <th>UPDATE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr id='user_" . $row['id'] . "'>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['userpass'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['birthday'] . "</td>";
                        echo "<td><img src='" . $row['profile_picture'] . "' style='width: 60px; height: auto;' alt='Profile Picture'></td>"; // Display profile picture
                        echo '<td><button onclick="deleteUser(\'' . $row['id'] . '\')">❌</button></td>';
                        echo '<td><button onclick="openUpdateUserModal(\'' . $row['id'] . '\', \'' . addslashes($row['username']) . '\', \'' . addslashes($row['email']) . '\', \'' . addslashes($row['userpass']) . '\', \'' . addslashes($row['phone']) . '\', \'' . addslashes($row['birthday']) . '\', \'' . addslashes($row['profile_picture']) . '\')">⚙️</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Get the modals
        var addModal = document.getElementById("addUserModal");
        var updateModal = document.getElementById("updateUserModal");

        // Get the button that opens the add modal
        var btn = document.getElementById("addUserBtn");

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

        // Function to open update modal with user data
        function openUpdateUserModal(id, username, email, password, phone, birthday, profile_picture) {
            document.getElementById('update_id').value = id;
            document.getElementById('update_user_Username').value = username;
            document.getElementById('update_user_Email').value = email;
            document.getElementById('update_user_Password').value = password;
            document.getElementById('update_user_Phone').value = phone;
            document.getElementById('update_user_Birthday').value = birthday;
            document.getElementById('update_user_Profile_Picture').value = profile_picture;
            updateModal.style.display = "block";
        }

        // JavaScript function to delete user via AJAX
        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "Manage_USER.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        if (xhr.responseText.trim() === "User deleted successfully!") {
                            document.getElementById('user_' + id).remove();
                            alert("User deleted successfully!");
                        } else {
                            alert("Error: " + xhr.responseText);
                        }
                    }
                };
                xhr.send("action=delete_user&id=" + id);
            }
        }
    </script>
</body>
</html>

<?php
mysqli_close($connect);
?>
