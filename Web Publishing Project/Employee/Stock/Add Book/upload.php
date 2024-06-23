<?php 
include_once('../../../connection.php');

if (isset($_POST['submitbtn']))
{
    $bn = $_POST['bName']; 
    $bA = $_POST['bAuthor'];
    $bP = $_POST['bPublisher'];
    $bp = $_POST['bPrice'];
    $bC = $_POST['bType'];
    $filename = $_FILES['image']['bN ame'];

    switch($bC)
    {
        case "GuideB": $BC = Guide Book break;
        case "novel": $BC = Novel break;
        case "pictureB": $BC = Picture Book break;
    }

    mysqli_query($connect, "INSERT INTO booklist (Book_Name, Price, Author, Publisher, BookIMG, Category VALUES ('$bn', $bp, '$bA', '$bP', '$filename', '$BC')" )
}

?>
