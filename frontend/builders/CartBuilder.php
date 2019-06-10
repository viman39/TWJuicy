<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/9/2019
 * Time: 5:23 PM
 */

class CartBuilder{
    public static $head = 0;
    public static $tail = 0;

    public function __construct(){
        if( self::$head == 0 ){
        self::buildHead();
        self::$head = 1;
        return true;
    }
        return false;
    }

    private function buildHead(){
        ?>
        <!DOCTYPE html>
        <html lang="ro">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width">
            <title>Cart</title>
        </head>
        <body>
        <header>
            <h1 class="main_title">Juicy</h1>
        </header>

        <form class="cart" action="../backend/checkout.php" method="post">
            <table style="width:100%">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
<?php
    }

    public function buildItem($id_produs, $id_lista_cumparaturi, $img_path, $name, $arome, $sour, $quantity, $price){
        ?>
                <tr>
                    <td><a class="delete-btn" href="deleteFromCart.php?id_produs=<?php echo $id_produs?>&id_lista_cumparaturi=<?php echo $id_lista_cumparaturi?>">x</a></td>
                    <td><img style="width: 7%" src=<?php echo $img_path ?> ></td>
                    <td>
                        <div class="description">
                            <h3><?php echo $name ?></h3>
                            <span><?php echo $arome ?></span>
                            <span><?php echo $sour ?></span>
                        </div>
                    </td>
                    <td>
                        <span>quantity: </span>
                        <input type="number" name="quantity<?php echo $id_produs?>" value=<?php echo $quantity ?>>
                    </td>
                </tr>
<?php
    }

    public function buildCheckout(){
        ?>
            </table>

            <input type="submit" value="Checkout" />
<?php
    }

    public function buildTail(){
     ?>

        </form>
        </body>
        </html>
<?php
    }
}