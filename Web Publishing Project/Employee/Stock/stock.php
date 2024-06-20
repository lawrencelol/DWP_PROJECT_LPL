<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Stock</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Stock.css">
</head>

<body>

    <!-- tab bar -->
    <div class="selection">
        <div class="Logo">
            <img id="LogoImage" src="Logo.png" alt="Logo"/>
        </div>
        <div class="bar">
            <ul>
                <li><a href="../Employee_Home_Page/Home_Page_EMP.html">DASHBOARD</a></li>
                <li><a href="../Manage_Staff/Manage_Staff.html">STAFF</a></li>
                <li ><a href="../Manage_USER/Manage_USER.html">USER</a></li>
                <li ><a href="../Manage_Category/Category.html">CATEGORY</a></li>
                <li class="category" id="active">
                    <a href="../Stock/stock.html">STOCK</a>
                    <div class="choice" id="active">
                        <button><a href="#guidebook" class="selections">Guidebook</a></button>
                        <button><a href="#novel" class="selections">Novel</a></button>
                        <button><a href="#picturebook" class="selections">Picture Book</a></button>
                    </div>
                </li>
                <li><a href="../Manage_Order/Manage_Order.html">ORDER</a></li>
                <li><a href="../Rate_Review/Rate_Review.html">RATE REVIEW</a></li>
                <li><a href="../../User/Landing_Page/Landing.html">Log Out</a></li>
            </ul>
        </div>
    </div>

    

    <fieldset>
        <h1 class="title">LPL Book Stock</h1>
        <button class="addBook"><a href="Add Book/add book.html">New Book</a></button>

        <div>   
            <h1 class="bType" id="guidebook">GUIDE BOOK</h1>
            <table>                
                <thead>
                    <tr>
                        <th class="bImg">Book Image</th>
                        <th class="bName">Book Name</th>
                        <th class="bAuthor">Author</th> 
                        <th class="bPublisher">Publisher</th>
                        <th class="bPrice">Price (RM)</th>
                        <th class="delBook"></th>                                   
                    </tr>
                </thead>
                <tr>
                    <td><img class="book_pic"src="100 Ways To Bake.png" alt="100 Ways To Bake"></td>
                    <td class="bName">100 Ways To Bake</td>
                    <td class="bAuthor">Law Ryance</td>
                    <td class="bPublisher">Life Publisher</td>
                    <td class="bPrice">40.00</td>
                    <td><button class="delBook">-</button></td>
                </tr>
                <tr>
                    <td><img class="book_pic" src="Cook Like A PRO.png" alt="Cook Like A PRO"></td>
                    <td class="bName">Cook Like A PRO</td>
                    <td class="bAuthor">Lethew Jean</td>
                    <td class="bPublisher">Life Publisher</td>
                    <td class="bPrice">70.00</td>
                    <td><button class="delBook">-</button></td>
                </tr>
                <tr>
                    <td><img class="book_pic" src="Knit It.png" alt="Knit It"></td>
                    <td class="bName">Knit It</td>
                    <td class="bAuthor">Panzy Syin</td>
                    <td class="bPublisher">Life Publisher</td>
                    <td class="bPrice">48.00</td>
                    <td>
                        <button class="delBook">-</button>
                    </td>
                </tr>
                <tr>
                    <td><img class="book_pic" src="Know your Plants.png" alt="Know Your Plants"></td>
                    <td class="bName">Know Your Plants</td>
                    <td class="bAuthor">Wong Shelly</td>
                    <td class="bPublisher">Life Publisher</td>
                    <td class="bPrice">50.00</td>
                    <td>
                        <button type="delBook">-</button>
                    </td>
                </tr>
            </table>
        </div>
    </fieldset>


    <fieldset>
        <div>
            <h1 class="bType" id="novel">NOVEL</h1>
            <table>
                <thead>
                    <tr>
                        <th class="bImg">Book Image</th>
                        <th class="bName">Book Name</th>
                        <th class="bAuthor">Author</th> 
                        <th class="bPublisher">Publisher</th>
                        <th class="bPrice">Price (RM)</th>      
                        <th class="delBook"></th>                
                    </tr>
                </thead>
                <tr>
                    <td><img class="book_pic" src="Children Of The Star.png"></td>
                    <td class="bName">Children Of The Star</td>
                    <td class="bAuthor">Stella Drew</td>
                    <td class="bPublisher">Star Publisher</td>
                    <td class="bPrice">20.00</td>
                    <td><button class="delBook">-</button></td>
                </tr>
                <tr>
                    <td><img class="book_pic" src="My Mind Is a Mess.png"></td>
                    <td class="bName">My Mind Is a Mess</td>
                    <td class="bAuthor">Yicell L. Y. Xyan</td>
                    <td class="bPublisher">Hope Publisher</td>
                    <td class="bPrice">36.00</td>
                    <td><button class="delBook">-</button></td>
                </tr>
                <tr>
                    <td><img class="book_pic" src="Twins.png"></td>
                    <td class="bName">Twins</td>
                    <td class="bAuthor">Sherlin K.</td>
                    <td class="bPublisher">Star Publisher</td>
                    <td class="bPrice">22.00</td>
                    <td>
                        <button class="delBook">-</button>
                    </td>
                </tr>
            </table>
        </div>
    </fieldset>

    <fieldset>  
        <div>
            <h1 class="bType" id="picturebook">PICTURE BOOK</h1>
            <table>
                <thead>
                    <tr>
                        <th class="bImg">Book Image</th>
                        <th class="bName">Book Name</th>
                        <th class="bAuthor">Author</th> 
                        <th class="bPublisher">Publisher</th>
                        <th class="bPrice">Price (RM)</th>
                        <th class="delBook"></th>                                   
                    </tr>
                </thead>
                <tr>
                    <td><img class="book_pic" src="That Thing Under My Bed.png"></td>
                    <td class="bName">That Thing Under My Bed</td>
                    <td class="bAuthor">William Colin</td>
                    <td class="bPublisher">Dream Publisher</td>
                    <td class="bPrice">15.00</td>
                    <td><button class="delBook">-</button></td>
                </tr>
                <tr>
                    <td><img class="book_pic" src="Flippy.png"></td>
                    <td class="bName">Flippy The Silly Little Fish</td>
                    <td class="bAuthor">Noah Grantt</td>
                    <td class="bPublisher">Dream Publisher</td>
                    <td class="bPrice">12.00</td>
                    <td>
                        <button class="delBook">-</button>
                    </td>
                </tr>
                <tr>
                    <td><img class="book_pic" src="Me And My Pet Dinosaur.png"></td>
                    <td class="bName">Me And My Pet Dinosaur</td>
                    <td class="bAuthor">Julie May</td>
                    <td class="bPublisher">Candy Publisher</td>
                    <td class="bPrice">10.00</td>
                    <td>
                        <button class="delBook">-</button>
                    </td>
                </tr>
            </table>
        </div>
    </fieldset>

</body>