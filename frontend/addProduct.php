<?php include_once('./menu.php') ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <title>Add product!</title>
    <link rel="stylesheet" href="../css/addProduct.css">
</head>
<body style="background-image: linear-gradient(-45deg, yellow, lightyellow)">
    <form action="../backend/addProduct.php" method="POST" enctype="multipart/form-data" style="padding-left:40%;">
        <img src="../img/logo.png" alt="logo" style="width: 15%">
        <div class="formular"">
            <div>
                <label for="productName"><b>Juice name: </b></label>
                <input type="text" id="productName" placeholder="product name" name="productName" required>
            </div>

            <div>
                <label for="flavor"><b>Flavors: </b></label>
                <input type="text" id="productFlavours" placeholder="flavour1, flavour2, ..." name="flavours" required>
            </div>

            <div>
                <label for="price"><b>Price: </b></label>
                <input type="number" id="price" placeholder="price" name="price" required>
            </div>

            <div>
                <label for="sour"><b>Sour </b></label>
                <input type="checkbox" id="sour" name="sour">
            </div>

            <div>
                <label for="file"><b>Photo </b></label>
                <input type="file" id="file" name="file">
            </div>

            <div>
                <label for="quantity"><b>Initial quantity: </b></label>
                <input type="number" id="quantity" name="quantity" min="50" required>
            </div>

        </div>
        <div>
            <button type="submit" name="submit">Submit</button>
            <a class="cancelButton" href="index.php">Cancel</a>
        </div>
    </form>
</body>
</html>

