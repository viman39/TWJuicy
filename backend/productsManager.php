<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/4/2019
 * Time: 5:52 PM
 */

include_once('database\Database.php');
include_once('..\frontend\menu.php');
include_once('..\frontend\builders\productManagerBuilder.php');

$productsManager = new productManagerBuilder();

$reader = new Reader();

$email = $_SESSION['username'];
$id_vanzator = $reader->getSellerId($email);
$lista_produse = $reader->getProductsFrom($id_vanzator);

while($row = $lista_produse->fetch_assoc()){
    $nume = $row['nume'];
    $pret = $row['pret'];
    $acidulat = $row['acidulat'];
    $arome = $row['arome'];
    $path_poza = "\"" . "../backend/products/" . $row['path_poza'] . "\"";
    $id_produs = $row['id_produs'];
    $quantity = $reader->getOwnedQuantity($id_produs);

    $productsManager->buildItem($nume, $pret, $acidulat, $arome, $quantity);
}

$productsManager->buildTail();