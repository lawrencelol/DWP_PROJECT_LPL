<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Contact Us Page</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Contact.css">
    </head> 

    <body>

        <header>
            <img src="logo.png" >
            <p>Contact Us</p>
                <ul>
                    <li><a href="../../My Profile/About Us/About_Us_Page.php">< Back To About Us</a></li>
                    <li><a href="../../My Profile/User Profile/userprofile.php">< Back To My Profile</a></li>
                </ul>
        </header>

        <fieldset class="userdata">
            <form name="userdata">
                <table>
                    <th>Thank You for visiting our website. For any enquiries, please leave your message here.</th>
                    <tr class="user">
                        <td class="name"><img src="User.png">Full name<span class="required"> *</span>: </td>
                        <td><input type="text" required></td>
                    </tr>
                    <tr class="user">
                        <td class="tel"><img src="Phone.png">Contact Number: </td>
                        <td><input type="tel" maxlength="12" oninput="formatTel(this)"></td>
                    </tr>
                    <tr class="user">
                        <td class="email_user"><img src="Email.png">Email<span class="required"> *</span>: </td>
                        <td><input type="email" required></td>
                    </tr>
                    <tr class="user">
                        <td class="message"><img src="Message.png">Message<span class="required"> *</span>: </td>
                        <td><textarea name="message" rows="5" required></textarea></td>
                    </tr>
                    <tr>
                        <td class="button" colspan="2">
                            <button type="submit"><b>SUBMIT</b></button>
                            <button type="reset"><b>RESET</b></button>
                        </td>
                    </tr>
                </table>
            <form>
        </fieldset>        

        <footer>
            <fieldset class="information">
                <div class="table">
                    <table class="information">
                        <thead>
                            <tr>
                                <th class="contact">Contact Number :</th>
                                <th class="email">Email Address :</th>
                                <th class="officeH">Office Hours :</th>                                
                            </tr>
                        </thead>
                            <footer>
                                <td>012-9375625</td>
                                <td class="email"><a href="lplbookstore@gmail.com">lplbookstore@gmail.com</a></td>
                                <td>Monday - Friday 9.00 am - 5.00 pm</td>
                            </footer>
                    </table>
                </div>
            </fieldset>
        </footer>


        <script>         
            function formatTel(input)
            {
                var tel = input.value.replace(/\D/g, '');

                if (tel.length>3)
                    tel = tel.slice(0,3)+ '-' +tel.slice(3);

                input.value = tel;
            }
            function resetForm() 
            {
                document.getElementById("userdata").reset();
            }
        </script>
    </body>
</html>