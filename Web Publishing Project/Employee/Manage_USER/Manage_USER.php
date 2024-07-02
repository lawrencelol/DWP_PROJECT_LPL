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
            $file_type = mime_content_type($tmp_name);
            $upload_dir = '../../user images/'; // Directory where you want to store uploads
            $file_name = basename($_FILES['profile_picture']['name']);

            if ($file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/gif' || $file_type == 'image/jpg') {
                $profile_picture = $file_name; // Only save the filename

                if (!move_uploaded_file($tmp_name, $upload_dir . $file_name)) {
                    echo '<script>alert("Error uploading profile picture.");</script>';
                }
            } else {
                echo '<script>alert("Invalid file type. Only JPEG, PNG, GIF, and JPG are allowed.");</script>';
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
        $profile_picture = ''; // Default value

        // Check if profile picture is being updated
        if (isset($_FILES['update_profile_picture']) && $_FILES['update_profile_picture']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['update_profile_picture']['tmp_name'];
            $file_type = mime_content_type($tmp_name);
            $upload_dir = '../../user images/'; // Directory where you want to store uploads
            $file_name = basename($_FILES['update_profile_picture']['name']);

            if ($file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/gif' || $file_type == 'image/jpg') {
                $profile_picture = $file_name; // Only save the filename

                if (!move_uploaded_file($tmp_name, $upload_dir . $file_name)) {
                    echo '<script>alert("Error uploading profile picture.");</script>';
                }
            } else {
                echo '<script>alert("Invalid file type. Only JPEG, PNG, GIF, and JPG are allowed.");</script>';
            }
        }

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
        // Redirect back to the manage user page
        header("Location: Manage_USER.php");
        exit();
    } else {
        echo '<script>alert("Error deleting user: ' . mysqli_error($connect) . '");</script>';
    }
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
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            overflow: auto; 
        }

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
                    <label for="user_Password">Password:</label>
                    <input type="password" id="user_Password" name="user_Password" required>
                    <label for="user_Email">Email:</label>
                    <input type="email" id="user_Email" name="user_Email" required>
                    <label for="user_Phone">Phone:</label>
                    <input type="text" id="user_Phone" name="user_Phone" required>
                    <label for="user_Birthday">Birthday:</label>
                    <input type="date" id="user_Birthday" name="user_Birthday" required>
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg, image/png, image/gif, image/jpg" required>
                    <button type="submit" style="background: #4c4f75; border-radius: 10px; color: white; padding: 10px; font-weight: 800; font-size: 15px;">Add User</button>
                </form>
            </div>
        </div>

        <!-- The Update User Modal -->
        <div id="updateUserModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form class="form" id="updateUserForm" method="post" action="Manage_USER.php" enctype="multipart/form-data">
                    <h2>Update User</h2>
                    <input type="hidden" id="update_id" name="id">
                    <input type="hidden" name="action" value="update_user">
                    <label for="update_user_Username">Username:</label>
                    <input type="text" id="update_user_Username" name="user_Username" required>
                    <label for="update_user_Password">Password:</label>
                    <input type="password" id="update_user_Password" name="user_Password" required>
                    <label for="update_user_Email">Email:</label>
                    <input type="email" id="update_user_Email" name="user_Email" required>
                    <label for="update_user_Phone">Phone:</label>
                    <input type="text" id="update_user_Phone" name="user_Phone" required>
                    <label for="update_user_Birthday">Birthday:</label>
                    <input type="date" id="update_user_Birthday" name="user_Birthday" required>
                    <label for="update_profile_picture">Profile Picture:</label>
                    <input type="file" id="update_profile_picture" name="update_profile_picture" accept="image/jpeg, image/png, image/gif, image/jpg">
                    <button type="submit"  style="background: #4c4f75; border-radius: 10px; color: white; padding: 10px; font-weight: 800; font-size: 15px;">Update User</button>
                </form>
            </div>
        </div>

        <!-- User Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>Profile Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['userpass']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['birthday']; ?></td>
                        <td><img src="../../user images/<?php echo $row['profile_picture']; ?>" alt="Profile Picture" style="width: 50px;"></td>
                        <td>
                            <!-- Update Button -->
                            <button class="editBtn" data-id="<?php echo $row['id']; ?>">⚙️</button>
                            
                            <!-- Delete Form -->
                            <form method="post" action="Manage_USER.php" style="display:inline-block;" onsubmit="return confirmDelete();">
                                <input type="hidden" name="action" value="delete_user">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit">❌</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript for Modals and Confirmation -->
    <script>
        // Function to handle confirmation for delete action
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }

        // Function to handle modal for adding new user
        var addUserModal = document.getElementById("addUserModal");
        var addUserBtn = document.getElementById("addUserBtn");
        var closeAddUserModal = document.getElementsByClassName("close")[0];

        addUserBtn.onclick = function() {
            addUserModal.style.display = "block";
        }

        closeAddUserModal.onclick = function() {
            addUserModal.style.display = "none";
        }

        // Function to handle modal for updating user
        var updateUserModal = document.getElementById("updateUserModal");
        var editBtns = document.getElementsByClassName("editBtn");
        var closeUpdateUserModal = document.getElementsByClassName("close")[1];

        for (var i = 0; i < editBtns.length; i++) {
            editBtns[i].onclick = function() {
                var id = this.getAttribute('data-id');
                document.getElementById("update_id").value = id;
                updateUserModal.style.display = "block";
            }
        }

        closeUpdateUserModal.onclick = function() {
            updateUserModal.style.display = "none";
        }

        // Close the modal if user clicks outside the modal
        window.onclick = function(event) {
            if (event.target == addUserModal) {
                addUserModal.style.display = "none";
            } else if (event.target == updateUserModal) {
                updateUserModal.style.display = "none";
            }
        }
    </script>
</body>
</html>
