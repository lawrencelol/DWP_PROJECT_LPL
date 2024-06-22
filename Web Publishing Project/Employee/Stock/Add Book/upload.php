<?php 
include_once('../../../connection.php');
if (isset($_POST['submitbtn']))
{
    $bn = $_POST['bName']; 
    $bA = $_POST['bAuthor'];
    $bP = $_POST['bPublisher'];
    $bp = $_POST['bPrice'];
    $bT = $_POST['bType'];
    $bC = $_POST['Category']
    $filename = $_FILES['image'];

    mysqli_query($connect, "INSERT INTO booklist(BookID, Book_Name, Price, Author, Publisher, BookIMG, Category) VALUES ('', '$bn' ,$bp ,'$bA' ,'$bP' ,'$filename' ,'$bC' ");
}

?>