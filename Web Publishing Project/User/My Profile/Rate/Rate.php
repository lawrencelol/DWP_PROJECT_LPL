<?php
include('../../../connection.php');

if (isset($_POST['submit_btn'])) {
    $userEmail = $connect->real_escape_string($_POST['userEmail']);
    $comment = $connect->real_escape_string($_POST['comment']);
    $ratedIndex = $connect->real_escape_string($_POST['ratedIndex']);
    $ratedIndex++;
    $rateDate = date('Y-m-d');

    // Fetch user ID based on the provided email
    $userResult = $connect->query("SELECT id FROM user_register WHERE email='$userEmail'");
    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();
        $userID = $userData['id'];

        if ($connect->query("INSERT INTO ratingreview (user_id, Rating, UserEmail, Comment, Rate_Date) VALUES ('$userID', '$ratedIndex', '$userEmail', '$comment', '$rateDate')")) {
            $sql = $connect->query("SELECT RateID FROM ratingreview ORDER BY RateID DESC LIMIT 1");
            $uData = $sql->fetch_assoc();
            $uID = $uData['RateID'];

            echo json_encode(array('status' => 'success', 'id' => $uID));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'User not found'));
    }
    exit;
}
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
    <form action="" class="rating-frm">
        <div class="rating">
            <input type="number" name="rating" hidden value="0">
            <i class='bx bx-star star' data-index="0"></i>
            <i class='bx bx-star star' data-index="1"></i>
            <i class='bx bx-star star' data-index="2"></i>
            <i class='bx bx-star star' data-index="3"></i>
            <i class='bx bx-star star' data-index="4"></i>
        </div>

        <label for="userEmail">User Email</label>
        <textarea name="userEmail" id="userEmail" cols="30" row="1" placeholder="Type your email here..."></textarea>

        <label for="comment">Your Comment:</label>
        <textarea name="comment" id="comment" cols="30" rows="5" placeholder="Type your comment here..."></textarea>

        <div class="btn">
            <button type="button" class="submit_btn">Submit</button>
            <button type="button" class="cancel" onclick="history.back();">Cancel</button>
        </div>
    </form>
</section>

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
            setStars(ratedIndex);
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

        $('.submit_btn').on('click', function() {
            saveToDB();
        });

        function setStars(max) {
            $('.bx-star').css('color', 'gray');
            for (var i = 0; i <= max; i++)
                $('.bx-star:eq(' + i + ')').css('color', 'yellow');
        }

        function saveToDB() {
            var userEmail = $('#userEmail').val();
            var comment = $('#comment').val();

            $.ajax({
                url: "",
                method: "POST",
                dataType: 'json',
                data: {
                    submit_btn: 1,
                    userEmail: userEmail,
                    comment: comment,
                    ratedIndex: ratedIndex
                },
                success: function (response) {
                    if (response.status == 'success') {
                        uID = response.id;
                        localStorage.setItem('uID', uID);
                        alert("Thanks for Rating!!!");
                        location.reload(); // Reload the page after successful submission
                    } else {
                        alert("Data Not Saved: " + response.message);
                    }
                },
                error: function() {
                    alert("Thanks for Rating!!!!!");
                    location.reload();
                }
            });
        }
    });
</script>

<footer>
</footer>
</body>
</html>
<!--  -->
