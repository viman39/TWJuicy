<?php
/**
 * Created by PhpStorm.
 * User: Gheoca Victor Manuel
 * Date: 5/14/2019
 * Time: 9:17 AM
 */

include_once('database\Database.php');
include_once('..\frontend\builders\CartBuilder.php');
include_once('../frontend/menu.php');

if($_SESSION['login'] == true) {
    $cartBuilder = new CartBuilder();

    $reader = new Reader();
    $email = $_SESSION['username'];
    $id_client = $reader->getUserId($email);
    $vanzator = $_SESSION['seller'] == true ? 1 : 0;

    $id_lista_cumparaturi = $reader->getShoppingListId($id_client, $vanzator);

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

            $cartBuilder->buildItem($id_produs, $id_lista_cumparaturi, $img_path, $name, $arome, $sour, $quantity, $price);
        }
        $cartBuilder->buildCheckout();
        $cartBuilder->buildTail();
    } else{
        echo "YOUR CART IS EMPTY!";
    }
    $reader->kill();
} else{
    header("Location: ../frontend/index.php");
    die();
}
