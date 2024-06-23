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
    <link rel='stylesheet' href='BookDisplay.css'>
</head>
<body>

<!--这里是上方标签-->
<header>
    <img src="logo.png" >
    <h1>Welcome To Our Bookshelf!</h1>
    <ul>
        <li><a href="../../../Main Page/Main_Page/index.php">HOME</a></li>
        <li>
            <div class="dropdown">
                <span>CATEGORY</span>
                <div class="choice">
                <a href="#picturebook" class="selections">Picture Book</a>
                <a href="#novel" class="selections">Novel</a>
                <a href="#guidebook" class="selections">Guidebook</a>
                </div>
            </div>
        </li>
        <li><a href="../../../Cart/Cart.php">CART</a></li>
    </ul>
</header>


<!--这里是品牌头-->
<p><br><br><br><br></p>
<section class="slogan">
    <img src="bookshelf.png">
</section>


<!--这里是书籍展示-->

<!--这里是儿童读物-->
<p id="picturebook"><br><br><br><br>
<h3 class="desc_h3">PICTURE BOOK</h3>
<p class="desc_p">Teaching a toddler is a challenge, since the wisest sentence coming out from a toddler’s mouth is either “Gugugaga” or “Gagageegee”. But fear not, a picture book with colourful illustrations and basic vocabulary is all you need! Let them become Einstein from a young age! </p> 

<section class="book">
    <div class="picturebook">
    <div>
    <?php 
    $sql = "SELECT * FROM booklist WHERE Category='Picture Book'";
    $result = mysqli_query($connect, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div>';
            echo '<img src="'.$row["BookIMG"].'" alt="'.$row["Book_Name"].'">';
            echo '<h3>'.$row["Book_Name"].'</h3>';
            echo '<p>$'.$row["Price"].'</p>';
            echo '<a class="view" href="BookDetail.php?id='.$row["id"].'"><button class="button type1"><span class="cart-txt">View Details</span></button></a>';
            echo '</div>';
        }
    } else {
        echo "No books found.";
    }
    ?>
    </div> 
    </div>
</section>

<!--这里是小说-->
<p id="novel"><br><br><br><br></p>
    <h3 class="desc_h3">NOVEL</h3>
    <p class="desc_p">Imagine diving into the world of a novel. It's like embarking on an epic adventure without ever leaving your chair. Whether you're uncovering secrets in a mystery, exploring distant galaxies in sci-fi, or falling in love in a romance, a novel lets your mind explore endless possibilities.</p> 

<section class="book">
    <div class="novel">
    <div>
    <?php 
    $sql = "SELECT * FROM booklist WHERE Category='Novel'";
    $result = mysqli_query($connect, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div>';
            echo '<img src="'.$row["BookIMG"].'" alt="'.$row["Book_Name"].'">';
            echo '<h3>'.$row["Book_Name"].'</h3>';
            echo '<p>$'.$row["Price"].'</p>';
            echo '<a class="view" href="BookDetail.php?id='.$row["id"].'"><button class="button type1"><span class="cart-txt">View Details</span></button></a>';
            echo '</div>';
        }
    } else {
        echo "No books found.";
    }
    ?>
    </div> 
    </div> 
</section>

<!--这里是教材书-->
    <p id="guidebook"><br><br><br><br></p>
    <h3 class="desc_h3">GUIDEBOOK</h3>
    <p class="desc_p">When it comes to mastering a new skill or hobby, nothing beats a guidebook. Think of it as your personal mentor, patiently walking you through each step with clear instructions and helpful tips. Whether you're looking to cook gourmet meals, build a birdhouse, or start a garden, a guidebook provides you with the knowledge and confidence to succeed. </p> 

<section class="book">
    <div class="guidebook">
    <div>
    <?php 
    $sql = "SELECT * FROM booklist WHERE Category='Guidebook'";
    $result = mysqli_query($connect, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div>';
            echo '<img src="'.$row["BookIMG"].'" alt="'.$row["Book_Name"].'">';
            echo '<h3>'.$row["Book_Name"].'</h3>';
            echo '<p>$'.$row["Price"].'</p>';
            echo '<a class="view" href="BookDetail.php?id='.$row["id"].'"><button class="button type1"><span class="cart-txt">View Details</span></button></a>';
            echo '</div>';
        }
    } else {
        echo "No books found.";
    }
    ?>
    </div> 
    </div> 
</section>

    
</body>
</html>