<?php
include('../../../connection.php');

//GET DATA
if (isset($_POST['submit_btn'])){
    $rating = $_POST['rating']; 
    $username = $_POST['username']; 
    $comment = $_POST['comment'];

    //INSERT DATA TO TABLE
    $sql = "INSERT INTO ratingreview (Rating, username, Comment) VALUES (?,?,?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("iss", $rating, $username, $comment);
    $stmt->execute();

    if ($stmt->affected_rows > 0){
       ?>
        <script type="text/javascript"> alert ('Data Saved Successfully');</script>
        <?php
    }else{
       ?>
        <script type="text/javascript"> alert ('Error: <?php echo $connect->error;?>');</script>
        <?php
    }
    $stmt->close();
}

$connect -> close();
?>