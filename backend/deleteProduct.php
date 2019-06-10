<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/8/2019
 * Time: 6:32 PM
 */

include_once('database/Database.php');
$id_produs = $_GET['id_produs'];

$reader = new Reader();
$row = $reader->getProduct($id_produs);

$deleter = new Deleter();
$deleter->deleteProduct($id_produs);

$path = "../backend/products/" . $row['path_poza'];

if(file_exists($path)){
    unlink($path);
}

header("Location: ../backend/productsManager.php");
die();