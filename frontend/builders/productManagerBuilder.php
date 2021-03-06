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
            <link rel="stylesheet" type="text/css" href="../../css/productManager.css">
            <title>Juicy</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body>
            <table style="width:100%">
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

    public function buildItem($nume, $pret, $acidulat, $arome, $quantity){
        $acidulat = $acidulat == 1 ? "DA" : "NU";
        ?>
                <tr>
                    <td><a class="delete-btn" href="../../backend/deleteProduct.php?nume=<?php  echo $nume?>"></a></td>
                    <td><?php  echo $nume?></td>
                    <td><?php  echo $pret?></td>
                    <td><?php  echo $acidulat?></td>
                    <td><?php  echo $arome?></td>
                    <td><?php  echo $quantity?></td>
                    <td><form action="../../backend/updateQuantity.php" method="post">
                            <input type="number" name="newQty">
                            <input type="submit"><form></td>
                </tr>
<?php
    }

    public function buildTail(){
        if(self::$tail == 1) return false;
        ?>
                    <tr class="row">
                        <td><a class="btn btn-primary" href="../addProduct.php">Adauga produs</a></td>
                    </tr>

            </table>
        </body>
        </html>
<?php
        return true;
    }
}