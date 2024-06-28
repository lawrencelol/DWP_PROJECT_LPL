<?php include('../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Stock</title>
        <link href="" rel="stylesheet">
    </head>

<script type="text/javascript">
    function confirmation()
    {
        answer = confirm("Do you want to delete the book?");
        return answer;
    }
</script>


<body>
    <?php 
        if(isset($display_message))
        {
    ?>
        <script type="delMessage/javascript">alert("<?php echo "$bn". "$display_message"?>")</script>
    <?php
        }
    ?>

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
                        <?php
                            $query = "SELECT DISTINCT Category FROM booklist ORDER BY Category ASC";
                            $result = mysqli_query($connect, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $category = $row['Category'];
                                echo '<button><a href="#' . strtolower($category) . '" class="selections">' . $category . '</a></button>';
                            }
                        ?>
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

            <?php
                mysqli_select_db($connect,"dwp_project");
                $result = mysqli_query($connect, "select * from booklist ORDER BY Category");	
                $currentType = '';

                while($row = mysqli_fetch_assoc($result))
                {		               
                    if ($currentType != $row['Category'])
                    {
                        if ($currentType != '')
                        {
                            echo '</table></div>';
                        }
                        $currentType = $row['Category'];
                        echo'<div>';  
                        echo'<h1 class="bType" id="'. strtolower($currentType) . '">' . strtoupper($currentType) . '</h1>';
                        echo'<table>';             
                        echo'<thead>
                            <tr>
                                <th class="bImg">Book Image</th>
                                <th class="bName">Book Name</th>
                                <th class="bAuthor">Author</th> 
                                <th class="bPublisher">Publisher</th>
                                <th class="bPrice">Price (RM)</th>
                                <th class="editBook"></th>
                                <th class="delBook"></th>                                   
                            </tr>
                        </thead>';

                    }
            ?>
                <tr>
                    <td><img class="bImg" src="../../images/<?php echo htmlspecialchars($row["Book_Name"]); ?>.png"?></td>
                    <td class="bName"><?php echo $row["Book_Name"]; ?></td>
                    <td class="bAuthor"><?php echo $row["Author"]; ?></td>
                    <td class="bPublisher"><?php echo $row["Publisher"]; ?></td>
                    <td class="bPrice"><?php echo $row["Price"]; ?></td>
                    <td class="editBook"><a href="connection.php?edit&book_ID=<?php echo $row['BookID'];?>">Edit</td>
                    <td class="delBook"><button class="delBook"><a href="stock.php?del&book_ID=<?php echo $row['BookID'];?>" onclick="return confirmation();">-</a></button></td>
                    </tr>
            <?php
                }
            ?>
            </table>
        </div>
    </fieldset>
</body>
</html>
<?php
if (isset($_GET["del"]) && isset($_GET["book_ID"]))
{
    $book_ID = $_GET["book_ID"];

    $result = mysqli_query($connect, "SELECT Book_Name FROM booklist WHERE BookID = '$book_ID'");
    $row = mysqli_fetch_assoc($result);

    if ($row)
    {
        $book_name = $row["Book_Name"];
        $file_path = "../../images/" . $book_name . ".png";

        if (file_exists($file_path))
        {
            unlink($file_path);
            $display_message = " Deleted Successfully";
        }
        else
        {
            $display_message = " Deleted Failed";
        }

    }
}

?>
