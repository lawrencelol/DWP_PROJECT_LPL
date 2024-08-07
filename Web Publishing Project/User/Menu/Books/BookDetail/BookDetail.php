<?php
session_start();
include('connection.php'); 

//Check if the connection to the database is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

//Track if the book has been added before
if (!isset($_SESSION['book_added'])) {
    $_SESSION['book_added'] = array(); // Initialize an empty array
}

//Check if the BookID is set in the URL
if (isset($_GET['id'])) {
    $bookID = mysqli_real_escape_string($connect, $_GET['id']);

    //Get book details based on BookID from the booklist table
    $sql = "SELECT * FROM booklist WHERE BookID = '$bookID'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    } else {
        //If the book is not found
        echo "Book not found.";
        exit();
    }
} else {
    //If the BookID is unavailable
    echo "BookID is unavailable.";
    exit();
}

//Get user_id from session 
$user_id = $_SESSION['user_id']; 

//add to cart submission
if (isset($_POST['add_to_cart'])) {
    $bookIMG = mysqli_real_escape_string($connect, $_POST['BookIMG']);
    $bookName = mysqli_real_escape_string($connect, $_POST['Book_Name']);
    $price = mysqli_real_escape_string($connect, $_POST['Price']);
    $category = mysqli_real_escape_string($connect, $_POST['Category']); 

    //Check if the book is already in the cart 
    $check_sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND Book_Name = '$bookName'";
    $check_result = mysqli_query($connect, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        //If Book is already in the cart
        $_SESSION['book_already_added'] = true;
        header("Location: BookDetail.php?id=$bookID");
        exit();
    }

    //Insert the book into the cart table
    $insert_sql = "INSERT INTO cart (user_id, BookIMG, Book_Name, Price, Category) 
                   VALUES ('$user_id', '$bookIMG', '$bookName', '$price', '$category')";

    if (mysqli_query($connect, $insert_sql)) {
        $cart_id = mysqli_insert_id($connect); 
        
        //Check if book has been added for the first time
        if (!in_array($bookName, $_SESSION['book_added'])) {
            $_SESSION['book_added'][] = $bookName; 
            
            $_SESSION['book_added_success'] = true;
        }
        //Redirect back to the book detail page with added parameter
        header("Location: BookDetail.php?id=$bookID&added=true&cart_id=$cart_id");
        exit();
    } else {
        //If there is database insertion error
        echo "Error: " . mysqli_error($connect);
    }
}

mysqli_close($connect); 
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

<!-- This is the tab bar -->
<header>
    <img src="logo.png" alt="Logo">
    <p>You Have Great Taste!</p>
    <ul>
        <li><a href="../../Books/Display/BookDisplay.php">&lt; Back To Bookshelf</a></li>
    </ul>
</header>

<br><br><br><br>

<!-- This is where the book details being shown -->
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
            <input type="hidden" name="Category" value="<?php echo $book['Category']; ?>"> <!-- Add this line -->
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

// Check if the session variable for successful addition is set
if (isset($_SESSION['book_added_success']) && $_SESSION['book_added_success']) {
    echo '<script>';
    echo 'alert("Book added to cart successfully!");';
    echo '</script>';
    // Unset the session variable to prevent further alerts on refresh
    unset($_SESSION['book_added_success']);
}
?>

</body>
</html>
