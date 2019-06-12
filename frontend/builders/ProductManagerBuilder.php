<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/8/2019
 * Time: 2:07 PM
 */

class productManagerBuilder{
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
            <link rel="stylesheet" type="text/css" href="../css/productManager.css">
            <title>Your Products</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body style="background-image: linear-gradient(-45deg, yellow, lightyellow)">
            <table style="width:90%">
                <tr>
                    <th></th>
                    <th>Nume</th>
                    <th>Pret</th>
                    <th>Acidulat</th>
                    <th>Arome</th>
                    <th>Cantitate</th>
                    <th>Modifica Stoc</th>
                </tr>

<?php
    }

    public function buildItem($nume, $pret, $acidulat, $arome, $quantity, $id_produs){
        $acidulat = $acidulat == 1 ? "DA" : "NU";
        ?>
                <tr class="tableRow">
                    <td align="right"><a class="deleteItem" href="../backend/deleteProduct.php?id_produs=<?php  echo $id_produs?>">elimina produs!</a></td>
                    <td align="center"><?php  echo $nume?></td>
                    <td align="center"><?php  echo $pret?></td>
                    <td align="center"><?php  echo $acidulat?></td>
                    <td align="center"><?php  echo $arome?></td>
                    <td align="center"><?php  echo $quantity?></td>
                    <td align="center"><form action="../backend/updateQuantity.php" method="post">
                            <input type="number" class="inputBox" name="newQty<?php  echo $id_produs?>" min="1">
                            <input type="submit" value="Add" name="submit<?php  echo $id_produs?>"><form></td>
                </tr>
<?php
    }

    public function buildTail(){
        if(self::$tail == 1) return false;
        ?>
            </table>
            <div class="adaugaProdusDiv">
                <a class="adaugaProdusBtn" href="../frontend/addProduct.php">Adauga produs</a>
            </div>
        </body>
        </html>
<?php
        return true;
    }
}