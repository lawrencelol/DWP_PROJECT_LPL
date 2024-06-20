<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Emp_Category</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="Category.css"> 
    </head>

    <body>
        <div class="selection">
            <div class="Logo">
                <img src="Logo.png" />
            </div>
            <div class="bar">
                <ul>
                    <li><a href="../Employee_Home_Page/Home_Page_EMP.php">DASHBOARD</a></li>
                    <li><a href="../Manage_Staff/Manage_Staff.php">STAFF</a></li>
                    <li><a href="../Manage_USER/Manage_USER.php">USER</a></li>
                    <li class="active"><a href="../Manage_Category/Category.php">CATEGORY</a></li>
                    <li><a href="../Stock/stock.php">STOCK</a></li>
                    <li><a href="../Manage_Order/Manage_Order.php">ORDER</a></li>
                    <li><a href="../Rate_Review/Rate_Review.php">RATE REVIEW</a></li>
                    <li><a href="../../User/Landing_Page/Landing.php">Log Out</a></li>
                </ul>
            </div>
        </div>

<fieldset>
    <div class="header">
        <h1>Book Category Management</h1>
    </div>
    <section class="table">
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Total of Book</th>
                        <th>Added Date</th>
                        <th>Remove Category</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>cat1</td>
                        <td>Picture Book</td>
                        <td>3</td>
                        <td>1 January, 2024</td>
                        <td><button type="delCat">-</button></td>
                    </tr>
                    <tr>
                        <td>cat2</td>
                        <td>Novel</td>
                        <td>3</td>
                        <td>1 January, 2024</td>
                        <td><button type="delCat">-</button></td>
                    </tr>
                    <tr>
                        <td>cat3</td>
                        <td>Guidebook</td>
                        <td>4</td>
                        <td>1 January, 2024</td>
                        <td><button type="delCat">-</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <button class="add">Add new category</button>
    <div class="popup">
        <div class="close">&times;</div>
        <div class="form">
            <h3>New Category Details</h3>
            <div class="info">
                <label for="id">ID</label>
                <input type="text" id="id" placeholder="Enter Category ID">
                <label for="catname">Category Name</label>
                <input type="text" id="catname" placeholder="Enter Category Name">
                <label for="book">Total of Books</label>
                <input type="number" id="book" min="1" placeholder="Enter Total Number of Books">
                <label for="date">Date Added</label>
                <input type="date" id="date" placeholder="Enter Added Date">
                <button class="add">Add</button>
            </div>
        </div>
    </div>
</fieldset>

<script>
    document.querySelector(".add").addEventListener("click", function(){document.querySelector(".popup").classList.add("active");});
    document.querySelector(".popup .close").addEventListener("click", function(){document.querySelector(".popup").classList.remove("active");})
</script>

    </body>
</html>