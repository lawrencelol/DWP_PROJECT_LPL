<?php 
include('../../connection.php');

//Get all the categories
$sql = "SELECT *, (SELECT COUNT(*) FROM booklist WHERE booklist.Category = book_category.CategoryName) AS Total_Book FROM book_category";
$result = mysqli_query($connect, $sql);

//Delete function
if (isset($_GET['delete'])) {
    $categoryID = $_GET['delete'];
    $delete_sql = "DELETE FROM book_category WHERE CategoryID='$categoryID'";
    if (mysqli_query($connect, $delete_sql)) {
        echo "<script>alert('Book Category deleted successfully!'); window.location.href='Category.php';</script>";
    } else {
        echo "<script>alert('Error deleting category: " . mysqli_error($connect) . "'); window.location.href='Category.php';</script>";
    }
}

//Add new category function
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $categoryID = $_POST['id'];
    $categoryName = $_POST['catname'];
    $addedDate = $_POST['date'];
    $categoryDescription = $_POST['catdesc'];
    
    $insert_sql = "INSERT INTO book_category (CategoryID, CategoryName, AddedDate, Category_Description) 
                   VALUES ('$categoryID', '$categoryName', '$addedDate', '$categoryDescription')";
    if (mysqli_query($connect, $insert_sql)) {
        echo "<script>alert('Book Category added successfully!'); window.location.href='Category.php';</script>";
    } else {
        echo "<script>alert('Error adding category: " . mysqli_error($connect) . "'); window.location.href='Category.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emp_Category</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Category.css"> 
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
                    <li class="active"><a href="../Manage_Category/Category.php">CATEGORY</a></li>
                    <li><a href="../Stock/stock.php">STOCK</a></li>
                    <li><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                    <li><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                    <li><a href="../Contact_Record/Contact_Record.php">CONTACT</a></li>
                    <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
                </ul>
            </div>
        </div>

<fieldset>
    <div class="header">
        <h1>Book Category Management</h1>
    </div>
    <!-- The table that display Book Category -->
    <section class="table">
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Total of Book</th>
                        <th>Added Date</th>
                        <th>Category Description</th>
                        <th>Remove Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['CategoryID'] . '</td>';
                            echo '<td>' . $row['CategoryName'] . '</td>';
                            echo '<td>' . $row['Total_Book'] . '</td>';
                            echo '<td>' . $row['AddedDate'] . '</td>';
                            echo "<td class='short-desc'>" . $row['Category_Description'] . '</td>';
                            echo "<td class='short-button'><button type=\"button\" class=\"delCat\" onclick=\"confirmDelete('{$row['CategoryID']}')\">Delete</button></td>";
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- This is the ass new category button and pop-up form -->
    <button class="add" style="left: -540px;">Add new category</button>
    <div class="popup">
        <div class="close">&times;</div>
        <div class="form">
            <h3>New Category Details</h3>
            <form method="POST" action="">
                <div class="info">
                    <label for="id">ID</label>
                    <input type="text" id="id" name="id" placeholder="Enter Category ID" required>
                    <label for="catname">Category Name</label>
                    <input type="text" id="catname" name="catname" placeholder="Enter Category Name" required>
                    <label for="catdesc">Category Description</label>
                    <input type="text" id="catdesc" name="catdesc" placeholder="Enter Category Description" required>
                    <label for="date">Date Added</label>
                    <input type="date" id="date" name="date" required>
                    <button type="submit" name="add_category" class="add">Add</button>
                </div>
            </form>
        </div>
    </div>
</fieldset>

<script>
    document.querySelector(".add").addEventListener("click", function() {
        document.querySelector(".popup").classList.add("active");
    });
    document.querySelector(".popup .close").addEventListener("click", function() {
        document.querySelector(".popup").classList.remove("active");
    });

    function confirmDelete(categoryID) {
        if (confirm("Are you sure you want to delete this category?")) {
            window.location.href = "?delete=" + categoryID;
        }
    }

</script>

    </body>
</html>
