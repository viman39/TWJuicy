<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/10/2019
 * Time: 5:09 PM
 */

include_once('../frontend/builders/CheckoutBuilder.php');
include_once('../frontend/menu.php');
include_once('../backend/database/Database.php');

if($_SESSION['login'] == false){
    header("Location: ../frontend/index.php");
    die();
}

$reader = new Reader();
$updater = new Updater();

$email = $_SESSION['username'];
$vanzator = 0;

$id_user = $reader->getClientId($email);

if($id_user == -1){
    $id_user = $reader->getSellerId($email);
    $vanzator = 1;
}



$id_lista_cumparaturi = $reader->getShoppingListId($id_user, $vanzator);

$checkout = new CheckoutBuilder();

$checkout->buildPersonalInformation();
$checkout->buildCardInformation();
$checkout->startBuildTotal();

$lista_cumparaturi = $reader->getShoppingList($id_lista_cumparaturi);

$total = 0;

while($row = $lista_cumparaturi->fetch_assoc()){
    $id_produs = $row['id_produs'];

    $quantityIdentifier = "quantity".$id_produs;
    $cantitate = $_POST[$quantityIdentifier];

    $updater->newPurchasedQuantity($id_lista_cumparaturi, $id_produs, $cantitate);

    $produs_info = $reader->getProduct($id_produs);

    $nume = $produs_info['nume'];
    $pret = $produs_info['pret'];
    $total = $total + $pret*$cantitate;

    $checkout->addItemTotal($nume, $cantitate, $pret);
}

$checkout->endBuildTotal($total);
$checkout->buildTail();

