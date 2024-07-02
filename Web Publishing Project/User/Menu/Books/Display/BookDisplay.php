<?php 
include('../../../../connection.php');

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "dwp_project";

//function to connect with mysql
$connect = mysqli_connect($serverName, $userName, $password, $dbName);

//check if the connection is successful
if(mysqli_connect_errno()){
    echo"Failed to connect!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Display</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='BookDisplay.css'>

    <!--At here I adjust the scroll, ensuring that the user is guided to a position where they can see both the category name and description after click the tab.-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const offset = 100; 
            document.querySelectorAll('.selections a').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    const elementPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                });
            });
        });
    </script>
</head>
<body>

<!--This is the tab selection-->
<header>
    <img src="logo.png" >
    <h1>Welcome To Our Bookshelf!</h1>
    <ul>
        <li><a href="../../../Main Page/Main_Page/index.php">HOME</a></li>
        <li>
            <div class="dropdown">
                <span>CATEGORY</span>
                <div class="choice">
                <?php 
                    $sql_categories = "SELECT * FROM book_category";
                    $result_categories = mysqli_query($connect, $sql_categories);
                    
                    if ($result_categories && mysqli_num_rows($result_categories) > 0) {
                        while ($category = mysqli_fetch_assoc($result_categories)) {
                            echo '<h3 class="selections"><a href="#' . $category["CategoryName"] . '">' . $category["CategoryName"] . '</a></h3>';
                        }
                    }
                ?>
                </div>
            </div>
        </li>
        <li style="transform: translateX(40px);"><a href="../../../Cart/Cart.php">CART</a></li>
        <li style="transform: translateX(40px);"><a href="../../../Landing_Page/Landing.php">Log<span style="padding-left:2px;">&#x200B;</span>Out</a></li>
    </ul>
</header>


<!--This is the part displays our bookstore's slogan image-->
<p><br><br><br><br></p>
<section class="slogan">
    <img src="bookshelf.png">
</section>


<!--This will be the book display section-->
<!-- First, at here I fetch all the book category -->

<?php 
    $sql_categories = "SELECT * FROM book_category";
    $result_categories = mysqli_query($connect, $sql_categories);
    
    if ($result_categories && mysqli_num_rows($result_categories) > 0) {
        while ($category = mysqli_fetch_assoc($result_categories)) {
            echo '<h3 id="' . $category["CategoryName"] . '" class="desc_h3">' . $category["CategoryName"] . '</h3>';
            echo '<p class="desc_p">' . $category["Category_Description"] . '</p>';

// At here, I fetch all the books under the specific category, such as Picture Book, Novel, etc

            $sql_books = "SELECT * FROM booklist WHERE Category='" . $category["CategoryName"] . "'";
            $result_books = mysqli_query($connect, $sql_books);
    
            if ($result_books && mysqli_num_rows($result_books) > 0) {
                echo '<section class="book">';
                echo '<div class="picturebook">';
                while ($book = mysqli_fetch_assoc($result_books)) {
                    $bookIMGPath = "../../../../images/". $book["BookIMG"];
                    echo '<div>';
                    echo '<img src=" '. $bookIMGPath . '" alt="' . $book["Book_Name"] . '">';
                    echo '<h3>' . $book["Book_Name"] . '</h3>';
                    echo '<p>$' . $book["Price"] . '</p>';
                    echo '<a class="view" href="../BookDetail/BookDetail.php?id=' . $book["BookID"] . '"><button class="button type1"><span class="cart-txt">View Details</span></button></a>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</section>';
            } else {
                // This will show out if no books are related to that category
                echo "<p>No books found in this category.</p>";
            }
        }
    } else {
        // This will show out if no category is detected
        echo "<p>No categories found.</p>";
    }
    ?>
    
    </body>
    </html>
