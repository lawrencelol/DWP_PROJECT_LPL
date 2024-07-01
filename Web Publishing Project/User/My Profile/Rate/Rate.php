<?php 
include('../../../connection.php');

    if (isset($_POST['submit_btn'])) {
        $uID = $connect->real_escape_string($_POST['uID']);
        $username = $_POST['username'];
        $comment = $_POST['comment'];
        $ratedIndex = $connect->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;

        $connect->query("INSERT INTO ratingreview (Rating, username, Comment) VALUES ('$ratedIndex','$username','$comment');");
        $sql = $connect->query("SELECT RateID FROM ratingreview ORDER BY RateID DESC LIMIT 1");
        $uData = $sql->fetch_assoc();
        $uID = $uData['RateID'];

        exit(json_encode(array('id' => $uID)));
    }

    // AVARAGE CALCULATE IF NEEDED
    // $sql = $connect->query(query: "SELECT id FROM ratingreview");
    // $numR = $sql -> num_rows;
    
    // $sql = $connect->query(query: "SELECT SUM(rateIndex) As total FROM ratingreview");
    // $rDate = $sql -> fetch_array();
    // $total = $rData['total'];

    // $avg = $total/ $numR;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Us</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Rate.css">
</head>
<body>

<header>
    <img src="logo.png" alt="Logo">
    <p>Rate Us</p>
    <ul>
        <li><a href="../../My Profile/About Us/About_Us_Page.php">< Back To About Us</a></li>
        <li><a href="../../My Profile/User Profile/userprofile.php">< Back To My Profile</a></li>
    </ul>
</header>

<section>
    <form action="" class="rating-frm" >
        <div class="rating">
            <input type="number" name="rating" hidden value="0">
            <i class='bx bx-star star' data-index="0"></i>
            <i class='bx bx-star star' data-index="1"></i>
            <i class='bx bx-star star' data-index="2"></i>
            <i class='bx bx-star star' data-index="3"></i>
            <i class='bx bx-star star' data-index="4"></i>
        </div>

        <label for="username">Username</label>
        <textarea name="username" id="username" placeholder="Type your username here..."></textarea>

        <label for="comment">Your Comment:</label>
        <textarea name="comment" id="comment" cols="30" rows="5" placeholder="Type your comment here..."></textarea>

        <div class="btn">
            <button type="button" class="submit_btn" >Submit</button>
            <button type="button" class="cancel" onclick="history.back();">Cancel</button>
        </div>
    </form>
</section>

<script src="rate.js"></script>
    
    <!-- Star rate number -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        var ratedIndex = -1, uID = 0;

        $(document).ready(function () {
    if (localStorage.getItem('ratedIndex') != null) {
        ratedIndex = parseInt(localStorage.getItem('ratedIndex'));
        uID = localStorage.getItem('uID');
        setStars(ratedIndex);
    }

    $('.bx-star').on('click', function () {
        ratedIndex = parseInt($(this).data('index'));
        localStorage.setItem('ratedIndex', ratedIndex);
        saveToDB();
    });

    $('.bx-star').mouseover(function () {
        var currentIndex = parseInt($(this).data('index'));
        setStars(currentIndex);
    });

    $('.bx-star').mouseleave(function () {
        if (ratedIndex != -1)
            setStars(ratedIndex);
        else
            setStars(-1);
    });

    function setStars(max) {
        $('.bx-star').css('color', 'gray');
        for (var i = 0; i <= max; i++)
            $('.bx-star:eq(' + i + ')').css('color', 'yellow');
    }
});

function saveToDB() {
    $.ajax({
        url: "Rate.php",
        method: "POST",
        dataType: 'json',
        data: {
            submit_btn: 1,
            uID: uID,
            ratedIndex: ratedIndex
        },
        success: function (r) {
            uID = r.id;
            localStorage.setItem('uID', uID);
        }
    });
}

    </script>
<footer>
</footer>

</body>
</html>
