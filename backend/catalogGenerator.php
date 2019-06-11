
<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 5/16/2019
 * Time: 8:18 AM
 */

include_once('database\Database.php');
include_once('../frontend/menu.php');
include_once('../frontend/builders/CatalogBuilder.php');
if($_SESSION['login'] == false) {
    header("Location: ../frontend/index.php");
    die();
}

$search = "";

if(isset($_GET['searchBar'])){
    $search = $_GET['searchBar'];
}

$reader = new Reader();

$catalogBuilder = new CatalogBuilder($search);

$result_produse = $reader->getCustomProducts($search);

    while($row = $result_produse->fetch_assoc()){
        $path = "\"" . "../backend/products/" . $row['path_poza'] . "\"";
        $nume = $row['nume'];
        $pret = $row['pret'];
        $arome = $row['arome'];
        $id_produs = $row['id_produs'];
        $adauga_in_cos = "\"" . "../backend/addToCart.php?id_produs=$id_produs" . "\"";
        $quantity = $reader->getOwnedQuantity($id_produs);
        $sold_out = $quantity == 0 ? true : false;

        $catalogBuilder->buildItem($path, $nume, $pret, $arome, $adauga_in_cos, $sold_out);
    }

$catalogBuilder->buildTail();
$reader->kill();