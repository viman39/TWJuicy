<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/8/2019
 * Time: 6:19 PM
 */

include_once('database/Database.php');

$id_product = $_GET['id_produs'];
$quantity = $_POST['newQty'];

$updater = new Updater();
$updater->updateProductQuantity($id_product, $quantity);

header("Location: ../backend/productsManager.php");
die();