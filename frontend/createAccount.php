<?php include_once ('../backend/createAccount.php'); ?>
<!DOCTYPE html>
<html lang="ro">
    <head>
        <title>Create Account</title>
        <link rel="stylesheet" href="../css/createAccount.css">
    </head>
    <body class="mainBody" style="background-image: linear-gradient(-45deg, yellow, lightyellow)">

        <img src="../img/logo.png" alt="logo" id="logo" class="logo" style="width:15%; padding-left:36%;">

        <form action="createAccount.php" method="POST" style="padding-left:15%">
            <div class="formular">
                <div>
                    <label for="email"><strong>Email: </strong></label>
                    <input type="text" id="email" placeholder="email address" name="emailAddress" required>
                </div>
        
                <div>
                    <label for="firstName"><strong>First name: </strong></label>
                    <input type="text" id="firstName" placeholder="first name" name="firstName" required>
                </div>

                <div>
                <label for="lastName"><strong>Last name: </strong></label>
                <input type="text" id="lastName" placeholder="last name" name="lastName" required>
                </div>

                <div>
                    <label for="password"><strong>Password: </strong></label>
                    <input type="password" id="password" placeholder="password" name="password" required>
                </div>

                <div>
                    <label for="repeatPassword"><strong>Repeat password: </strong></label>
                    <input type="password" id="repeatPassword" placeholder="repeat password" name="repeatPassword" required>
                </div>

                <div>
                    <label for="address"><strong>address</strong></label>
                    <input type="text" id="address" placeholder="address" name="address" required>
                </div>
            </div>
            <div class="buttons">
                <button type="submit" class="signUpButton">Submit</button>
                <a class="cancelButton" href="index.php">Cancel</a>
            </div>
            <div>
                <p>By creating an account you agree to our <a href="tp.html" style="color:blue">Terms & Privacy</a>.</p>
            </div>
        </form>
    </body>
</html>
