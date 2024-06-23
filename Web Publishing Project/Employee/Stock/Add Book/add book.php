<?php include('../../../connection.php');

 if(isset($_POST['submitbtn'])){
    $bn = $_POST['bName'];
    $bA = $_POST['bAuthor'];
    $bP = $_POST['bPublisher'];
    $bp = $_POST['bPrice'];
    $bC = $_POST['bType'];
    $bIMG = $_Files['image']['name'];
    $bIMG_temp_name = $_Files['image']['tmp_name'];
    $bIMG_folder = '../../../images/'.$bIMG;

    $insert_query = mysqli_query($connect, "INSERT INTO booklist(Book_Name, Price, Author, Publisher, BoookIMG, Catagory) VALUES ('$bn', $bp, '$bA', '$bP', '$bIMG', '$bC')");
    if($insert_query){
        move_uploaded_file($bIMG_temp_name, $bIMG_folder);
        $display_message="Book Added Sucessfully";
    }else{
        $display_message="There is some error on your item";
    }
 }




?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Add New Book</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="add book.css">
    </head>

    <body>
        <button class="backtoStock"><a href="../stock.php">back</a></button>
        <fieldset>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <h1 class="header">Add New Book</h1>
                    <tr class="book">
                        <table>
                        <td class="bImg">Book Image:
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
                        <td class="bName" name="bName">Book Name:</td>
                        <td><input type="text" required></td>
                    </tr>
                    <tr class="book">
                        <td class="bAuthor" name="bAuthor">Author:</td>
                        <td><input type="text"required></td>
                    </tr>
                    <tr class="book">
                        <td class="bPublisher" name="bPublisher">Publisher:</td>
                        <td><input type="text" required></td>
                    </tr>
                    <tr class="book">
                        <td class="bPrice">Price:</td>
                        <td><input type="number" name="bPrice" min="0.00" step="5.00" required></td>
                        <td class="submitBtn"><button type="submit" name="submitbtn">Submit</button>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>

    </body>