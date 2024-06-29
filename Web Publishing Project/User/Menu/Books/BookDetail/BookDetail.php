<?php
include('../../Login/Log-in.php');
session_start(); 
$loggedName = $_SESSION['Username']; // Take the session that keep in Log-in.php 
include('../../../../connection.php');

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "dwp_project";

// Function to connect with MySQL
$connect = mysqli_connect($serverName, $userName, $password, $dbName);

// Check if the connection is successful
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Initialize a session variable to track if book has been added before
if (!isset($_SESSION['book_added'])) {
    $_SESSION['book_added'] = array(); // Initialize an empty array
}

// At here I identified the BookID related with the button clicked
if (isset($_GET['id'])) {
    $bookID = mysqli_real_escape_string($connect, $_GET['id']);

    // At here I fetch the book details based on the BookID 
    $sql = "SELECT * FROM booklist WHERE BookID = '$bookID'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result); 
    } else {
        // This will show up if the book does not exist
        echo "Book not found.";
        exit();
    }
} else {
    // This will show up if the BookID does not exist in the SQL table 
    echo "BookID is unavailable.";
    exit();
}

// Handle form submission for adding to cart
if (isset($_POST['add_to_cart'])) {
    $bookIMG = mysqli_real_escape_string($connect, $_POST['BookIMG']);
    $bookName = mysqli_real_escape_string($connect, $_POST['Book_Name']);
    $price = mysqli_real_escape_string($connect, $_POST['Price']);

    // Check if the book is already in the cart (based on book name as an example)
    $check_sql = "SELECT * FROM cart WHERE Book_Name = '$bookName'";
    $check_result = mysqli_query($connect, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Book is already in the cart, set session variable
        $_SESSION['book_already_added'] = true;
        header("Location: BookDetail.php?id=$bookID");
        exit();
    }

    // If not already in cart, insert into cart table
    $insert_sql = "INSERT INTO cart (Username, BookIMG, Book_Name, Price) VALUES ('$loggedName','$bookIMG', '$bookName', '$price')";
    
    if (mysqli_query($connect, $insert_sql)) {
        // Check if book has been added for the first time
        if (!in_array($bookName, $_SESSION['book_added'])) {
            $_SESSION['book_added'][] = $bookName; // Add book to session array
            
            // JavaScript alert to notify user
            echo '<script>alert("Book added successfully!");</script>';
        }
        header("Location: BookDetail.php?id=$bookID&added=true");
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flippy The Silly Little Fish</title>
    <link rel='stylesheet' href='BookDetail.css'>
</head>
<body>

<!-- Tab selection -->
<header>
    <img src="logo.png" >
    <p>You Have Great Taste!</p>
    <ul>
        <li><a href="../../Books/Display/BookDisplay.php">&lt; Back To Bookshelf</a></li>
    </ul>
</header>

<br><br><br><br>

<!--The Book Detail will be shown for the user at HERE-->
<section class="book">
    <div class="image">
        <img src="<?php $bookIMGPath = "../../../../images/". $book["BookIMG"]; echo isset($book['BookIMG']) ? $bookIMGPath : ''; ?>" alt="<?php echo isset($book['Book_Name']) ? $book['Book_Name'] : ''; ?>">
    </div>
    <div class="desc">
        <h2><?php echo isset($book['Book_Name']) ? $book['Book_Name'] : ''; ?></h2>
        <div class="info">
            <p>Price: RM <?php echo isset($book['Price']) ? $book['Price'] : ''; ?></p>
            <p>Author: <?php echo isset($book['Author']) ? $book['Author'] : ''; ?></p>
            <p>Publisher: <?php echo isset($book['Publisher']) ? $book['Publisher'] : ''; ?></p>
        </div>
        <h3>Synopsis: </h3>
        <p><?php echo isset($book['Synopsis']) ? $book['Synopsis'] : ''; ?></p>
        <form method="POST">
            <input type="hidden" name="BookIMG" value="<?php echo $book['BookIMG']; ?>">
            <input type="hidden" name="Book_Name" value="<?php echo $book['Book_Name']; ?>">
            <input type="hidden" name="Price" value="<?php echo $book['Price']; ?>">
            <button type="submit" name="add_to_cart" class="button type1"><span class="cart-txt">Add To Cart</span></button>
        </form>
    </div>
</section>

<?php
// Check if the session variable for book already added is set
if (isset($_SESSION['book_already_added']) && $_SESSION['book_already_added']) {
    echo '<script>';
    echo 'alert("The book is already added to your cart!");';
    echo '</script>';
    // Unset the session variable to prevent further alerts on refresh
    unset($_SESSION['book_already_added']);
}
?>

</body>
</html>
