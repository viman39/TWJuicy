<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/9/2019
 * Time: 8:33 PM
 */

class CatalogBuilder{
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
            <link rel="stylesheet" type="text/css" href="../css/catalog.css">
            <title>Juicy</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body>
        <header>
            <h1>Catalog sucuri</h1>
        </header>
        <div class="container">
        <div class="row">
<?php
    }

    public function buildItem($path, $nume, $pret, $arome, $adauga_in_cos, $sold_out){
        ?>
        <div class="column">
            <div class="card">
                <a class="button">
                    <img src=<?php echo $path?> alt=<?php echo $nume?> style="width:100%">
                </a>
                <h2> <?php echo $nume ?> </h2>
                <?php if($sold_out == false) {
                    ?> <p class="Pret"><?php echo $pret ?> LEI </p> <?php
                } else{
                    ?> <p class="soldOut">SOLD OUT</p> <?php
                }
                ?>
                <p><?php echo $arome ?></p>
                <?php if($sold_out == false) {
                    ?> <p><a class="btn btn-primary" href=<?php echo $adauga_in_cos?>>Adauga in cos</a></p> <?php
                } ?>
            </div>
        </div>
<?php
    }

    public function buildTail(){
        ?>
        </div>
        </div>
        </body>
        </html>


        <?php
    }
}