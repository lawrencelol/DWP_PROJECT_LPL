<?php include('../../connection.php')?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Shopping Cart</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="cart.css">
    </head>

<body>
    <header>
        <img src="logo.png" >
            <p>Cart</p>
                <ul>
                    <li><a href="../../User/Main Page/Main_Page/index.php">Back To Home</a></li>
                    <li><a href="../Menu/Books/Display/BookDisplay.php">Back To Bookshelf</a></li>
                </ul>
    </header>

    <br><br><br><br><br>
    <fieldset>
        <div>
            <h1 class="header">Shopping Cart<img src="cart.png" alt="cart"></h1>
            <hr>
            <table class="book">
                <thead>
                    <tr class="head">
                        <th class="cbox"><input type="checkbox"></th>
                        <th class="no">No.</th>
                        <th class="bImg">Book Image</th>
                        <th class="bName">Book Name</th>
                        <th class="price">Price (RM)</th>
                        <th class="del"></th>   
                    </tr>               
                </thead>

                <tr class="book">
                    <td class="cbox"><input type="checkbox"></td>
                    <td class="no">01.</td>
                    <td class="bImg"><img src="Children Of The Star.png" alt="book"></td>
                    <td class="bName">Children of The Star</td>
                    <td class="price">20.00</td>
                    <td class="del"><button type="button">-</button></td>
                </tr>
                <tr class="book">
                    <td class="cbox"><input type="checkbox"></td>
                    <td class="no">02.</td>
                    <td class="bImg"><img src="Flippy.png" alt="book"></td>
                    <td class="bName">Flippy</td>
                    <td class="price">15.00</td>
                    <td class="del"><button type="button">-</button></td>
                </tr>
                <tr class="book">
                    <td class="cbox"><input type="checkbox"></td>
                    <td class="no">03.</td>
                    <td class="bImg"><img src="Me and My Pet Dinosaur.png" alt="book"></td>
                    <td class="bName">Me and My Pet Dinosaur</td>
                    <td class="price">10.00</td>
                    <td class="del"><button type="button">-</button></td>
                </tr>        
            </table>
        </div>
        <br><hr>
        <h1 class="subTotal">Sub Total: RM 45.00</h1>
        <hr><br><br> 
        <button class="payment"><a href="#popup">Proceed to Payment</a></button>
        <div class="popup" id="popup">
            <div class="close">&times;</div>
                <div class="form">       
                    <form class="info">
                        <label class="header">RECEIVER INFO</label>
                        <label class="name">Full Name: </label>
                        <div class="fullName" required>
                            <select>
                                <option value="gender">Mr. </option>
                                <option value="gender">Mrs. </option>
                            </select>
                            <input class="name" type="text">
                        </div>
                        <label>Contact Number: </label>
                        <input type="tel" maxlength="12" oninput="formatTel(this)" required>
                        <label>Email: </label>
                        <input type="email" placeholder="example@example.com" required>   
                    </form>
                </div>
                <div class="payment">
                    <form class="paymentInfo">
                        <label class="header">PAYMENT</label>
                        <label>Accepted Cards: </label>
                        <div class="paymentMethod">
                            <img src="master.png" alt="master"><img src="visa.png" alt="visa"><img src="paypal.png" alt="paypal">
                        </div>
                        <label>Card Holder: </label>
                        <input type="text" required>
                        <label>Credit Card Number: </label>
                        <input type="text" maxlength="17" required>
                        <label>Expired Year: </label>
                        <input type="number" min="2024" max="2050" required>
                        <label>Expired Month: </label>
                        <input type="number" min="1" max="12" required>
                        <label>CVV: </label>
                        <input type="number" required>
                    </form>
                    <br>
                </div>
            <button class="submit"><a href="../Total/Total.php">Submit</a></button>
        </div>

    </fieldset>
    
    <script>
        document.querySelector(".payment").addEventListener("click", function() {
            document.querySelector(".popup").classList.add("active");
        });
        document.querySelector(".popup .close").addEventListener("click", function() {
            document.querySelector(".popup").classList.remove("active");
        });

        function formatTel(input)
            {
                var tel = input.value.replace(/\D/g, '');

                if (tel.length>3)
                    tel = tel.slice(0,3)+ '-' +tel.slice(3);

                input.value = tel;
            }
    </script>
    
</body>

</html>