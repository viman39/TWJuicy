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

    public function __construct($search){
        if( self::$head == 0 ){
            self::buildHead($search);
            self::$head = 1;
            return true;
        }
        return false;
    }

    private function buildHead($search){
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
            <form action="../backend/catalogGenerator.php<?php if($search !== "") echo "?searchBar=$search"?>" method="get" class="searchBarForm" style="padding: 2%">
                <input type="text" placeholder="search" name="searchBar" class="searchBarInput" style="border: 1px solid black; border-radius:15px;">
                <input type="submit" value="Search!" class="searchButton" style="border-radius: 15px;">
            </form>
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
                    ?> <p><a class="adaugaInCosA" style="text-decoration: none; background: blue; border-radius: 15px; color:white; padding: 2%" href=<?php echo $adauga_in_cos?>>Adauga in cos</a></p> <?php
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