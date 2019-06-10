<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/10/2019
 * Time: 5:52 PM
 */

include_once('../backend/database/Database.php');
include_once('../backend/mail_config/Email.php');
session_start();

$fullName = $_POST['fullName'];
$email = $_POST['email'];
$fullAddress = $_POST['fullAddress'];
$city = $_POST['city'];
$country = $_POST['country'];
$zipCode = $_POST['zipCode'];

$reader = new Reader();
$emailer = new Email();
$updater = new Updater();

$message = "Comanda finalizata pentru $fullName la adresa $fullAddress in $country, $city. \nSucuri cumparate: \n";

$id_user = $reader->getClientId($email);
if($id_user == -1){
    $id_user = $reader->getSellerId($email);
    $vanzator = 1;
}

$id_lista_cumparaturi = $reader->getShoppingListId($id_user, $vanzator);

$lista_cumparatrui = $reader->getShoppingList($id_lista_cumparaturi);

while($row = $lista_cumparatrui->fetch_assoc()){
    $id_produs = $row['id_produs'];
    $quantity = $row['cantitate'];

    $produs = $reader->getProduct($id_produs);
    $id_vanzator = $produs['id_vanzator'];
    $vanzator_info = $reader->getSeller($id_produs);
    $email_vanzator = $vanzator_info['email'];
    $product_name = $produs['nume'];
    $pret = $produs['pret'];
    $total = $pret * $quantity;

    $emailer->newItemSold($email_vanzator, $quantity, $product_name);

    $message = $message . "$product_name ($quantity) x $pret = $total\n";

    $updater->updateProductQuantity($id_produs, -1*$quantity);
}

$message = $message . "Comanda va ajunge in cel mai scurt timp posibil.\n Va uram o zi buna!";

$emailer->purchaseConfirmation($email, $message);

$updater->updatePlateste_pentruFinalizare($id_lista_cumparaturi);

