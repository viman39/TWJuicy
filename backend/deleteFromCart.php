<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 6/8/2019
 * Time: 7:12 PM
 */

include_once("database/Database.php");

$id_produs = $_GET['id_produs'];
$id_lista_cumparaturi = $_GET['id_lista_cumparaturi'];

$deleter = new Deleter();
$deleter->deleteProductFromCantitate_cumparata($id_produs, $id_lista_cumparaturi);

header("Location: ./cartGenerator.php");
die();