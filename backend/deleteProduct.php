<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/8/2019
 * Time: 6:32 PM
 */

include_once('database/Database.php');
$id_produs = $_GET['id_produs'];

$deleter = new Deleter();
$deleter->deleteProduct($id_produs);

header("Location: ../backend/productsManager.php");
die();