<?php
include('../../../connection.php');

if(isset($_POST['submitbtn']))
{
    $bn = $_POST['bName'];
    $bA = $_POST['bAuthor'];
    $bP = $_POST['bPublisher'];
    $bS = $_POST['bSynopsis'];
    $bp = $_POST['bPrice'];
    $bC = $_POST['bType'];

    $sanitized_bName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $bn);
    $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $bIMG = $sanitized_bName . '.png';
    $bIMG_folder = '../../../images/'.$bIMG;
    $insert_query = mysqli_query($connect, "INSERT INTO booklist (Book_Name, Price, Author, Publisher, Synopsis, BookIMG, Category) VALUES ('$bn', $bp, '$bA', '$bP', '$bS', '$bIMG', '$bC')");
    
    if($insert_query)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $bIMG_folder);
        $display_message = " Added Successfully";
    }
    else
    {
        $display_message = " Adding Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link href="'https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'" rel="stylesheet">
    <link rel="stylesheet" href="add book.css">

</head>
<body>
    <button class="backtoStock"><a href="../stock.php">Back</a></button>
    <fieldset>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- message display -->
            <?php 
                if(isset($display_message))
                {
            ?>
            <script type="text/javascript">alert("<?php echo "$bn". "$display_message"?>")</script>
            <?php
                }
            ?>

            <h1>ADD NEW BOOK</h1>
            <table>
                <tr class="bImg">
                    <th class="bImg">Book Image:</th>
                    <td><input type="file" name="image" required></td>
                </tr>
                <tr class="bType">
                    <th class="bType">Category:</th>
                    <td>
                        <select name="bType">
                            <?php
                                $query = "SELECT * FROM book_category ORDER BY CategoryName ASC";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    echo '<option value="' . $row['CategoryName'] . '">' . $row['CategoryName'] . '</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="bName">Book Name:</th>
                    <td><input type="text" name="bName" required></td>
                </tr>
                <tr>
                    <th class="bAuthor">Author:</th>
                    <td><input type="text" name="bAuthor" required></td>
                </tr>
                <tr>
                    <th class="bPublisher">Publisher:</t>
                    <td><input type="text" name="bPublisher" required></td>
                <tr>
                    <th class="bPrice">Price:</th>
                    <td><input type="number" name="bPrice" min="0" max="200" placeholder="RM 0.00" required></td>
                </tr>
                <tr>
                    <th class="bSynopsis">Synopsis:</th>
                    <td><textarea name="bSynopsis" rows="2" required></textarea></td>
                </tr>
                </tr>
            </table>
            <label class="submitBtn"><button type="submit" name="submitbtn">Submit</button></label>
        </form>
    </fieldset>

</body>
</html>