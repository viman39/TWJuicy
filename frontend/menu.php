<?php include_once('login.php');
    ?>
<nav>
    <ul id="menu">
        <li><a href="../frontend/index.php">Home</a></li>
        <li><a href="../backend/catalogGenerator.php">Shop</a></li>
        <link rel="stylesheet" type="text/css" href="../css/cart.css">
        <?php if(isset($_SESSION['seller'])){ ?>
        <li><a href=<?php
            if($_SESSION['seller'] == 1)
                                echo "../backend/productsManager.php";
                          else echo "../backend/shoppingHistory.php"; ?>><?php if($_SESSION['seller'] == 1)
                                                                                    echo "Your Items";
                                                                                    else echo "Shopping History"; ?></a></li>
        <?php }?>
        <li><a href="../frontend/contact.php">Contact</a></li>
        <?php if(!isset($_SESSION['login']) or $_SESSION['login'] == false){ ?>
        <li><a href="#login" onclick="document.getElementById('id01').style.display='block'">Login</a></li>
        <?php }else {?>
        <li><a href="../backend/logout.php">Logout <?php echo $_SESSION['username'];?></a></li>
        <?php } ?>
        <li><a href="../backend/cartGenerator.php"><img src="../img/cart_transparent.png" alt="Shopping Cart"></a></li>
    </ul>
</nav>
