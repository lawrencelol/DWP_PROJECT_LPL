<?php
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
        <img src="<?php echo isset($book['BookIMG']) ? $book['BookIMG'] : ''; ?>" alt="<?php echo isset($book['Book_Name']) ? $book['Book_Name'] : ''; ?>">
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
        <button class="button type1"><span class="cart-txt">Add To Cart</span></button>
    </div>
</section>

</body>
</html>
