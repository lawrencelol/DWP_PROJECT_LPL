<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTP-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <title>Add New Book</title>
        <link href="" rel="stylesheet">
        <link rel="stylesheet" href="add book.css">
    </head>

    <body>
        <button class="backtoStock"><a href="../stock.html">back</a></button>
        <fieldset>
            <form>
                <h1 class="header">Add New Book</h1>
                <table>
                    <tr class="book">
                        <td class="bImg">Book Image:
                        <td><input type="file" name="image" required></td>
                    </tr>
                    <tr class="book">
                        <td class="bType">Type of book:</td>
                        <td>
                            <select name="bType">
                                <option value="GuideB">Guide Book</option>
                                <option value="novel">Novel</option>
                                <option value="pictureB">Picture Book</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="book">
                        <td class="bName">Book Name:</td>
                        <td><input type="text" required></td>
                    </tr>
                    <tr class="book">
                        <td class="bAuthor">Author:</td>
                        <td><input type="text"required></td>
                    </tr>
                    <tr class="book">
                        <td class="bPublisher">Publisher:</td>
                        <td><input type="text" required></td>
                    </tr>
                    <tr class="book">
                        <td class="bPrice">Price:</td>
                        <td><input type="number" name="bPrice" min="0.00" step="5.00" required></td>
                        <td class="submitBtn"><button type="submit">Submit</button>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>

    </body>