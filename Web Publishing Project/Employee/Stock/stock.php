<?php include('../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Stock</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Stock.css">
</head>

<body>

    <!-- tab bar -->
    <div class="selection">
        <div class="Logo">
            <img id="LogoImage" src="Logo.png" alt="Logo"/>
        </div>
        <div class="bar">
            <ul>
                <li><a href="../Employee_Home_Page/Home_Page_EMP.php">DASHBOARD</a></li>
                <li><a href="../Manage_Staff/Manage_Staff.php">STAFF</a></li>
                <li ><a href="../Manage_USER/Manage_USER.php">USER</a></li>
                <li ><a href="../Manage_Category/Category.php">CATEGORY</a></li>
                <li class="category" id="active">
                    <a href="../Stock/stock.php">STOCK</a>
                    <div class="choice" id="active">
                        <button><a href="#guidebook" class="selections">Guidebook</a></button>
                        <button><a href="#novel" class="selections">Novel</a></button>
                        <button><a href="#picturebook" class="selections">Picture Book</a></button>
                    </div>
                </li>
                <li><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                <li><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
            </ul>
        </div>
    </div>

    

    <fieldset>
        <h1 class="title">LPL Book Stock</h1>
        <button class="addBook"><a href="Add Book/add book.php">New Book</a></button>

        <div>   
            <h1 class="bType" id="guidebook">GUIDE BOOK</h1>
            <table>                
                <thead>
                    <tr>
                        <th class="bImg">Book Image</th>
                        <th class="bName">Book Name</th>
                        <th class="bAuthor">Author</th> 
                        <th class="bPublisher">Publisher</th>
                        <th class="bPrice">Price (RM)</th>
                        <th class="delBook"></th>                                   
                    </tr>
                </thead>
                <?php
                    mysqli_select_db($connect,"dwp_project");
                    $result = mysqli_query($connect, "select * from booklist");	
                    $count = mysqli_num_rows($result);
                    
                    while($row = mysqli_fetch_assoc($result))
                    {
                    
                ?>			
                <tr>
                    <td><img class="bImg" src="<?php echo $row["BookIMG"]; ?>"></td>
                    <td class="bName"><?php echo $row["Book_Name"]; ?></td>
                    <td class="bAuthor"><?php echo $row["Author"]; ?></td>
                    <td class="bPublisher"><?php echo $row["Publisher"]; ?></td>
                    <td class="bPrice"><?php echo $row["Price"]; ?></td>
                    <td><button class="delBook">-</button></td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </fieldset>


</body>