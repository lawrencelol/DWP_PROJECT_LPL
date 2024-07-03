<?php
    session_start();
    include('connection.php');

    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $result = mysqli_query($connect, $query);

    if (!$result) 
    {
        echo "Error: " . mysqli_error($connect);
        exit();
    }

    $isCartEmpty = mysqli_num_rows($result) === 0;

    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $cartID = $_GET['id'];
        mysqli_begin_transaction($connect);
        try 
        {
            $deleteCartQuery = "DELETE FROM cart WHERE CartID = '$cartID'";
            if (!mysqli_query($connect, $deleteCartQuery)) 
            {
                throw new Exception("Error deleting item: " . mysqli_error($connect));
            }
            mysqli_commit($connect);
            header("Location: cart.php");
            exit();

        } 
        catch (Exception $exception) 
        {
            mysqli_rollback($connect);
            echo $exception->getMessage();
            exit();
        }
    }

    $subTotal = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $receiver_name = mysqli_real_escape_string($connect, $_POST['receiver_name']);
        $receiver_email = mysqli_real_escape_string($connect, $_POST['receiver_email']);


        $userQuery = "SELECT username FROM user_register WHERE id = '$user_id'";
        $userResult = mysqli_query($connect, $userQuery);
        if (!$userResult)
        {
            echo "Error fetching username: " . mysqli_error($connect);
            exit();
        }

        $row = mysqli_fetch_assoc($userResult);
        $username = $row['username'];

        mysqli_begin_transaction($connect);
        try 
        {
            $order_date = date('Y-m-d H:i:s'); 
            mysqli_data_seek($result, 0);

            while ($row = mysqli_fetch_assoc($result)) 
            {
                $insert_query = "INSERT INTO orders (user_id, username, email, order_date, Book_Name, Price, receiver_name, receiver_email, Category) VALUES ('$user_id', '$username', '$receiver_email', '$order_date', '{$row['Book_Name']}', '{$row['Price']}', '$receiver_name', '$receiver_email', '{$row['Category']}')";
                echo "<script>alert('Payment successful.');</script>";
                if (!mysqli_query($connect, $insert_query)) 
                {
                    throw new Exception("Error placing order: " . mysqli_error($connect));
                }
            }

            $deleteCartQuery = "DELETE FROM cart WHERE user_id = '$user_id'";
            if (!mysqli_query($connect, $deleteCartQuery)) 
            {
                throw new Exception("Error deleting cart items: " . mysqli_error($connect));
            }

            mysqli_commit($connect);

            header("Location: ../Total/Total.php");
            exit();
        }
        catch (Exception $exception)
        {
            mysqli_rollback($connect);
            echo $exception->getMessage();
            exit();
        }
    }

    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="" rel="stylesheet">
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo">
        <p>Cart</p>
        <ul>
            <li><a href="../../User/Main Page/Main_Page/index.php">Back To Home</a></li>
            <li><a href="../Menu/Books/Display/BookDisplay.php">Back To Bookshelf</a></li>
        </ul>
    </header>

    <br><br><br><br><br>
    <fieldset>
        <div>
            <h1 class="header">SHOPPING CART<img src="cart.png" alt="cart"></h1>
            <hr>
        </div>
        <div class="table">
            <table>
                <thead>
                    <th>No.</th>
                    <th class="bImg"><b>Image</b></th>
                    <th class="bName"><b>Book Name</b></th>
                    <th class="bPrice"><b>Price</b></th>
                    <th class="delBook"></th>
                </thead>
                <?php
                $subTotal = 0;
                $count = 1;

                if ($isCartEmpty) {
                    echo "<tr>";
                    echo "<td colspan='5' style='text-align:center;'>Your shopping cart is empty.</td>";
                    echo "</tr>";
                } else {
                    mysqli_data_seek($result, 0);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $subTotal += $row['Price'];
                        echo "<tr>";
                        echo "<td class='no'>{$count}.</td>";
                        echo "<td class='bImg'><img src='../../images/{$row['Book_Name']}.png' alt='book'></td>";
                        echo "<td class='bName'>{$row['Book_Name']}</td>";
                        echo "<td class='bPrice'>RM {$row['Price']}</td>";
                        echo "<td class='delBook'><button class='delBook'><a class='delBook' href='cart.php?action=delete&id={$row['CartID']}'>X</a></button></td>";
                        echo "</tr>";
                        $count++;
                    }
                }
                ?>
            </table>
            <hr>
            <div class="subTotal">
                <p><b>Total:</b><span id="subtotal">RM <?php echo number_format($subTotal, 2); ?></span></p>
            </div>
            <hr>
        </div>
        <button class="payment"><a href="#popup">Proceed to Payment</a></button>
        <div class="popup" id="popup">
            <div class="close">&times;</div>
            <form class="info" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-container">
                    <div class="info">
                        <div class="receiverInfo">
                            <label class="header">RECEIVER INFO</label>
                            <label>Full Name: </label>
                            <input type="text" name="receiver_name" required>
                            <label>Email: </label>
                            <input type="email" name="receiver_email" placeholder="example@gmail.com" required>
                        </div>
                        <div class="paymentInfo">
                            <label class="header">PAYMENT</label>
                            <label>Accepted Cards: </label>
                            <div class="paymentMethod">
                                <img src="master.png" alt="master"><img src="visa.png" alt="visa"><img src="paypal.png" alt="paypal">
                            </div>
                            <label>Name of Card Holder: </label>
                            <input type="text" name="card_holder_name" required>
                            <label>Credit Card Number: </label>
                            <input type="text" name="card_number" maxlength="17" required>
                            <label>Expired Year: </label>
                            <input type="number" name="expiry_year" min="2024" max="2050" required>
                            <label>Expired Month: </label>
                            <input type="number" name="expiry_month" min="1" max="12" required>
                            <label>CVV: </label>
                            <input type="text" name="cvv" maxlength="3" required>
                            <input type="hidden" name="selected_items[]" value="<?php echo $row['CartID']; ?>">
                            <button type="submit" class="submit" value="proceedToPayment">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>
</body>
    <script>
        var cartItemCount = <?php echo $count; ?>;
        if (cartItemCount != 0)
        {
            document.querySelector(".payment").addEventListener("click", function()
            {
                document.querySelector(".popup").classList.add("active");
            });      
            document.querySelector(".popup .close").addEventListener("click", function() 
            {
                document.querySelector(".popup").classList.remove("active");
            });
        }
    </script>
</html>
