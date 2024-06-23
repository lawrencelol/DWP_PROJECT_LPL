<?php
include('../../../connection.php');

if(isset($_POST['submitbtn'])){
    $bn = $_POST['bName'];
    $bA = $_POST['bAuthor'];
    $bP = $_POST['bPublisher'];
    $bp = $_POST['bPrice'];
    $bC = $_POST['bType'];
    $bIMG = $_FILES['image']['name'];
    $bIMG_temp_name = $_FILES['image']['tmp_name'];
    $bIMG_folder = '../../../images/'.$bIMG;

    switch($bC)
    {
        case "GuideB":
            $BC = "Guide Book";
            break;
        case "novel":
            $BC = "Novel";
            break;
        case "pictureB":
            $BC = "Picture Book";
            break;
        default:
            $BC = "Unknown";
            break;
    }

    $insert_query = mysqli_query($connect, "INSERT INTO booklist (Book_Name, Price, Author, Publisher, BookIMG, Category) VALUES ('$bn', $bp, '$bA', '$bP', '$bIMG', '$BC')");

    if($insert_query){
        move_uploaded_file($bIMG_temp_name, $bIMG_folder);
        $display_message = " Added Successfully";
    } else {
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
if(isset($display_message)){
?>
    <script type="text/javascript">alert("<?php echo "$bn". "$display_message"?>")</script>
    <?php
}
         
?>

            <h1 class="header">Add New Book</h1>
            <table>
                <tr class="book">
                    <td class="bImg">Book Image:</td>
                    <td><input type="file" name="image" required></td>
                </tr>
                <tr class="book">
                    <td class="bType">Type of book:</td>
                    <td>
                        <select name="bType">
                            <option value="GuideB">Guide Book</option>
                            <option value="novel">Novel</option>
                            <option value="pictureB">Picture Book</option>
                        </select>
                    </td>
                </tr>
                <tr class="book">
                    <td class="bName">Book Name:</td>
                    <td><input type="text" name="bName" required></td>
                </tr>
                <tr class="book">
                    <td class="bAuthor">Author:</td>
                    <td><input type="text" name="bAuthor" required></td>
                </tr>
                <tr class="book">
                    <td class="bPublisher">Publisher:</td>
                    <td><input type="text" name="bPublisher" required></td>
                </tr>
                <tr class="book">
                    <td class="bPrice">Price:</td>
                    <td><input type="number" name="bPrice" min="0.00" step="1.00" required></td>
                </tr>
                <tr class="book">
                    <td class="submitBtn" colspan="2"><button type="submit" name="submitbtn">Submit</button></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>