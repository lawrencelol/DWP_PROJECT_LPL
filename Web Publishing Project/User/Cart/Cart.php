<?php
session_start();
include('connection.php'); // Adjust this include as per your file structure

// Check if the connection to the database is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve cart items for the current user
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($connect, $query);

if (!$result) {
    echo "Error: " . mysqli_error($connect);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo">
        <p>Cart</p>
        <ul>
            <li><a href="../../User/Main Page/Main_Page/index.php">Back To Home</a></li>
            <li><a href="../Menu/Books/Display/BookDisplay.php">Back To Bookshelf</a></li>
        </ul>
    </header>

    <br><br><br><br><br>
    <fieldset>
        <div>
            <h1 class="header">Shopping Cart<img src="cart.png" alt="cart"></h1>
            <hr>
            <table>
                <tr>
                    <th><b>Image</b></th>
                    <th><b>Book Name</b></th>
                    <th><b>Price</b></th>
                    <th><b>Options</b></th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><img src='../../../../images/" . $row['BookIMG'] . "' alt='" . $row['Book_Name'] . "' style='width: 100px; height: 140px;'></td>";
                    echo "<td>" . $row['Book_Name'] . "</td>";
                    echo "<td>RM " . $row['Price'] . "</td>";
                    echo "<td><a href='delete.php?id=" . $row['CartID'] . "'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </fieldset>
</body>
</html>

<?php
mysqli_close($connect);
?>
