<?php
session_start();
include('connection.php'); // Adjust this include as per your file structure

// Check if the connection to the database is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize a session variable to track if a book has been added before
if (!isset($_SESSION['book_added'])) {
    $_SESSION['book_added'] = array(); // Initialize an empty array
}

// Check if the BookID is set in the URL
if (isset($_GET['id'])) {
    $bookID = mysqli_real_escape_string($connect, $_GET['id']);

    // Fetch book details based on BookID from the database
    $sql = "SELECT * FROM booklist WHERE BookID = '$bookID'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    } else {
        // Handle case where book is not found
        echo "Book not found.";
        exit();
    }
} else {
    // Handle case where BookID is unavailable
    echo "BookID is unavailable.";
    exit();
}

// Get user_id from session or wherever it's stored (replace with your actual mechanism)
$user_id = $_SESSION['user_id']; // Adjust this based on your session structure

// Handle form submission for adding to cart
if (isset($_POST['add_to_cart'])) {
    $bookIMG = mysqli_real_escape_string($connect, $_POST['BookIMG']);
    $bookName = mysqli_real_escape_string($connect, $_POST['Book_Name']);
    $price = mysqli_real_escape_string($connect, $_POST['Price']);

    // Check if the book is already in the cart (based on book name as an example for the current user)
    $check_sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND Book_Name = '$bookName'";
    $check_result = mysqli_query($connect, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Book is already in the cart, set session variable and redirect
        $_SESSION['book_already_added'] = true;
        header("Location: BookDetail.php?id=$bookID");
        exit();
    }

    // Insert the book into the cart table
    $insert_sql = "INSERT INTO cart (user_id, BookIMG, Book_Name, Price) 
                   VALUES ('$user_id', '$bookIMG', '$bookName', '$price')";

    if (mysqli_query($connect, $insert_sql)) {
        $cart_id = mysqli_insert_id($connect); // Get the Cart_id of the inserted row
        
        // Check if book has been added for the first time
        if (!in_array($bookName, $_SESSION['book_added'])) {
            $_SESSION['book_added'][] = $bookName; // Add book to session array
            
            // JavaScript alert to notify user
            echo '<script>alert("Book added successfully!");</script>';
        }
        // Redirect back to the book detail page with added parameter
        header("Location: BookDetail.php?id=$bookID&added=true&cart_id=$cart_id");
        exit();
    } else {
        // Handle database insertion error
        echo "Error: " . mysqli_error($connect);
    }
}

mysqli_close($connect); // Close database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($book['Book_Name']) ? $book['Book_Name'] : ''; ?></title>
    <link rel="stylesheet" href="BookDetail.css">
</head>
<body>

<header>
    <img src="logo.png" alt="Logo">
    <p>You Have Great Taste!</p>
    <ul>
        <li><a href="../../Books/Display/BookDisplay.php">&lt; Back To Bookshelf</a></li>
    </ul>
</header>

<br><br><br><br>

<section class="book">
    <div class="image">
        <img src="<?php echo isset($book['BookIMG']) ? "../../../../images/" . $book['BookIMG'] : ''; ?>" alt="<?php echo isset($book['Book_Name']) ? $book['Book_Name'] : ''; ?>">
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
