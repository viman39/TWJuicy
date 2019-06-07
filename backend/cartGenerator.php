<!DOCTYPE html>
<html lang="ro">
<?php
/**
 * Created by PhpStorm.
 * User: Gheoca Victor Manuel
 * Date: 5/14/2019
 * Time: 9:17 AM
 */

include_once('database\Database.php');

include_once('../frontend/menu.php');
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <header>
            <h1 class="main_title">Juicy</h1>
        </header>

        <div class="cart">
            <div class="row">Your Cart</div>
            <?php
                if($_SESSION['login'] == true) {
                    $reader = new Reader();
                    $email = $_SESSION['username'];
                    $id_client = $reader->getClientId($email);

                    $id_lista_cumparaturi = $reader->getShoppingListId($id_client);

                    $result_lista_cumparaturi = $reader->getShoppingList($id_lista_cumparaturi);

                    if($result_lista_cumparaturi->num_rows != 0 ){
                        while ($row = $result_lista_cumparaturi->fetch_assoc()) {
                            $id_produs = $row['id_produs'];
                            $quantity = "\"" . $row['cantitate'] . "\"";

                            $row = $reader->getProduct($id_produs);

                            $name = $row['nume'];
                            $price = $row['pret'];
                            $arome = $row['arome'];
                            $img_path = "\"" . "../backend/products/" . $row['path_poza'] . "\"";
                            $sour = $row['acidulat'] == 1 ? 'acidulat' : 'neacidulat';
                            ?>
                            <div class="column">
                                <div class="item">
                                    <div class="buttons">
                                        <a class="delete-btn" href="delete_from_cart"></a>
                                        <span class="like-btn"></span>
                                    </div>

                                    <div class="image">
                                        <img src=<?php echo $img_path ?> alt=""/>
                                    </div>

                                    <div class="description">
                                        <span><?php echo $name ?></span>
                                        <span><?php echo $arome ?></span>
                                        <span><?php echo $sour ?></span>
                                    </div>

                                    <div>
                                        <input type="number" name="quantity" value=<?php echo $quantity ?>>
                                    </div>

                                    <div class="total-price"><?php echo $price ?> Lei</div>
                                </div>
                            </div>
                            <?php
                        } ?>
                            <div class="checkout-btn">
                                <span><a href="../frontend/checkout.php">Check out</a></span>
                            </div>
                        <?php
                    } else{
                        echo "YOUR CART IS EMPTY!";
                    }
                } else{
                    header("Location: ../frontend/index.php");
                    die();
                }
            ?>
        </div>
    </body>
</html>

