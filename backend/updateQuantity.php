<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/8/2019
 * Time: 6:19 PM
 */

include_once('database/Database.php');

$iterator=1;
$qty = 'newQty'.$iterator;

while($_POST[$qty] == 0){
    $iterator++;
    $qty = $qty = 'newQty'.$iterator;
}

$id_product = $iterator;
$quantity = $_POST[$qty];

$updater = new Updater();
$updater->updateProductQuantity($id_product, $quantity);

header("Location: ../backend/productsManager.php");
die();