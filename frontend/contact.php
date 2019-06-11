<?php include_once('menu.php');?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <title>Become a seller!</title>
    <link rel="stylesheet" href="../css/Contact.css">
</head>
<form action="../backend/addSeller.php" method="POST" class="bodyForm">
    <div class="divContact">
        <h1>Become a seller! </h1>
        <input type="text" id="addSeller" placeholder="your email here" name="emailSeller">
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
</html>