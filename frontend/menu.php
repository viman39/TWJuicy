<?php include_once('login.php');
    ?>
<nav class="mainBarNav">
    <ul id="menu">
        <li><a href="../frontend/index.php">Acasa</a></li>
        <?php if(isset($_SESSION['login']) and $_SESSION['login'] == true){     ?>
        <li><a href="../backend/catalogGenerator.php">Magazin</a></li><?php }?>
        <link rel="stylesheet" type="text/css" href="../css/cart.css">
        <?php if(isset($_SESSION['seller'])){ ?>
        <li><a href=<?php
            if($_SESSION['seller'] == 1)
                                echo "../backend/productsManager.php";
                          else echo "../backend/shoppingHistory.php"; ?>><?php if($_SESSION['seller'] == 1)
                                                                                    echo "Produsele tale";
                                                                                    else echo "Istoric Cumparaturi"; ?></a></li>
        <?php }?>
        <li><a href="../frontend/contact.php">Contact</a></li>
        <?php if(!isset($_SESSION['login']) or $_SESSION['login'] == false){ ?>
        <li><a href="#login" onclick="document.getElementById('id01').style.display='block'">Login</a></li>
        <?php }else {?>
        <li><a href="../backend/logout.php">Logout <?php echo $_SESSION['username'];?></a></li>
        <?php } if(isset($_SESSION['login']) and $_SESSION['login'] == true){?>
        <li><a href="../backend/cartGenerator.php"><img src="../img/cart_transparent.png" alt="Shopping Cart"></a></li><?php } ?>
    </ul>
</nav>
